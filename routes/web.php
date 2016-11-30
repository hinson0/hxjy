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

/*** 老师 ***/
Route::group(['domain' => env('TEACHER_DOMAIN', 'laoshi.jiaoyu.com')], function () {
    Route::get('/', 'Teacher\SiteController@index')->name('teacher');
    Route::get('/test', 'Teacher\SiteController@test');
    Route::get('/reg', 'Teacher\SiteController@reg');
    Route::post('/doreg', 'Teacher\SiteController@doreg');
    Route::get('/login', 'Teacher\SiteController@login')->name('teacher.login');
    Route::post('/dologin', 'Teacher\SiteController@dologin');

    Route::group(['middleware' => 'teacher'], function () {
        Route::post('/dologout', 'Teacher\SiteController@dologout');
        Route::get('/home', 'Teacher\HomeController@index')->name('teacher.home');
        Route::get('/my', 'Teacher\HomeController@my');

        Route::get('/personal', 'Teacher\HomeController@personal');
        Route::get('/info/show', 'Teacher\InformationController@show');
        Route::post('/info/save', 'Teacher\InformationController@save');
        Route::resource('/exps', 'Teacher\ExperienceController');
        Route::resource('/features', 'Teacher\FeatureController');
        Route::resource('/cases', 'Teacher\CaseController');
        Route::resource('/schools', 'Teacher\SchoolController');
        Route::resource('/honours', 'Teacher\HonourController');
    });
});