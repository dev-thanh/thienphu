<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Backend\OptionsRepositoryInterface::class, \App\Repositories\Backend\OptionsRepository::class);
        $this->app->bind(\App\Repositories\Backend\PagesRepositoryInterface::class, \App\Repositories\Backend\PagesRepository::class);
        $this->app->bind(\App\Repositories\Backend\ImagesRepositoryInterface::class, \App\Repositories\Backend\ImagesRepository::class);
        $this->app->bind(\App\Repositories\Backend\ContactRepositoryInterface::class, \App\Repositories\Backend\ContactRepository::class);
        $this->app->bind(\App\Repositories\Backend\MenuRepositoryInterface::class, \App\Repositories\Backend\MenuRepository::class);
        $this->app->bind(\App\Repositories\Backend\UserRepositoryInterface::class, \App\Repositories\Backend\UserRepository::class);
        $this->app->bind(\App\Repositories\Backend\ProductRepositoryInterface::class, \App\Repositories\Backend\ProductRepository::class);
        $this->app->bind(\App\Repositories\Backend\CategoriesRepositoryInterface::class, \App\Repositories\Backend\CategoriesRepository::class);
        $this->app->bind(\App\Repositories\Backend\ProductCategoryRepositoryInterface::class, \App\Repositories\Backend\ProductCategoryRepository::class);
        $this->app->bind(\App\Repositories\Backend\PostsRepositoryInterface::class, \App\Repositories\Backend\PostsRepository::class);
        $this->app->bind(\App\Repositories\Backend\VideosRepositoryInterface::class, \App\Repositories\Backend\VideosRepository::class);
        //:end-bindings:
    }
}
