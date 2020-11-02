<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/items');
});

Route::group(['prefix' => 'items'], function () {
    Route::get('/', 'ItemController@index')
        ->name('items.index');
    Route::get('/create', 'ItemController@createForm')
        ->name('items.createForm');
    Route::post('/create', 'ItemController@create')
        ->name('items.create');
    Route::get('/detail/{item_id}', 'ItemController@detail')
        ->where(['item_id' => '\d+'])
        ->name('items.detail');
    Route::get('/update/{item_id}', 'ItemController@updateForm')
        ->where(['item_id' => '\d+'])
        ->name('items.updateForm');
    Route::post('/update', 'ItemController@update')
        ->name('items.update');
    Route::post('/destroy/{item_id}', 'ItemController@destroy')
        ->where(['item_id' => '\d+'])
        ->name('items.destroy');
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('/', 'TagController@index')
        ->name('tags.index');
    Route::get('/create', 'TagController@createForm')
        ->name('tags.createForm');
    Route::post('/create', 'TagController@create')
        ->name('tags.create');
    Route::get('/update/{tag_id}', 'TagController@updateForm')
        ->where(['tag_id' => '\d+'])
        ->name('tags.updateForm');
    Route::post('/update', 'TagController@update')
        ->name('tags.update');
    Route::post('/destroy/{tag_id}', 'TagController@destroy')
        ->where(['tag_id' => '\d+'])
        ->name('tags.destroy');
});

Auth::routes(
    ['register' => false] // 完成時は削除して登録機能無効化
);
