<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Daftarkan service apapun ke container aplikasi.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap service apapun setelah registrasi.
     */
    public function boot(): void
    {
        // Force HTTPS di production (Railway/Cloudflare)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Menggunakan Tailwind CSS untuk pagination
        Paginator::useTailwind();
    }
}
