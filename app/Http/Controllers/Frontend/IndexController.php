<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Repositories\Backend\PagesRepository;
use App\Repositories\Backend\ImagesRepository;
use App\Repositories\Backend\CategoriesRepository;
use App\Repositories\Backend\ProductCategoryRepository;
use App\Repositories\Backend\ProductRepository;
use App\Repositories\Backend\VideosRepository;
use App\Repositories\Backend\PostsRepository;
use App\Repositories\Backend\ContactRepository;
use App\Http\Requests\Backend\ContactRequest;
use DB;
use DOMDocument;
use DOMXPath;

class IndexController extends Controller
{
	protected $pages, $images, $products,$videos, $cate, $posts, $cateProduct, $contact;

    public function __construct(PagesRepository $pages, ImagesRepository $images, ProductRepository $products, 
    CategoriesRepository $cate, PostsRepository $posts ,ProductCategoryRepository $cateProduct, VideosRepository $videos, 
    ContactRepository $contact)
    {
    	$this->pages = $pages;
        $this->images = $images;
        $this->products = $products;
        $this->cateProduct = $cateProduct;
        $this->cate = $cate;
        $this->posts = $posts;
        $this->videos = $videos;
        $this->contact = $contact;

    	$this->pages->seoGeneral();
    }

    public function getHome(Request $request)
    { 
        $contentHome = $this->pages->where('type', 'home')->first();
        
        $this->pages->createSeo($contentHome);
        
        $images = $this->images->getImageSlide();

        $slider = $images->where('type','slider');

        $newsHot = $this->posts->getPostsHotHome(4);

        $newsTb = $this->posts->getPostsTb();

        $cateHome = $this->cate->getCateHome();

        $products = $this->products->getProductHome(12);

        $videos = $this->videos->where('show',1)->orderBy('created_at','DESC')->get();
        
        return view('frontend.pages.home', compact('slider','contentHome','cateHome','newsHot','videos','products','newsTb'));
    }

    /* Sản phẩm */

    public function getListProducts()
    {
        $dataSeo = $this->pages->where('type', 'product')->first();

        $this->pages->createSeo($dataSeo);

        $collect = collect();

        $cateParent = $this->cate->with('get_child_cate')->where('parent_id',0)->get();

        foreach($cateParent as $item){

            $dataMerge = $item->get_child_cate()->with('CateProducts')->get();

            $collect = $collect->merge($dataMerge);
            
        }

        return view('frontend.pages.products', compact('dataSeo', 'collect'));
    }

    public function getCategoryProduct($slug)
    { 
        $dataSeo = $this->pages->where('type', 'product')->first();

        $data = $this->cate->where('slug', $slug)->first();

        $this->pages->createSeoPost($data);

        $cateChild = $data->get_child_cate()->get()->pluck('id')->toArray();

        array_push($cateChild,$data->id);

        $arrayProductId = $this->cateProduct->getProductId($cateChild);

        $products = $this->products->getProductByArrayId($arrayProductId,12);

        $category = $this->cate->getCateParent('product_category');

        return view('frontend.pages.cate-products', compact('dataSeo','data','products','category','slug'));
    }

    /* Tin tức */
    public function getListNews($id, $slug)
    {
        $data = $this->cate->where('id', $id)->where('slug',$slug)->first();

        $this->pages->createSeoPost($data);

        $posts = $data->News()->orderBy('created_at', 'DESC')->paginate(16);

        return view('frontend.pages.news', compact('data','posts'));
    }

    public function getSingleNews($id, $slug)
    {
        $dataSeo = $this->pages->where('type', 'news')->first();

        $data = $this->posts->where('status', 1)->where('id', $id)->where('slug',$slug)->first();

        $this->pages->createSeoPost($data);

        $id_cate = $data->category->pluck('id')->toArray();

        $new_related_id   = $this->posts->cateSame($id_cate);

        $postSame  = $this->posts->postSameCate($data->id, $new_related_id);

        $key = null;

        $postPre = null;

        $postNext = null;

        foreach($postSame as $k => $item)
        {
            if($data->id == $item->id)
            {
                $key = $k;

                break;
            }
        }

        if(isset($postSame[$k-1])){
            $postPre = $postSame[$k-1];
        }
        if(isset($postSame[$k+1])){
            $postNext = $postSame[$k+1];
        }

        $postHot = $this->posts->postsHot($data->id,7);

        $cateParent = $this->cate->getParentFirst($id_cate);

        return view('frontend.pages.single-new', compact('dataSeo', 'data', 'postSame','postHot','cateParent','postPre','postNext'));
    }

    public function getSingleProduct(Request $request, $slug)
    {
        $data = $this->products->with('category')->where('status', 1)->where('slug', $slug)->first();

        $this->pages->createSeoPost($data);

        $arrayCate = $data->category->pluck('id')->toArray();

        $category = $this->cate->getCateParent('product_category');

        $list_product_related   = $this->cateProduct->whereIn('id_category', $arrayCate)->get()->pluck('id_product')->toArray();

        $productSame  = $this->products->getProductSame($data->id, $list_product_related);
        
        return view('frontend.pages.single-product', compact('data', 'category', 'productSame'));
    }

    public function getListVideos()
    {
        $dataSeo = $this->pages->where('type', 'video')->first();

        $this->pages->createSeo($dataSeo);

        $data = $this->videos->orderBy('created_at','DESC')->get();

        return view('frontend.pages.videos', compact('dataSeo', 'data'));
    }

    /* Liên hệ */
    public function getContact()
    {
        $dataSeo = $this->pages->where('type', 'contact')->first();

        $this->pages->createSeo($dataSeo);

        $images = $this->images->getImageSlide();

        $slider = $images->where('type','slider');

        $partner = $images->where('type','partner')->first();

        return view('frontend.pages.contact', compact('dataSeo', 'slider', 'partner'));
    }

    public function postContact(ContactRequest $request)
    {
        $data = $this->contact->saveContact($request);

        return $data;
    }

    public function about(){

        $dataSeo = $this->pages->where('type', 'about')->first();

        $this->pages->createSeo($dataSeo);

        return view('frontend.pages.about',compact('dataSeo'));
    }

    /* Tìm kiếm */
    public function getSearch(Request $request)
    {
        $dataSeo = $this->pages->where('type', 'search')->first();

        $this->pages->createSeo($dataSeo);

        $products = $this->products->search($request);

        return view('frontend.pages.search', compact('dataSeo', 'products'));
    }

}


