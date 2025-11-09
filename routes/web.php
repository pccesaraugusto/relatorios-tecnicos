<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // adicione essa linha

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
