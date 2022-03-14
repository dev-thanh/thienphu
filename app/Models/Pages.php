<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';

    protected $fillable = ['type','name_page','route','route_en','content','content_en','image','banner','title_h1','meta_title','meta_title_en','meta_description','meta_description_en','meta_keyword'];
}
