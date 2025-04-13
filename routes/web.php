<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\PostAdminController;
use App\Http\Controllers\CategoryAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // ログインページ
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// TODO 表示側を作成

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    // 管理者管理
    Route::resource('users', UserController::class);

    // 投稿管理
    Route::resource('posts', PostAdminController::class)->names([
        'index'   => 'posts.index',
        'create'  => 'posts.create',
        'store'   => 'posts.store',
        'show'    => 'posts.show',
        'edit'    => 'posts.edit',
        'update'  => 'posts.update',
        'destroy' => 'posts.destroy',
    ]);

    // カテゴリー管理
    Route::resource('category', CategoryAdminController::class)->names([
        'index'   => 'category.index',
        'create'  => 'category.create',
        'store'   => 'category.store',
        'edit'    => 'category.edit',
        'update'  => 'category.update',
        'destroy' => 'category.destroy',
    ]);
});
