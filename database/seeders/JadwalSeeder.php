<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

/**
 * Seeder untuk data Jadwal Kuliah.
 */
class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            // Senin
            ['id_mk' => 1, 'nidn' => '0123456789', 'hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30', 'ruang' => 'Teater FEB Lt.2', 'kelas' => 'Manajemen A', 'semester_aktif' => '2024/2025 Ganjil'],
            ['id_mk' => 5, 'nidn' => '0123456790', 'hari' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '15:30', 'ruang' => 'Ruang 301', 'kelas' => 'Manajemen A', 'semester_aktif' => '2024/2025 Ganjil'],

            // Selasa
            ['id_mk' => 2, 'nidn' => '0123456789', 'hari' => 'Selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30', 'ruang' => 'Ruang 302', 'kelas' => 'Manajemen B', 'semester_aktif' => '2024/2025 Ganjil'],
            ['id_mk' => 3, 'nidn' => '0123456790', 'hari' => 'Selasa', 'jam_mulai' => '13:00', 'jam_selesai' => '15:30', 'ruang' => 'Teater FEB Lt.2', 'kelas' => 'Manajemen B', 'semester_aktif' => '2024/2025 Ganjil'],

            // Rabu
            ['id_mk' => 6, 'nidn' => '0123456791', 'hari' => 'Rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30', 'ruang' => 'Ruang 303', 'kelas' => 'Manajemen A', 'semester_aktif' => '2024/2025 Ganjil'],
            ['id_mk' => 4, 'nidn' => '0123456789', 'hari' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '15:30', 'ruang' => 'Ruang 304', 'kelas' => 'Manajemen A', 'semester_aktif' => '2024/2025 Ganjil'],

            // Kamis
            ['id_mk' => 1, 'nidn' => '0123456789', 'hari' => 'Kamis', 'jam_mulai' => '09:00', 'jam_selesai' => '11:30', 'ruang' => 'Teater FEB Utama', 'kelas' => 'Manajemen B', 'semester_aktif' => '2024/2025 Ganjil'],

            // Jumat
            ['id_mk' => 7, 'nidn' => '0123456791', 'hari' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30', 'ruang' => 'Ruang 305', 'kelas' => 'Manajemen A', 'semester_aktif' => '2024/2025 Ganjil'],
        ];

        foreach ($jadwals as $j) {
            Jadwal::create($j);
        }
    }
}
