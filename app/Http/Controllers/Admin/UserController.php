<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Repositories\Backend\UserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
	protected $user;

    public function __construct(UserRepository $user)
    {
        $this->middleware('checkLevel', ['except' => ['edit','update']]);

        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->user->all();

        return view('backend.users.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = [
        	'user_name' => $request->user_name,
        	'name' => $request->name,
        	'phone' => $request->phone,
        	'email' => $request->email,
        	'password' => Hash::make($request->password),
        	'status' => $request->status,
        	'level' => $request->level,
        	'image' => $request->image ? $request->image : '/public/backend/images/avatar_default.png',
        ];

        $this->user->create($data);
       
        return redirect()->route('users.index')->with('success', 'Thêm mới tài khoản thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->user->find($id);

        return view('backend.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
    	$user = $this->user->find($id);

        $data = [
        	'user_name' => $request->user_name,
        	'name' => $request->name,
        	'phone' => $request->phone,
        	'email' => $request->email,
        	'image' => $request->image,
        ];

        if ($request->input('password')) {
            $this->validate($request,
            [
                'repassword' => 'same:password'
            ],
            [
                'password.same' => 'Mật khẩu nhập lại không giống !'
            ]);

            $pass = $request->input('password');

            $data['password'] = Hash::make($pass);

        }

        if($user->user_name != 'gco_admin'){
            $data['status'] = $request->status;
        }
        
        if (!empty($request->level)) {
            $data['level'] = $request->level;
        }

        $this->user->updateById($id, $data);

        return redirect()->back()->with('success', 'Cập nhập tài khoản thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->deleteById($id);

        return back()->with('success', 'Xóa tài khoản thành công.');
    }
}
