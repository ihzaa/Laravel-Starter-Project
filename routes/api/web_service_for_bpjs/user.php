<?php

use App\Http\Controllers\Web_Service_For_BPJS\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['WS_BPJS_Auth_Token'])->get('/bpjs/user', [AuthController::class, 'user']);
