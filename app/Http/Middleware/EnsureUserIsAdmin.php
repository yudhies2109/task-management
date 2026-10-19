<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Menolak akses jika pengguna bukan Admin.
        if (! $request->user()?->isAdmin()) {
            abort(403, 'Halaman ini hanya dapat diakses oleh Admin.');
        }

        // Meneruskan permintaan jika pengguna adalah Admin.
        return $next($request);
    }
}