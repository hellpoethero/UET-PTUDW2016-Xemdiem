<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','DiemController@index');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::group(['prefix' => 'namhoc'], function () {
        Route::get('/', 'NamHocController@index');
        Route::post('/', 'NamHocController@store');
        Route::delete('/{id}', 'NamHocController@destroy');
        Route::get('/{id}', 'NamHocController@show');
        Route::post('test', 'NamHocController@test');
    });

    Route::group(['prefix' => 'monhoc'], function() {
        Route::get('/', 'MonHocController@index');
        Route::post('/', 'MonHocController@store');
    });

    Route::group(['prefix'=>'lopmonhoc'], function() {
        Route::get('/', 'LopMonHocController@index');
        Route::post('/', 'LopMonHocController@store');
    });

    Route::group(['prefix'=>'diem'], function() {
        Route::get('/', 'DiemController@index');
        Route::post('/', 'DiemController@store');
    });

    Route::get('/sinhvien', 'SinhVienController@index');
});