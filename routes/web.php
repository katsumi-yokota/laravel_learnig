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
Route::get('contact/create','App\Http\Controllers\ContactController@create')->name('contact.create');
Route::post('contact','App\Http\Controllers\ContactController@store')->name('contact.store');

// ゲスト用
Route::get('/contact/{contact}/contact-interaction/{share_code}', 'App\Http\Controllers\GuestContactController@show')->name('contact-interaction.show');
Route::post('/contact/{contact}/contact-interaction', 'App\Http\Controllers\GuestContactController@store')->name('contact-interaction.store')->middleware('guest:web');

Route::group(['middleware' => 'auth'], function()
{
    Route::resource('/contact', 'App\Http\Controllers\ContactController');

    Route::get('contact/{contact}/download', 'App\Http\Controllers\ContactController@download')->name('contact.download');
    Route::get('contact/{contact}/preview', 'App\Http\Controllers\ContactController@preview')->where('contact', '[1-9][0-9]*')->name('contact.preview');
    Route::get('contact/{contact}', 'App\Http\Controllers\ContactController@show')->name('contact.show');
    Route::post('contact/{contact}/share-guest','App\Http\Controllers\ContactController@shareGuest')->name('contact.shareGuest');

    // 対応履歴
    Route::post('contact/{contact}/contact-response','App\Http\Controllers\ContactResponseController@store')->name('contact-response.store');
    // Route::post('contact/{contact}/contact-response','App\Http\Controllers\ContactResponseController@store')->name('contact-response.store')->withoutMiddleware(['auth']);
    Route::get('contact/{contact}/contact-response/{contact_response}/edit','App\Http\Controllers\ContactResponseController@edit')->name('contact-response.edit');
    Route::put('contact/{contact}/contact-response/{contact_response}','App\Http\Controllers\ContactResponseController@update')->name('contact-response.update');
    Route::patch('contact/{contact}/contact-response/{contact_response}','App\Http\Controllers\ContactResponseController@patch')->name('contact.patch');
    Route::delete('contact/{contact}/contact-response/{contact_response}','App\Http\Controllers\ContactResponseController@destroy')->name('contact-response.destroy');
}); 

// マスター管理者
Route::group(['middleware' => ['auth', 'can:isAdmin']], function()
{
    // ユーザー
    Route::resource('/user', 'App\Http\Controllers\UserController');
    Route::get('/user/restore/{trashed_user}', 'App\Http\Controllers\UserController@restore')->name('user.restore');
    Route::patch('/user/restore/{trashed_user}', 'App\Http\Controllers\UserController@restore')->name('user.restore');

    // カテゴリー
    Route::resource('/contact-category', 'App\Http\Controllers\ContactCategoryController');

    // タグ
    Route::resource('/contact-tag', 'App\Http\Controllers\ContactTagController');
});

// つぶやき
Route::resource('/post','App\Http\Controllers\PostController'); 

// ブログ
Route::resource('/article', 'App\Http\Controllers\ArticleController');

// 掲示板
Route::resource('/forum', 'App\Http\Controllers\ForumController');

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
