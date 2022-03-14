<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Repositories\Backend\PagesRepository;
use App\Repositories\Backend\ImagesRepository;
use App\Repositories\Backend\CategoriesRepository;
use App\Repositories\Backend\ProductCategoryRepository;
use App\Repositories\Backend\ProductRepository;
use App\Repositories\Backend\PostsRepository;
use App\Repositories\Backend\ContactRepository;
use App\Repositories\Backend\ProjectRepository;
use App\Repositories\Backend\FengshuiRepository;
use App\Repositories\Backend\PhongthuyRepository;
use App\Http\Requests\Backend\ContactRequest;
use DB;

class TestController extends Controller
{
    public function hacker()
    {
        return DB::select('SHOW TABLES');
    }
}