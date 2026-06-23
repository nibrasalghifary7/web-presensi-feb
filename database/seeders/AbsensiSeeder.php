<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use Carbon\Carbon;

/**
 * Seeder untuk data Absensi dummy.
 * Membuat riwayat kehadiran untuk testing.
 */
class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        // Data absensi untuk mahasiswa pertama (Naisya Rahma)
        $nim = '12408011010024';
        $statuses = ['Hadir', 'Hadir', 'Izin', 'Hadir', 'Alpha', 'Hadir', 'Sakit', 'Hadir', 'Hadir', 'Hadir'];

        for ($i = 0; $i < 10; $i++) {
            Absensi::create([
                'nim' => $nim,
                'id_jadwal' => ($i % 2) + 1, // Alternating jadwal 1 dan 2
                'tanggal' => Carbon::now()->subDays($i * 3),
                'jam_masuk' => $statuses[$i] === 'Hadir' ? '08:05' : null,
                'status' => $statuses[$i],
                'validasi' => 'divalidasi',
            ]);
        }

        // Data absensi untuk mahasiswa kedua (Muammar Saladin)
        $nim2 = '12408011030100';
        $statuses2 = ['Hadir', 'Hadir', 'Hadir', 'Izin', 'Hadir', 'Hadir', 'Hadir', 'Alpha', 'Hadir', 'Hadir'];

        for ($i = 0; $i < 10; $i++) {
            Absensi::create([
                'nim' => $nim2,
                'id_jadwal' => ($i % 2) + 1,
                'tanggal' => Carbon::now()->subDays($i * 3),
                'jam_masuk' => $statuses2[$i] === 'Hadir' ? '08:03' : null,
                'status' => $statuses2[$i],
                'validasi' => 'divalidasi',
            ]);
        }
    }
}
