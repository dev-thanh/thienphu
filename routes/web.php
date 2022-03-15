<?php

use Illuminate\Support\Facades\Route;

// Frontend
Route::group(['namespace' => 'Frontend'], function () {

	/*  Trang chủ  */
	Route::get('/', 'IndexController@getHome')->name('home');

    // Tìm kiếm
    Route::get('/tim-kiem.html', 'IndexController@getSearch')->name('home.search');

    //Sản phẩm

    Route::get('san-pham', 'IndexController@getListProducts')->name('home.products');

    Route::get('/{slug}.xhtml', 'IndexController@getCategoryProduct')->name('home.cate-product');

    Route::get('/{slug}.html', 'IndexController@getSingleProduct')->name('home.single-product');

    /*  Giới thiệu  */
	Route::get('/gioi-thieu', 'IndexController@about')->name('home.about');

    //Tin tức
    Route::get('/tin-tuc/{id}/{slug}', 'IndexController@getListNews')->name('home.news');

    Route::get('/chi-tiet-tin-tuc/{id}/{slug}', 'IndexController@getSingleNews')->name('home.single-news');

    //Videos
    Route::get('/video', 'IndexController@getListVideos')->name('home.video');

    // Liên hệ

    Route::get('/lien-he', 'IndexController@getContact')->name('home.contact');

    Route::post('/post-contact', 'IndexController@postContact')->name('home.post-contact');

    

    // Route::get('/create-sitemap', 'IndexController@createSitemap');


});

// Backend

Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {

    	/* Trang chủ */
       	Route::get('/home', 'HomeController@index')->name('backend.home');

       	/* Tài khoản */
        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);

        //Danh mục sản phẩm
        Route::resource('category', 'CategoriesController', ['except' => ['show']]);

        // Sản phẩm
        Route::resource('products', 'ProductController', ['except' => ['show']]);

        Route::post('products/postMultiDel', ['as' => 'products.postMultiDel', 'uses' => 'ProductController@deleteMuti']);

        Route::get('products/get-slug', 'ProductController@getAjaxSlug')->name('products.get-slug');

        //Videos
        Route::resource('videos', 'VideosController', ['except' => ['show']]);

        /* Tin tức */
        Route::resource('category-post', 'CategoriesPostController', ['except' => ['show']]);
        Route::resource('posts', 'PostController', ['except' => ['show']]);
        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostController@deleteMuti']);
        Route::get('posts/get-slug', 'PostController@getAjaxSlug')->name('posts.get-slug');

        /* Liên hệ */
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', ['as' => 'get.list.contact', 'uses' => 'ContactController@getListContact']);
            Route::post('/delete-muti', ['as' => 'contact.postMultiDel', 'uses' => 'ContactController@postDeleteMuti']);
            Route::get('{id}/edit', ['as' => 'contact.edit', 'uses' => 'ContactController@getEdit']);
            Route::delete('{id}/delete', ['as' => 'contact.destroy', 'uses' => 'ContactController@getDelete']);
        });

        /* Cài đặt trang */
        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', ['as' => 'pages.list', 'uses' => 'PagesController@getListPages']);
            Route::get('build', ['as' => 'pages.build', 'uses' => 'PagesController@getBuildPages']);
            Route::post('build', ['as' => 'pages.build.post', 'uses' => 'PagesController@postBuildPages']);
            Route::post('/create', ['as' => 'pages.create', 'uses' => 'PagesController@postCreatePages']);
        });

        /* Cài đặt chung */
        Route::group(['prefix' => 'options'], function() {
            Route::get('/general', 'SettingController@getGeneralConfig')->name('backend.options.general');
            Route::post('/general', 'SettingController@postGeneralConfig')->name('backend.options.general.post');

            Route::get('/developer-config', 'SettingController@getDeveloperConfig')->name('backend.options.developer-config');
            Route::post('/developer-config', 'SettingController@postDeveloperConfig')->name('backend.options.developer-config.post');

            Route::get('/css-js-config', 'SettingController@cssJsConfig')->name('backend.options.css-js');
            Route::post('/css-js-config', 'SettingController@postCssJsConfig')->name('backend.options.css-js.post');

            Route::get('/smtp', 'SettingController@getSmtpConfig')->name('backend.options.smtp-config');
            Route::post('/smtp-config', 'SettingController@postSmtpConfig')->name('backend.options.smtp-config.post');
            Route::post('/send-mail-test', 'SettingController@postSendTestEmail')->name('backend.options.send-mail.post');
        });

        /* Cài đặt menu */
        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', ['as' => 'setting.menu', 'uses' => 'MenuController@getListMenu']);
            Route::get('edit/{id}', ['as' => 'backend.config.menu.edit', 'uses' => 'MenuController@getEditMenu']);
            Route::post('add-item/{id}', ['as' => 'setting.menu.addItem', 'uses' => 'MenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu.update', 'uses' => 'MenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu.delete', 'uses' => 'MenuController@getDelete']);
            Route::get('edit-item/{id}', ['as' => 'setting.menu.geteditItem', 'uses' => 'MenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu.editItem', 'uses' => 'MenuController@postEditItem']);
        });

        /* Slider */
        Route::resource('image', 'ImageController', ['except' => [
            'show'
        ]]);

        /* Get layout */
       	Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');

       	/* Cài đặt màu template */
       	Route::get('/save-color-setting', 'HomeController@saveColorSetting')->name('save-color-setting');

       	/* Get Notification */
       	Route::get('/get-notification', 'HomeController@getNotifications')->name('get-notifications');

       	// Route::get('/load-more-notification', 'HomeController@loadMoreNotifications')->name('load-more-notifications');


    });
});

/* Route Auth */
Auth::routes(
    [
        'register' => false,
        'verify' => false,
        'reset' => false,
    ]
);
