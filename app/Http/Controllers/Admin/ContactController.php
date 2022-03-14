<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use App\Models\Contact;
use App\Repositories\Backend\ContactRepository;

class ContactController extends Controller
{
	protected $contact;

	public function __construct(ContactRepository $contact)
	{
		$this->contact = $contact;
	}

    public function getListContact(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->contact->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name', function ($data) {
                    return $data->name;
                })->addColumn('phone', function ($data) {
                    return $data->phone;
                })->addColumn('email', function ($data) {
                    return $data->email;
                })->addColumn('title', function ($data) {
                    if($data->type==1){
                        $text = '<span class="label label-primary">'.$data->title.'</span';
                    }else{
                        $text = '<span class="label label-success">'.$data->title.'</span';
                    }
                    return $text;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="badge badge-success">Đã xem</span>';
                    } else {
                        $status = ' <span class="badge badge-danger">Chưa xem</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
		                    	<a href="' . route('contact.edit', $data->id) . '" title="Xem">
			                        <i class="fa fa-edit"></i>
		                        </a>
	                        </button>
	                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
	                            <a href="javascript:;" class="btn-destroy" data-href="' . route('contact.destroy', $data->id) . '"
	                            data-toggle="modal" data-target="#confim" title="Xóa">
	                            	<i class="fa fa-times"></i>
	                        	</a>
	                        </button>';
                })->rawColumns(['checkbox', 'title', 'phone', 'name', 'email', 'status', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.contact.list');
    } 

    public function postDeleteMuti(Request $request)
    {
        if ($request->has('chkItem')) {

        	$arrayId = $request->chkItem;

        	$this->contact->deleteMultipleById($arrayId);

            DB::table('notifications')->whereIn('notifiable_id',$arrayId)->delete();

            return redirect()->back()->with('success', 'Xóa thành công');

        } else {

        	flash('Bạn chưa chọn dữ liệu cần xóa !')->error();

            return redirect()->back();

        }
    }

    public function getEdit($id)
    {
        $data = $this->contact->find($id);

        if($data->status !=1){

            DB::table('notifications')->where('notifiable_id',$id)->update(['read_at' => date('Y-m-d H:i:s')]);
            
        }

        $data->update(['status' => 1]);

        return view('backend.contact.edit', compact('data'));

    }

    public function getDelete($id)
    {
        $this->contact->deleteById($id);

        DB::table('notifications')->where('notifiable_id',$id)->delete();

        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
