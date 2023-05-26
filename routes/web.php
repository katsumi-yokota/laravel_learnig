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
Route::post('/contact/create', 'App\Http\Controllers\ContactController@upload')->name('contact.upload'); // ファイル添付
Route::get('contact/{contact}/download', 'App\Http\Controllers\ContactController@download')->name('contact.download'); // ファイルの動的なダウンロード

// つぶやき
Route::resource('/post','App\Http\Controllers\PostController'); 

// ユーザー
Route::resource('/user', 'App\Http\Controllers\UserController');
Route::get('/user/restore/{trashed_user}', 'App\Http\Controllers\UserController@restore')->name('user.restore'); // 論理削除の復元
Route::patch('/user/restore/{trashed_user}', 'App\Http\Controllers\UserController@restore')->name('user.restore'); // 論理削除の復元

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
