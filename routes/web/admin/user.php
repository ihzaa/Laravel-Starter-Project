<?php

use App\Http\Controllers\Admin\UserConfig\UserController;
use Illuminate\Support\Facades\Route;

const user_permission = 'user';

Route::prefix('admin/user_config/user')->name('admin.user_config.user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});
