<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder Utama
 * Mengisi database dengan data dummy untuk testing dan pengembangan.
 * Jalankan dengan: php artisan db:seed
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MataKuliahSeeder::class,
            JadwalSeeder::class,
            AbsensiSeeder::class,
        ]);
    }
}
