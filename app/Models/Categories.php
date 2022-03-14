<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [ 'name', 'slug', 'parent_id','image', 'desc','status','order', 'meta_title', 'meta_description','type','show','status','level','display', 'meta_keyword'];


    public function get_child_cate()
    {
        return $this->hasMany('App\Models\Categories', 'parent_id', 'id')->with('get_child_cate');
    }

    public function getChildCateHome()
    {
        return $this->where('parent_id', $this->id)->orderBy('created_at','ASC')->take(2)->get();
    }

    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

    public function Products()
    {
        return $this->belongsToMany('App\Models\Products', 'product_category', 'id_category', 'id_product');
    }

    public function CateProducts()
    {
        return $this->belongsToMany('App\Models\Products', 'product_category', 'id_category', 'id_product');
    }

    public function News()
    {
        return $this->belongsToMany('App\Models\Posts', 'news_category', 'id_category', 'id_news');
    }
}
