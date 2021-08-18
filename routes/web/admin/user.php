<?php

use App\Http\Controllers\Admin\UserConfig\UserController;
use Illuminate\Support\Facades\Route;

const user_permission = 'user';

Route::prefix('admin/user_config/user')->name('admin.user_config.user.')->group(function () {
    Route::middleware(['permission:' . user_permission . ' view'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
    });
    Route::middleware(['permission:' . user_permission . ' create'])->group(function () {
        Route::get('create', [UserController::class, 'createGet'])->name('createGet');
        Route::post('create', [UserController::class, 'createPost'])->name('createPost');
    });
    Route::middleware(['permission:' . user_permission . ' update'])->group(function () {
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    });
    Route::middleware(['permission:' . user_permission . ' delete'])->group(function () {
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
    Route::middleware(['permission:' . user_permission . ' restore'])->group(function () {
        Route::get('restore/{id}', [UserController::class, 'restore'])->name('restore');
    });
});
