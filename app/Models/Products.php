<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = ['sku','name', 'slug', 'desc', 'price', 'sale_price', 'content' ,'image', 'more_image','file', 'is_new', 'hot','status','review','selling','meta_title','meta_description','meta_keyword'];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'product_category', 'id_product', 'id_category');
    }
}
