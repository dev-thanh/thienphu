<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PostRequest;
use App\Repositories\Backend\PostsRepository;
use App\Repositories\Backend\CategoriesRepository;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\NewsCategory;
use DataTables;
use File, DB;

class PostController extends Controller
{

    private $type = 'blog';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $posts;

    public function __construct(PostsRepository $posts, CategoriesRepository $categories)
    {
    	$this->posts = $posts;

    	$this->categories = $categories;
    }

    protected function module(){
        return [
            'name' => 'Tin tức',
            'module' => 'posts',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tiêu đề tin tức', 
                    'with' => '',
                ],
                'category' => [
                    'title' => 'Danh mục tin tức', 
                    'with' => '200px',
                ],
                'order' => [
                    'title' => 'Thứ tự', 
                    'with' => '30px',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
            ]
        ];
    }


    protected function fields()
    {
        return [
            'name' => 'required',
            'name_en' => 'required',
            'image' => 'required',
            'category' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề tiếng việt không được bỏ trống.',
            'name_en.required' => 'Tiêu đề tiếng anh không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh đại diện.',
            'category.required' => 'Bạn chưa chọn danh mục bài viết.',
            
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $list_post = $this->posts->orderBy('created_at','DESC')->get();

            return Datatables::of($list_post)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="90px" height="60px">';
                })->addColumn('name', function ($data){
                    return '<span>' . $data->name . '</span><br>'
                    .'<a class="link_cate" href="' . asset('chi-tiet-tin-tuc/'.$data->id.'/'.$data->slug) . '" target="_blank"> <i class="fas fa-hand-point-right" aria-hidden="true"></i> Link bài viết: ' . asset('chi-tiet-tin-tuc/'.$data->id.'/'.$data->slug) . ' </a>';
                })->addColumn('category', function ($data) {
                        $label = null;

                        if(count($data->category)){
                            foreach ($data->category as $item) {
                                $label = $label. '<span class="badge badge-info">'.$item->name.'</span><br>';
                            }
                        }
                        return $label;
                })->addColumn('status', function ($data) {
                    $status='';

                    if ($data->status == 1) {
                        $status.= ' <span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $status.= ' <span class="badge badge-danger">Không hiển thị</span>';
                    }
                   
                    if ($data->hot == 1) {
                        $status.= '<br><span class="badge badge-danger">Nổi bật</span>';
                    }
                    if ($data->show_home == 1) {
                        $status.= '<br><span class="badge badge-primary">Hiển thị trang chủ</span>';
                    }
                    if ($data->tieubieu == 1) {
                        $status.= '<br><span class="badge badge-warning">Tiêu biểu</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<button type="button" class="btn-link btn-primary" data-original-title="Sửa">
	                        <a href="' . route('posts.edit',  $data->id ) . '" title="Sửa">
	                            <span class="label label-primary action-span"><i class="fa fa-edit"></i></span>
	                        </a>
	                    </button>
	                    <button type="button" class="btn btn-link btn-danger" data-original-title="Xóa">
                            <a href="javascript:;" class="btn-destroy" data-href="' . route('posts.destroy', $data->id) . '" data-toggle="modal" data-target="#confim">
                                <span class="label label-danger action-span"><i class="fa fa-times"></i></span>
                            </a>
                        </button>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'name', 'category'])
                ->addIndexColumn()
                ->make(true);
        }

        $data['module'] = $this->module();

        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['module'] = $this->module();

        $data['categories'] = $this->categories->getCatePost();
        
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();

        $data['slug'] = $this->createSlug(str_slug($request->name),$id = null,$type='slug');

        $data['status'] = $request->status == 1 ? 1 : null;

        $data['hot'] = $request->hot == 1 ? 1 : null;

        $data['show_home'] = $request->show_home == 1 ? 1 : null;

        $data['tieubieu'] = $request->tieubieu == 1 ? 1 : null;

        $post = $this->posts->create($data);

        if(!empty($request->category)){

            foreach ($request->category as $item) {

                $this->posts->insertCategoryNews(['id_category'=> $item, 'id_news'=> $post->id]);

            }

        }

        return redirect()->route($this->module()['module'].'.index',['type'=>$request->type])->with('success', 'Thêm mới tin tức thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);

        $data['categories'] = $this->categories->getCatePost();

        $data['data'] = $this->posts->find($id);

        $data['array_id'] = $this->posts->getListCateNews($id);

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $input = $request->all();

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        $input['show_home'] = $request->show_home == 1 ? 1 : null;

        $input['tieubieu'] = $request->tieubieu == 1 ? 1 : null;

        $this->posts->updateById($id, $input);

        if(!empty($request->category)){

            $this->posts->deleteCateNews($id);

            foreach ($request->category as $item) {

                $this->posts->insertCategoryNews(['id_category'=> $item, 'id_news'=> $id]);

            }
        }

        return back()->with('success', 'Cập nhập tin tức thành công');
    }

    
    public function destroy($id)
    {
        $this->posts->deleteById($id);

        $this->posts->deleteCateNews($id);

        return redirect()->back()->with('success', 'Xóa tin tức thành công');
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){

            foreach ($request->chkItem as $id) {

                $this->posts->deleteById($id);

            }

            return back()->with('success', 'Xóa tin tức thành công');
        }

        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();

        return back();
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);

        $id = $request->id;

        $type = $request->type;

        $post = $this->posts->find($id);

        $post->$type = $this->createSlug($slug, $id,$type);

        $post->save();

        return $this->createSlug($slug, $id,$type);
    }

    public function createSlug($slugPost, $id = null,$type)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id,$type)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null,$type)
    {
        if($id != null) {
            $count = $this->posts->where('id', '!=', $id)->where($type, $slug)->count();
            return $count > 0;
        }else{
            $count = $this->posts->where($type, $slug)->count();
            return $count > 0;
        }
    }
}
