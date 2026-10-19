<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/test-ui', 'test-ui');

Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::view('/dashboard', 'dashboard')
    ->middleware('auth')
    ->name('dashboard');

    // Logout
    
Route::post('/logout', function (Request $request) {
    // Mengakhiri autentikasi pengguna.
    Auth::logout();

    // Menghapus data sesi dan mengganti ID sesi.
    $request->session()->invalidate();

    // Membuat token CSRF baru.
    $request->session()->regenerateToken();

    // Kembali ke halaman Login.
    return redirect()->route('login');
})->middleware('auth')->name('logout');

// TES Khusus Admin
Route::view('/admin/dashboard', 'admin.dashboard')
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');