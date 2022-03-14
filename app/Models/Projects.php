<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name','slug','desc','sort_desc','content','image','more_image','hot','status','meta_title','meta_description','meta_keyword'];

    public function Category()
    {
        return $this->belongsToMany('App\Models\Categories', 'project_category', 'id_project', 'id_category')->where('project_category.type','category');
    }
    public function Sophong()
    {
        return $this->belongsToMany('App\Models\Categories', 'project_category', 'id_project', 'id_category')->where('project_category.type','sophong');
    }
}
