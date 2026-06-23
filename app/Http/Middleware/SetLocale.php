<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk mengatur bahasa aplikasi berdasarkan session.
 * Dijalankan di setiap request sebelum controller.
 */
class SetLocale
{
    /**
     * Handle request.
     * Mengatur locale aplikasi dari session atau default ke 'id'.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil locale dari session, default ke 'id' (Indonesia)
        $locale = Session::get('locale', 'id');

        // Validasi locale
        if (in_array($locale, ['id', 'en'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
