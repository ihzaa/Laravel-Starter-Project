<?php

use App\Http\Controllers\Admin\UserConfig\PermissionController;
use Illuminate\Support\Facades\Route;

const permission_permission = 'Pengaturan_User_Perizinan';

Route::prefix('admin/user_config')->name('admin.user_config.')->group(function () {
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::middleware(['permission:' . permission_permission . ' view'])->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
        });
        Route::middleware(['permission:' . permission_permission . ' edit'])->group(function () {
            Route::post('update/{id}', [PermissionController::class, 'update'])->name('update');
        });
        Route::middleware(['permission:' . permission_permission . ' delete'])->group(function () {
            Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('delete');
        });
        Route::middleware(['permission:' . permission_permission . ' create'])->group(function () {
            Route::get('create', [PermissionController::class, 'createGet'])->name('createGet');
            Route::post('create', [PermissionController::class, 'createPost'])->name('createPost');
        });
    });
});
