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

// Route::get('/', 'TestController@index');

/**
 * 后台路由
 */
Route::group(['prefix' => 'backed', 'namespace' => 'Backeds', 'middleware' => 'auth'], function () {
    
    Route::get('/', 'IndexController@index');

    /**
     * 微信自定义菜单
     */
    Route::get('wxmenu', 'WxmenusController@index'); // 菜单首页
    Route::get('wxmenu/create', 'WxmenusController@create'); // 创建菜单
    Route::get('wxmenu/create/{id}', 'WxSubMenusController@create'); // 创建子菜单
    Route::post('wxmenu/create', 'WxmenusController@store'); // 保存菜单
    Route::post('wxmenu/create/{id}', 'WxSubMenusController@store'); // 保存子菜单

    Route::get('wxmenu/edit/{id}', 'WxmenusController@edit'); // 修改菜单
    Route::get('wxmenu/edit/{id}/{subId}', 'WxSubMenusController@edit')->where(['id' => '[0-9]+', 'subId' => '[0-9]+']);; // 修改子菜单
    Route::post('wxmenu/edit/{id}', 'WxmenusController@update'); // 保存修改菜单
    Route::post('wxmenu/edit/{id}/{subId}', 'WxSubMenusController@update'); // 保存修改子菜单

    // 删除，暂时先用get方式，等配合ajax的时候再写成delete
    Route::get('wxmenu/delete/{id}', 'WxmenusController@destroy'); // 保存修改子菜单
    Route::get('wxmenu/delete/{id}/{subId}', 'WxSubMenusController@destroy'); // 保存修改子菜单

    Route::get('wxmenu/publish', 'WxmenusController@publish'); // 将菜单发布到微信

    /**
     * 海报活动
     */
    Route::get('poster', 'PostersController@index'); // 海报活动首页
    Route::get('poster/create', 'PostersController@create'); // 创建海报
    Route::post('poster', 'PostersController@store'); // 保存海报
    Route::get('poster/{poster}', 'PostersController@show'); // 显示海报详情
    Route::get('poster/{poster}/edit', 'PostersController@edit'); // 修改海报
    Route::post('poster/{poster}', 'PostersController@update'); // 保存修改海报
    Route::get('poster/{poster}/upload', 'PostersController@uploadShow'); // 修改海报
    Route::post('poster/{poster}/upload', 'PostersController@upload'); // 保存修改海报
    Route::get('poster/{poster}/delete', 'PostersController@destroy'); // 删除海报
    Route::get('poster/{poster}/preview', 'PostersController@preview'); // 预览海报图片

});

/**
 * 微信接口用路由
 */
Route::group(['prefix' => 'wxapi', 'namespace' => 'Wechats'], function () {
    Route::any('/', 'IndexController@index');
    Route::any('/serve', 'ServesController@index');
});
