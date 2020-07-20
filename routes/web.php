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

Route::get('/', function () {
    return view('welcome');
});

// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        Route::get('post/create', 'PostController@add'); //追加
        Route::post('post/create', 'PostController@create'); //追加
        Route::get('post', 'PostController@index'); //追加
        Route::get('post/edit', 'PostController@edit'); //追加
        Route::post('post/edit', 'PostController@update'); //追加
        Route::post('post/delete', 'PostController@delete'); //追加
    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });

});
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// ロケーション管理者
Route::namespace('Location')->prefix('location')->name('location.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:location')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });

});