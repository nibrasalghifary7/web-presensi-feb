<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

/**
 * Seeder untuk data Mata Kuliah.
 */
class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mataKuliahs = [
            ['kode_mk' => 'MNJ001', 'nama_mk' => 'Sistem Informasi Manajemen', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'MNJ002', 'nama_mk' => 'Manajemen Keuangan', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'MNJ003', 'nama_mk' => 'Manajemen Pemasaran', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'MNJ004', 'nama_mk' => 'Manajemen Sumber Daya Manusia', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'MNJ005', 'nama_mk' => 'Ekonomi Mikro', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'AKT001', 'nama_mk' => 'Akuntansi Keuangan Menengah', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'AKT002', 'nama_mk' => 'Akuntansi Biaya', 'sks' => 3, 'semester' => 'Ganjil'],
            ['kode_mk' => 'MNJ006', 'nama_mk' => 'Kewirausahaan', 'sks' => 2, 'semester' => 'Genap'],
            ['kode_mk' => 'MNJ007', 'nama_mk' => 'Manajemen Strategik', 'sks' => 3, 'semester' => 'Genap'],
            ['kode_mk' => 'MNJ008', 'nama_mk' => 'Metodologi Penelitian', 'sks' => 3, 'semester' => 'Genap'],
        ];

        foreach ($mataKuliahs as $mk) {
            MataKuliah::create(array_merge($mk, ['prodi' => 'Manajemen']));
        }
    }
}
