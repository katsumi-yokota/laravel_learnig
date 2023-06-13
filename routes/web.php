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
Route::get('contact/create','App\Http\Controllers\ContactController@create')->name('contact.create'); // ページを表示
Route::post('contact','App\Http\Controllers\ContactController@store')->name('contact.store'); // 内容を保存

Route::group(['middleware' => 'auth'], function()
{
    Route::get('contact', 'App\Http\Controllers\ContactController@index')->name('contact.index'); 
    Route::get('contact/{contact}/download', 'App\Http\Controllers\ContactController@download')->name('contact.download'); // ファイルの動的なダウンロード
    Route::get('contact/{contact}/preview', 'App\Http\Controllers\ContactController@preview')->where('contact', '[1-9][0-9]*')->name('contact.preview'); // ファイルの動的なプレビュー
    Route::get('contact/{contact}', 'App\Http\Controllers\ContactController@show')->name('contact.show'); // 詳細

    // 対応履歴
    Route::post('contact/{contact}/contact-response','App\Http\Controllers\ContactResponseController@store')->name('contact-response.store');
    Route::get('contact/{contact}/contact-response/{contact_response}/edit','App\Http\Controllers\ContactResponseController@edit')->name('contact-response.edit');
    Route::put('contact/{contact}/contact-response/{contact_response}','App\Http\Controllers\ContactResponseController@update')->name('contact-response.update');
    Route::delete('contact/{contact}/contact-response/{contact_response}','App\Http\Controllers\ContactResponseController@destroy')->name('contact-response.destroy');
});

// お問合せフォームのカテゴリー
Route::resource('/contact-category', 'App\Http\Controllers\ContactCategoryController')->middleware('auth');

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
