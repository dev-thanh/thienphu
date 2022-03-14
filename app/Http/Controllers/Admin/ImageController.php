<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\ImagesRepository;
use App\Http\Requests\Backend\ImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $images;

    public function __construct(ImagesRepository $images)
    {
    	$this->images = $images;
    }

    public function index(Request $request)
    {
        $data = $this->images->where('type',$request->type)->orderBy('created_at', 'DESC')->get();

        return view('backend.image.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.image.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $data = [
            'image' => $request->image,
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status == 1 ? 1 : 0,
            'type' => $request->type
        ];
       
        $image = $this->images->create($data);

        return redirect()->route('image.index', ['type' => $request->type])->with('success', 'Thêm mới thành công');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->images->find($id);

        return view('backend.image.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request, $id)
    {
        $data = [
            'image' => $request->image,
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status == 1 ? 1 : 0,
            'type' => $request->type
        ];

        $image = $this->images->find($id)->update($data);

        return redirect()->route('image.index', ['type' => $request->type])->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->images->find($id)->delete();

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function deleteMuti(Request $request)
    {
        if ($request->has('chkItem')) {

            foreach ($request->chkItem as $id) {

                $this->images->find($id)->delete();

            }

            return redirect()->back()->with('success', 'Xóa thành công');

        }else{

            flash('Bạn chưa chọn dữ liệu cần xóa.')->error();

            return redirect()->back();

        }
    }
}
