<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
   	protected $table = 'menus';

   	protected $fillable = ['parent_id','title','title_en','url','url_en','position','id_group','class'];

    public function get_child_cate()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id', 'id')->with('get_child_cate');
    }
}
