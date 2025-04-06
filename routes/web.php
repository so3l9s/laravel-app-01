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

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    // 管理者管理
    Route::resource('users', UserController::class);

    // 投稿管理
    Route::resource('posts', PostAdminController::class)->names([
        'index'   => 'admin.posts.index',
        'create'  => 'admin.posts.create',
        'store'   => 'admin.posts.store',
        'show'    => 'admin.posts.show',
        'edit'    => 'admin.posts.edit',
        'update'  => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
    ]);

    // カテゴリー管理
    Route::resource('category', CategoryAdminController::class)->names([
        'index'   => 'admin.category.index',
        'create'  => 'admin.category.create',
        'store'   => 'admin.category.store',
        'edit'    => 'admin.category.edit',
        'update'  => 'admin.category.update',
        'destroy' => 'admin.category.destroy',
    ]);
});
