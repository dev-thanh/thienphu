<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $table = 'project_category';
    
    protected $fillable = [ 
    	'id_category', 'id_project', 'type'
	];
}
