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

//后台
Route::group(['namespace'=>'Admin','prefix'=>'aadmin'],function(){
    // 登录页面
    Route::get('/login','LoginController@getLogin');
    // 登录操作
    Route::post('/dologin', 'LoginController@postLogin');
    // 首页
    Route::get('/','IndexController@index')->middleware('login');
    // 欢迎页
    Route::get('/welcome','IndexController@welcome')->middleware('login');
    // 注销
    Route::get('/loginout','LoginController@loginOut');

    Route::group(['prefix'=>'user','middleware'=>'login'],function(){
        // 用户列表页
        Route::get('/','UserController@index');
        // 添加用户
        Route::get('/create','UserController@create');
        // 添加用户操作
        Route::post('/','UserController@store');
        // 修改用户
        Route::get('/{id}/edit','UserController@edit');
        // 修改用户操作
        Route::put('/{id}','UserController@update');
        // 删除用户操作
        Route::delete('/{id}','UserController@destroy');
        // 批量删除用户操作
        Route::post('/destroy', 'UserController@destroyAll');
    });

    Route::group(['prefix'=>'articel','middleware'=>'login'],function(){
        // 文章列表页
        Route::get('/','ArticelController@index');
        // 添加文章
        Route::get('/create','ArticelController@create');
        // 添加文章操作
        Route::post('/','ArticelController@store');
        // 图片添加操作
        Route::post('/{iamge}','ArticelController@image');
        // 文章修改页
        Route::get('/{id}/edit','ArticelController@edit');
        // 文章修改操作
        Route::put('/{id}','ArticelController@update');
        // 文章删除操作
        Route::delete('/{id}','ArticelController@destroy');
    });

    Route::group(['prefix'=>'ip','middleware'=>'login'],function(){
        // ip 列表页
        Route::get('/','IpController@index');
        // 删除ip
        Route::delete('/{id}','IpController@destroy');
    });
});

// 前台
Route::group(['namespace'=>'Home'],function(){
    // qq登录
    Route::get('/mycb','QController@QQLogin');
    // 首页
    Route::get('/','IndexController@index');

    // 留言页
    Route::get('/release','ReleaseController@index');
    // 留言操作页
    Route::post('/', 'ReleaseController@store');
    // 关于页
    Route::get('/about','AboutController@index');

    // 详情页
    Route::group(['prefix'=>'detial'],function(){
        // 详情页
        Route::get('/{id}','DetialController@index');
        // 评论操作
        Route::post('/{id}','DetialController@create');
    });
});



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
