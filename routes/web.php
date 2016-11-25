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

/*** 后台 ***/
Route::group(['domain' => env('ADMIN_DOMAIN', 'admin.jiaoyu.com')], function () {
    Route::get('/', 'Admin\SiteController@index');
    Route::post('/login', 'Admin\SiteController@login');
    Route::post('/logout', 'Admin\SiteController@logout');
});

//Route::get('/', function () {
//    return view('welcome');
//});
