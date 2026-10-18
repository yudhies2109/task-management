<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/test-ui', 'test-ui');

Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');