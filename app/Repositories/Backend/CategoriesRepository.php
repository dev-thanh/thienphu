<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\CategoriesRepositoryInterface;
use App\Models\Categories;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Categories::class;
    }
    
    public function getCategories($type, $order)
    {
    	$data  = $this->model->with('get_child_cate')->where('type', $type)->orderBy('created_at',$order)->get();

    	return $data;
    }

    public function getCateProduct()
    {
        $data  = $this->model->with('get_child_cate')->where('type', 'product_category')->orderBy('created_at','DESC')->get();

    	return $data;
    }

    public function getCateProject()
    {
        $data  = $this->model->where(['type' => 'project_category','parent_id' => 0])->orderBy('created_at','DESC')->get();

    	return $data;
    }

    public function getCatePost()
    {
        $data  = $this->model->with('get_child_cate')->where('type', 'post_category')->orderBy('created_at','DESC')->get();

    	return $data;
    }

    public function getCateHome()
    {
        $data = $this->model->where('show',1)->where('type','product_category')->take(3)->get();

        return $data;
    }

    public function getCateParent($type)
    {
        $data = $this->model->where([
            'parent_id' => 0,
            'type' => $type
        ])->orderBy('created_at','ASC')->get();

        return $data;
    }

    public function getParentFirst($array)
    {
        $data = $this->model->where(['type'=>'post_category','parent_id'=>0])->whereIn('id',$array)->first();

        return $data;
    }

    public function getCateNotId($id, $type)
    {
        $data = $this->model->where('id', '!=', $id)->where('type', $type)->get();

        return $data;
    }
}
