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

Route::get('/','LopMonHocController@index');

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
        Route::post('/{id}/active', 'NamHocController@changeActive');
    });

    Route::group(['prefix'=>'lopmonhoc'], function() {
        Route::get('/', 'LopMonHocController@index');
        Route::post('/', 'LopMonHocController@addLHMFile');
        Route::get('/{id}', 'LopMonHocController@show');
        Route::post('/{id}/upload', 'LopMonHocController@addLHMDiem');
        Route::post('/{id}', 'LopMonHocController@edit');
    });

    Route::group(['prefix'=>'hocky'], function() {
        Route::post('/', 'HocKyNamHocController@create');
        Route::delete('/{id}', 'HocKyNamHocController@delete');
    });
});

Route::group(['prefix'=>'get'], function() {
    Route::get('/', 'getDataController@getData');
});