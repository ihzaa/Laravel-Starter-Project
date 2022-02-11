<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DeployController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [LoginController::class, 'loginGet'])->name('login.get')->middleware(['guest']);
    Route::post('login', [LoginController::class, 'loginPost'])->name('login.post')->middleware(['guest']);

    Route::get('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::get('deploy/kucingkucantikdanmanis', function () {
    $process = Process::fromShellCommandline('git reset --hard');
    $process->run(function ($type, $buffer) {
        echo $buffer;
    });
    $process = Process::fromShellCommandline('git pull');
    $process->run(function ($type, $buffer) {
        echo $buffer;
    });
    // $process = Process::fromShellCommandline('php artisan cache:clear');
    // $process->run(function ($type, $buffer) {
    //     echo $buffer;
    // });
    // $process = Process::fromShellCommandline('php artisan config:cache');
    // $process->run(function ($type, $buffer) {
    //     echo $buffer;
    // });
    // $process = Process::fromShellCommandline('php artisan route:cache');
    // $process->run(function ($type, $buffer) {
    //     echo $buffer;
    // });
    // $process = Process::fromShellCommandline('php artisan view:cache');
    // $process->run(function ($type, $buffer) {
    //     echo $buffer;
    // });
});
