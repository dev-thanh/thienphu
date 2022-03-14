<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = [ 
        'name', 'name_en', 'slug', 'slug_en' , 'desc' , 'desc_en', 'content' , 'content_en' , 'image' ,
        'status' , 'show_home','tieubieu', 'hot', 'meta_title' , 'meta_description' , 'meta_keyword'
	];

	public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'news_category', 'id_news', 'id_category');
    }
}
