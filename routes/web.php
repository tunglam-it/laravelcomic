<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\NewsController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\ChangePasswordController;
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

//route client
Route::get('/',[HomeController::class,'index'])->name('client.home');
Route::get('/the-loai/{slug}',[HomeController::class,'clientCategory'])->name('client.category');
Route::get('/doc-truyen/{slug}',[HomeController::class,'clientDetailComic'])->name('client.comic.detail');
Route::get('/doc-truyen/{slug}/{slug_chapter}',[HomeController::class,'clientChapterComic'])->name('client.chapter');
Route::get('/tim-kiem/',[HomeController::class,'searchAjax'])->name('client.search');
Route::get('/yeu-thich/',[HomeController::class,'favorComic'])->name('client.favor');
Route::get('/tin-tuc/',[NewsController::class,'index'])->name('client.news');
Route::get('/tin-tuc/{slug}',[NewsController::class,'detail'])->name('client.news.detail');

Route::group(['middleware'=>'guest'],function (){
    Route::get('/dang-nhap',[LoginController::class,'show'])->name('client.login.show');
    Route::post('/dang-nhap',[LoginController::class,'login'])->name('client.login.perform');

    Route::get('/dang-ky',[RegisterController::class,'show'])->name('client.register.show');
    Route::post('/dang-ky',[RegisterController::class,'register'])->name('client.register.perform');
});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/dang-xuat',[LoginController::class,'logout'])->name('client.login.logout');
    Route::get('/thich-truyen',[HomeController::class,'handleFavorComic'])->name('client.favor.ajax');
    Route::get('/thong-tin-tai-khoan',[ChangePasswordController::class,'redirectUserInfo'])->name('client.info');
    Route::post('/thong-tin-tai-khoan',[ChangePasswordController::class,'changePassword'])->name('client.info.change');

});
