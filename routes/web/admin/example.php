<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('tes', function () {
    // iniTestingAja();
    $usr = new User;
    $usr->name = '123';
    $usr->username = '123';
    $usr->save();
    return $usr;
});

// INI ADALAH CONTOH FILE ROUTE
// JIKA INGIN MENAMBAHKAN SILAHAKAN SEPERTI INI
