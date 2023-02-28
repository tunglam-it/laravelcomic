<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComicController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\NewsController;

Route::namespace('Admin')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.perform');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/home', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.login.logout');

        //route admin category
        Route::prefix('category')->name('admin.category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::get('/get-slug', [CategoryController::class, 'getSlug'])->name('slug');
            Route::post('/search', [CategoryController::class, 'searchAjax'])->name('search');

        });

        //route admin truyen comic
        Route::prefix('comic')->name('admin.comic.')->group(function () {
            Route::get('/', [ComicController::class, 'index'])->name('index');
            Route::get('/create', [ComicController::class, 'create'])->name('create');
            Route::post('/store', [ComicController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ComicController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ComicController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [ComicController::class, 'destroy'])->name('destroy');
            Route::get('/get-slug', [ComicController::class, 'getSlug'])->name('slug');
            Route::post('/search', [ComicController::class, 'searchAjax'])->name('search');

        });

        //route admin chapter
        Route::prefix('chapter')->name('admin.chapter.')->group(function () {
            Route::get('/', [ChapterController::class, 'index'])->name('index');
            Route::get('/create', [ChapterController::class, 'create'])->name('create');
            Route::post('/store', [ChapterController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ChapterController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ChapterController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [ChapterController::class, 'destroy'])->name('destroy');
            Route::get('/get-slug', [ChapterController::class, 'getSlug'])->name('slug');
            Route::post('/search', [ChapterController::class, 'searchAjax'])->name('search');
        });

        //route admin tin tuc
        Route::prefix('news')->name('admin.news.')->group(function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('/create', [NewsController::class, 'create'])->name('create');
            Route::post('/store', [NewsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [NewsController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [NewsController::class, 'destroy'])->name('destroy');
            Route::get('/get-slug', [NewsController::class, 'getSlug'])->name('slug');
            Route::post('/search', [NewsController::class, 'searchAjax'])->name('search');

        });
    });
});

