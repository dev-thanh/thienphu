<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\ProductRepositoryInterface;
use View;
use App\Models\Products;
use App\Http\Requests\Backend\ProductsEditRequest;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function __construct(Products $products)
    {
        $this->model = $products;
    }
    
    public function model()
    {
        return $this->model;
    }

    public function getProductHome($take)
    {
        $data = $this->model->where('status',1)->take($take)->get();

        return $data;
    }

    public function getProductsHot()
    {
        $data = $this->model->where(['status' => 1, 'hot' => 1])->take(3)->get();

        return $data;
    }

    public function getProductByArrayId($array,$take)
    {
        $data = $this->model->whereIn('id',$array)->orderBy('created_at','DESC')->paginate($take);

        return $data;
    }


    public function getProductsByFields($array=['status' => 1], $take=1)
    {
    	$data = $this->model->where($array)->orderBy('created_at','DESC')->take($take)->get();

        return $data;
    }

    public function getSlug($slug, $type, $id)
    {
    	return $this->model->where('id', '!=', $id)->where($type, $slug)->count();
    }

    public function search($request)
    {
    	$products = collect();

    	if($request->search){

            $products = $this->model->where('status',1)->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->orderBy('created_at', 'DESC')->paginate(12);

        }

        return $products;
    }

    public function productsByField($field)
    {
        $take = 12;

        $data = $this->model->select('id','name','slug','image','price','sale_price')->where('status',1)->where($field,1)->orderBy('created_at','DESC')->paginate($take);

        return $data;
    }

    public function getProductSame($id, $array)
    {
    	$data = $this->model->where('id', '!=', $id)->where('status', 1)
        ->whereIn('id', $array)->orderBy('created_at', 'DESC')->take(4)->get();

        return $data;
    }

    
}
