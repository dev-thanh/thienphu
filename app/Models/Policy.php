<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table = 'policy';

   	protected $fillable = ['name','name_en','content','content_en','slug','slug_en','status'];
}
