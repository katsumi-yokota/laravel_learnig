<?php

use App\Http\Controllers\ProfileController;
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
Route::get('/contact/index', 'App\Http\Controllers\ContactController@index')->middleware('auth')->name('contact.index'); 
// 一覧を表示 // ログインユーザーのみアクセス可能

// つぶやき
Route::resource('/post','App\Http\Controllers\PostController'); 

// ユーザー
Route::resource('/user', 'App\Http\Controllers\UserController');

Route::get('/dashboard', function () 
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
