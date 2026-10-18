<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    // Menampung input login.
    public string $email = '';
    public string $password = '';

    public function login(): void
    {
        // Memvalidasi input.
        $validated = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Mengidentifikasi percobaan login berdasarkan email dan IP.
        $key = 'login:'.hash(
            'sha256',
            strtolower(trim($this->email)).'|'.request()->ip()
        );

        // Membatasi percobaan login gagal.
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        // Memeriksa kredensial dan melakukan login.
        if (! Auth::attempt($validated)) {
            RateLimiter::hit($key, 60);

            $this->reset('password');

            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        // Menghapus hitungan kegagalan setelah login berhasil.
        RateLimiter::clear($key);

        // Mengganti ID sesi setelah login.
        request()->session()->regenerate();

        // Mengarahkan pengguna setelah login berhasil.
        $this->redirectIntended(default: '/dashboard');
    }

    // Menampilkan form Login.
    public function render()
    {
        return view('livewire.auth.login');
    }
}