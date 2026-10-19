<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

// Memastikan pengguna yang sudah login masih berstatus aktif.
class EnsureUserIsActive
{
    // Memeriksa status akun sebelum request diteruskan.
    public function handle(Request $request, Closure $next): Response
    {
        // Mengambil pengguna yang sedang login.
        $user = $request->user();

        // Mengakhiri sesi jika akun pengguna sudah dinonaktifkan.
        if ($user && ! $user->is_active) {
            // Menghapus autentikasi pengguna dari sesi saat ini.
            Auth::guard('web')->logout();

            // Membatalkan sesi lama beserta data di dalamnya.
            $request->session()->invalidate();

            // Membuat token CSRF baru untuk sesi berikutnya.
            $request->session()->regenerateToken();

            // Mengarahkan pengguna ke halaman login dengan pesan kesalahan.
            return redirect('/login')->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Hubungi Admin.',
            ]);
        }

        // Melanjutkan request jika akun aktif atau pengunjung belum login.
        return $next($request);
    }
}