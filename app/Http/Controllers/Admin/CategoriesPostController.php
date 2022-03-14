<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\CategoriesRepository;

class CategoriesPostController extends Controller
{
	protected $categories;

	protected function fields()
    {
        return [
            'name' => "required",
            'slug' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống.', 
            'slug.required' => 'Đường dẫn tĩnh không được bỏ trống.',
        ];
    }

	public function __construct(CategoriesRepository $categories)
	{
		$this->categories = $categories;
	}
    
    protected function module(){
        return [
            'name' => 'Danh mục tin tức',
            'module' => 'category-post',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'slug' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module'] = $this->module();

        $data['data'] = $this->categories->getCategories('post_category','ASC');

        return view("backend.category.posts.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module'] = $this->module();

        $data['categories'] = $this->categories->getCategories('post_category','ASC');

        return view("backend.category.posts.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->fields(), $this->messages());

        $type = 'post_category';

        $post_check_slug = $this->categories->getCateDetailByType($request->slug, $type);

        if (!empty($post_check_slug)) {

            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);

        }

        $input = $request->all();

        if($request->parent_id == 0){

            $input['level'] = 1;

        }else{
            
            $cateParent = $this->categories->where('id',$request->parent_id)->first();

            $levelCate = $cateParent->level;

            $input['level'] = $levelCate+1;

        }

        $input['type'] = $type;

        $input['show'] = $request->show ? $request->show : null;

        $data = $this->categories->create($input);

        return redirect()->route("category-post.index")->with('success', 'Thêm mới danh mục thành công');
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

        $data['categories'] = $this->categories->getCateNotId($id, 'post_category');

        $data['data'] = $this->categories->find($id);

        return view("backend.category.posts.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, $this->fields(), $this->messages());

        $post_check_slug = $this->categories->getOrtherCateByType($id, $request->slug, 'post_category');

        if (!empty($post_check_slug)) {

            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        }
        
        $input = $request->all();

        if($request->parent_id == 0){

            $input['level'] = 1;

        }else{
            $cateParent = $this->categories->where('id',$request->parent_id)->first();

            $levelCate = $cateParent->level;

            $input['level'] = $levelCate+1;

        }

        $input['show'] = $request->show ? $request->show : null;

        $this->categories->updateById($id, $input);

        return back()->with('success', 'Cập nhập danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categories->find($id)->get_child_cate;

        if(count($category)){

        	$arrayId = $category->pluck('id')->toArray();

        	array_push($arrayId,$id);

            // flash('Không thể xóa danh mục này vì danh mục này đang có danh mục con.')->error();

            $this->categories->deleteMultipleById($arrayId);

            return redirect()->route('category-post.index')->with('success', 'Xóa danh mục thành công');

        }else {

            $this->categories->deleteById($id);

        }
        
        return redirect()->route('category-post.index')->with('success', 'Xóa danh mục thành công');
    }
}
