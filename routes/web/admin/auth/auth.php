<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/auth')->name('admin.auth.')->group(function () {
    Route::get('login', [AuthController::class, 'loginGet'])->name('login.get')->middleware(['guest']);
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post')->middleware(['guest']);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:admin');
});
