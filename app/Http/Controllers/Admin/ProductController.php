<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use App\Http\Requests\Backend\ProductsRequest;
use App\Http\Requests\Backend\ProductsEditRequest;
use App\Repositories\Backend\CategoriesRepository;
use App\Repositories\Backend\ProductRepository;
use App\Repositories\Backend\ProductCategoryRepository;
use App\Models\Products;

class ProductController extends Controller
{
	protected $products,$cateProduct,$categories;

	public function __construct(ProductRepository $products,CategoriesRepository $categories, ProductCategoryRepository $cateProduct)
	{
		$this->products = $products;

		$this->categories = $categories;

		$this->cateProduct = $cateProduct;
	}
	protected function module(){
        return [
            'name' => 'Sản phẩm',
            'module' => 'products',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên sản phẩm', 
                    'with' => '',
                ],
                'category' => [
                    'title' => 'Danh mục sản phẩm', 
                    'with' => '200px',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     if ($request->ajax()) {

            $list_products = $this->products->orderBy('created_at', 'DESC')->get();

            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="90px">';
                })->addColumn('name', function ($data) {
                    return 
                    	'<span>' . $data->name . '</span><br>'
	                    .'<a class="link_cate" href="' . asset($data->slug.'.html') . '" target="_blank"> <i class="fas fa-hand-point-right" aria-hidden="true"></i>Link: ' . asset($data->slug.'.html') . ' 
	                    </a>';
                })->addColumn('category', function ($data) {
                    $label = null;
                    if(count($data->category)){
                        foreach ($data->category as $item) {
                            $label = $label. '<span class="badge badge-info">'.$item->name.'</span><br>';
                        }
                    }
                    return $label;
                })->addColumn('order', function ($data) {
                    return $data->stt;
                })->addColumn('status', function ($data) {
                    $status='';

                    if ($data->status == 1) {
                        $status.= ' <span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $status.= ' <span class="badge badge-danger">Không hiển thị</span>';
                    }
                    if ($data->is_new == 1) {
                        $status.= '<br><span class="badge badge-success">Sản phẩm mới</span>';
                    }
                    if ($data->hot == 1) {
                        $status.= '<br><span class="badge badge-success">Sản phẩm nổi bật</span>';
                    }
                    if ($data->selling == 1) {
                        $status.= '<br><span class="badge badge-success">Sản phẩm bán chạy</span>';
                    }
                    if ($data->review == 1) {
                        $status.= '<br><span class="badge badge-success">Sản phẩm đánh giá tốt nhất</span>';
                    }
                    return $status;

                })->addColumn('action', function ($data) {
                    return 
                        '<button type="button" class="btn-link btn-primary" data-original-title="Sửa">
	                        <a href="' . route('products.edit',  $data->id ) . '" title="Sửa">
	                            <span class="label label-primary action-span"><i class="fa fa-edit"></i></span>
	                        </a>
	                    </button>
	                    <button type="button" class="btn btn-link btn-danger" data-original-title="Xóa">
                            <a href="javascript:;" class="btn-destroy" data-href="' . route('products.destroy', $data->id) . '" data-toggle="modal" data-target="#confim">
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
    public function create()
    {
        $data['module'] = $this->module();

        $data['categories'] = $this->categories->getCateProduct();
        
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {       
        $input = $request->all();

        $input['slug'] = $this->createSlug(str_slug($request->name),$id = null,$type='slug');

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['is_new'] = $request->is_new == 1 ? 1 : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        $input['selling'] = $request->selling == 1 ? 1 : null;

        $input['review'] = $request->review == 1 ? 1 : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $input['file'] = !empty($request->file) ? json_encode($request->file) : null;

        $product = $this->products->create($input);

        if(!empty($request->category)){

            foreach ($request->category as $item) {

                $this->cateProduct->create(['id_category'=> $item, 'id_product'=> $product->id]);

            }
        }

        return redirect()->route($this->module()['module'].'.index')->with('success', 'Thêm mới sản phẩm thành công');
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

        $data['categories'] = $this->categories->getCateProduct();

        $data['data'] = $this->products->find($id);

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Products $product, ProductsEditRequest $request)
    {
        $input = $request->all();

        $id = $product->id;

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['is_new'] = $request->is_new == 1 ? 1 : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        $input['selling'] = $request->selling == 1 ? 1 : null;

        $input['review'] = $request->review == 1 ? 1 : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $input['file'] = !empty($request->file) ? json_encode($request->file) : null;
        
        $product = $this->products->updateById($id, $input);

        if(!empty($request->category)){

            $this->cateProduct->where('id_product', $id )->delete();

            foreach ($request->category as $item) {
                $this->cateProduct->create(['id_category'=> $item, 'id_product'=> $id ]);
            }
        }

        return redirect()->route($this->module()['module'].'.index')->with('success', 'Cập nhập sản phẩm thành công');

    }

    public function destroy($id)
    {

        $this->products->deleteById($id);
        
        $this->cateProduct->where('id_product',$id)->delete();

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                $this->products->deleteById($id);

                $this->cateProduct->where('id_product',$id)->delete();
            }

            return back()->with('success', 'Xóa sản phẩm thành công');
        }

        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();

        return back();
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $type = $request->type;
        $post = $this->products->find($id);
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
            $count = $this->products->getSlug($slug, $type, $id);
            return $count > 0;
        }else{
            $count = $this->products->where($type, $slug)->count();
            return $count > 0;
        }
    }



}
