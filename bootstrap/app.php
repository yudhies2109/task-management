<?php

use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

// Membuat aplikasi dengan direktori utama project sebagai base path.
return Application::configure(basePath: dirname(__DIR__))
    // Menentukan file route web, perintah console, dan endpoint kesehatan aplikasi.
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // Mendaftarkan middleware aplikasi.
    ->withMiddleware(function (Middleware $middleware): void {
        // Memeriksa status aktif setelah middleware bawaan web,
        // sehingga sesi sudah tersedia saat pemeriksaan dilakukan.
        // Berlaku juga pada request Livewire yang menggunakan grup web.
        $middleware->web(append: [
            EnsureUserIsActive::class,
        ]);

        // Mendaftarkan nama pendek untuk membatasi route khusus Admin.
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
        ]);
    })
    // Mengatur format respons ketika terjadi exception.
    ->withExceptions(function (Exceptions $exceptions): void {
        // Menggunakan respons JSON untuk route API atau request yang meminta JSON.
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*')
                || $request->expectsJson(),
        );
    })
    // Menyelesaikan pembuatan instance aplikasi.
    ->create();