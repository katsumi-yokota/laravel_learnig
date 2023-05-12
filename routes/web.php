<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// お問合せフォーム
Route::get('/contact/create','App\Http\Controllers\ContactController@create')->name('contact.create'); // ページを表示
Route::post('/contact/store','App\Http\Controllers\ContactController@store')->name('contact.store'); // 内容を保存
Route::get('/contact/index', 'App\Http\Controllers\ContactController@index')->name('contact.index'); // 一覧を表示

Route::resource('/post','App\Http\Controllers\PostController'); 