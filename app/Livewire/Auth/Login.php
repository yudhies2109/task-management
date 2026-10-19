<?php

namespace App\Livewire\Auth;

// Mengakses data pengguna melalui model User.
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

// Memeriksa kecocokan password input dengan hash di database.
use Illuminate\Support\Facades\Hash;

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

                // Mencari user berdasarkan email yang sudah divalidasi.
        $user = User::where('email', $validated['email'])->first();

        // Menolak login jika email tidak ditemukan atau password salah.
        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            // Mencatat kegagalan untuk membatasi percobaan login.
            RateLimiter::hit($key, 60);

            // Mengosongkan input password setelah login gagal.
            $this->reset('password');

            // Menampilkan pesan kesalahan kredensial.
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        // Memeriksa status akun setelah email dan password terbukti benar.
        if (! $user->is_active) {
            // Mencatat percobaan login pada akun nonaktif.
            RateLimiter::hit($key, 60);

            // Mengosongkan input password.
            $this->reset('password');

            // Menolak akun nonaktif tanpa membuat sesi login.
            throw ValidationException::withMessages([
                'email' => 'Akun Anda telah dinonaktifkan. Hubungi Admin.',
            ]);
        }

        // Melakukan login setelah kredensial benar dan akun dipastikan aktif.
        Auth::login($user);

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