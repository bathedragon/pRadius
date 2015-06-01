<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::pattern('username','[a-z0-9A-Z]+');

Route::get('/','Frontend\Home@index');
Route::get('session/new','Auth\Session@index');
Route::post('session/new','Auth\Session@login');
Route::post('session/destroy','Auth\Session@destroy');

Route::controller('plan','Frontend\Plan');

Route::group(['prefix' => 'member' ,'middleware' => 'member'],function() {
    Route::get('profile/{username}','Auth\Session@profile');
});

Route::group(['prefix' => 'admin' ,'middleware' => 'administrator'],function() {
    Route::controller('plan','Backend\Plan');
    Route::resource('plan','Backend\Plan');
    Route::controller('member','Backend\Member');
    Route::resource('member','Backend\Member');
    Route::controller('report','Backend\Report');
    Route::controller('graph','Backend\Graphs');
});


