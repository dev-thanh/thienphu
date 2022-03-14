<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $table = 'videos';

    protected $fillable = ['name','url','desc','show','image','meta_title','meta_description','meta_keyword'];
}
