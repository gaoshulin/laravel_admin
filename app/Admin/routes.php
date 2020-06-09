<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),

], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    //路由器
    $router->resource('users', UserController::class);
        $router->resource('/banner', 'BannerController');
    $router->resource('/category', 'CategoryController');
    $router->resource('/post', 'PostController');

});
