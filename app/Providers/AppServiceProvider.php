<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        // Menggunakan Tailwind CSS untuk pagination
        Paginator::useTailwind();
    }
}
