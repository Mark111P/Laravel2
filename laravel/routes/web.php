<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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
Route::get('/hello', function () {
    return view('hello');
});
Route::get('/login/code', [LoginController::class, 'code'])->name('login.code');
Route::post('/login/verify', [LoginController::class, 'verify'])->name('login.verify');
Route::post('/news/logout', [NewsController::class, 'logout'])->name('news.logout');
Route::post('/news/comment', [NewsController::class, 'comment'])->name('news.comment');
Route::get('/news/category', [NewsController::class, 'category'])->name('news.category');
Route::get('/news/add_category', [NewsController::class, 'add_category'])->name('news.add_category');
Route::resource('news', NewsController::class);
Route::resource('login', LoginController::class);
