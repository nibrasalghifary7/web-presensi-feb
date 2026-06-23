<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk membatasi akses berdasarkan role pengguna.
 * Digunakan pada route group untuk Admin, Dosen, dan Mahasiswa.
 */
class CheckRole
{
    /**
     * Handle request - pastikan user memiliki role yang diizinkan.
     *
     * @param Request $request
     * @param Closure $next
     * @param string ...$roles Daftar role yang diizinkan (misal: 'admin', 'dosen', 'mahasiswa')
     * @return Response
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah role user termasuk dalam daftar role yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
