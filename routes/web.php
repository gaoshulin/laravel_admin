<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','IndexController@index');

//项目路由
Route::group(['middleware' => ['web']], function () {
    Route::any('index/index', 'IndexController@index'); //首页
    Route::any('index/details/{id}', 'IndexController@details'); //详情
    Route::any('php/index', 'PhpController@index'); //php
    Route::any('web/index', 'WebController@index'); //php
    Route::any('mysql/index', 'MysqlController@index'); //php
    Route::any('linux/index', 'LinuxController@index'); //php
    Route::any('information/index', 'Information@index'); //php

});
