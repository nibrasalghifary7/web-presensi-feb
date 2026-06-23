<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            ['nama_kelas' => 'Manajemen A', 'angkatan' => '2024', 'prodi' => 'Manajemen'],
            ['nama_kelas' => 'Manajemen B', 'angkatan' => '2024', 'prodi' => 'Manajemen'],
            ['nama_kelas' => 'Manajemen C', 'angkatan' => '2024', 'prodi' => 'Manajemen'],
            ['nama_kelas' => 'Akuntansi A', 'angkatan' => '2024', 'prodi' => 'Akuntansi'],
            ['nama_kelas' => 'Akuntansi B', 'angkatan' => '2024', 'prodi' => 'Akuntansi'],
            ['nama_kelas' => 'Manajemen A', 'angkatan' => '2025', 'prodi' => 'Manajemen'],
            ['nama_kelas' => 'Manajemen B', 'angkatan' => '2025', 'prodi' => 'Manajemen'],
            ['nama_kelas' => 'Akuntansi A', 'angkatan' => '2025', 'prodi' => 'Akuntansi'],
        ];

        foreach ($kelas as $k) {
            Kelas::firstOrCreate(
                ['nama_kelas' => $k['nama_kelas']],
                $k
            );
        }
    }
}
