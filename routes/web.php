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

Auth::routes();

Route::group(['prefix'=>'backed','namespace'=>'Backeds','middleware'=>'auth'],function(){
	Route::get('/', 'IndexController@index');
	Route::get('menu','MenusController@all');
});

Route::group(['prefix'=>'wxapi','namespace'=>'Wechats'],function(){
	Route::any('/', 'IndexController@index');
	Route::any('/serve', 'ServesController@index');
});


