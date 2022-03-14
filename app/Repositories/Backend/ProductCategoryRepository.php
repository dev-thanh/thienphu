<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
       return ProductCategory::class;
    }

    public function getProductId($array){
        
        $data = $this->model->whereIn('id_category',$array)->get()->pluck('id_product')->toArray();

        return $data;
    }
}
