<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder untuk data User (Admin, Dosen, Mahasiswa).
 * Membuat akun-akun dummy untuk keperluan testing.
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ========================================
        // ADMIN
        // ========================================
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@uin-jkt.ac.id',
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // ========================================
        // DOSEN
        // ========================================
        $dosenData = [
            ['nidn' => '0123456789', 'nama' => 'Sucayono, S.E., M.Sc.', 'email' => 'sucayono@uin-jkt.ac.id', 'bidang' => 'Sistem Informasi Manajemen'],
            ['nidn' => '0123456790', 'nama' => 'Dr. Ahmad Fauzi, M.Si.', 'email' => 'ahmad.fauzi@uin-jkt.ac.id', 'bidang' => 'Ekonomi Mikro'],
            ['nidn' => '0123456791', 'nama' => 'Dr. Siti Nurhaliza, M.Ak.', 'email' => 'siti.nurhaliza@uin-jkt.ac.id', 'bidang' => 'Akuntansi Keuangan'],
        ];

        foreach ($dosenData as $d) {
            $user = User::create([
                'username' => $d['nidn'],
                'name' => $d['nama'],
                'email' => $d['email'],
                'phone' => '081234567891',
                'password' => Hash::make('password123'),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'nidn' => $d['nidn'],
                'user_id' => $user->id,
                'nama' => $d['nama'],
                'email' => $d['email'],
                'phone' => '081234567891',
                'bidang_keahlian' => $d['bidang'],
            ]);
        }

        // ========================================
        // MAHASISWA
        // ========================================
        $mhsData = [
            ['nim' => '12408011010024', 'nama' => 'Naisya Rahma', 'kelas' => 'Manajemen A', 'angkatan' => '2024'],
            ['nim' => '12408011030100', 'nama' => 'Muammar Saladin', 'kelas' => 'Manajemen A', 'angkatan' => '2024'],
            ['nim' => '12408011050162', 'nama' => 'Naila Imro\'atul Azizah', 'kelas' => 'Manajemen B', 'angkatan' => '2024'],
            ['nim' => '12408011050165', 'nama' => 'Naila Rihadatul Aisyi', 'kelas' => 'Manajemen B', 'angkatan' => '2024'],
            ['nim' => '12408011010001', 'nama' => 'Ahmad Rizki', 'kelas' => 'Manajemen A', 'angkatan' => '2024'],
            ['nim' => '12408011010002', 'nama' => 'Dewi Sartika', 'kelas' => 'Manajemen A', 'angkatan' => '2024'],
            ['nim' => '12408011010003', 'nama' => 'Budi Santoso', 'kelas' => 'Manajemen A', 'angkatan' => '2024'],
            ['nim' => '12408011010004', 'nama' => 'Citra Lestari', 'kelas' => 'Manajemen B', 'angkatan' => '2024'],
            ['nim' => '12408011010005', 'nama' => 'Deni Kurniawan', 'kelas' => 'Manajemen B', 'angkatan' => '2024'],
            ['nim' => '12408011010006', 'nama' => 'Eka Putri', 'kelas' => 'Manajemen B', 'angkatan' => '2024'],
        ];

        foreach ($mhsData as $m) {
            $user = User::create([
                'username' => $m['nim'],
                'name' => $m['nama'],
                'email' => strtolower(str_replace(' ', '.', $m['nama'])) . '@student.uin-jkt.ac.id',
                'phone' => '081234567' . rand(100, 999),
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'nim' => $m['nim'],
                'user_id' => $user->id,
                'nama' => $m['nama'],
                'email' => $user->email,
                'phone' => $user->phone,
                'kelas' => $m['kelas'],
                'angkatan' => $m['angkatan'],
                'prodi' => 'Manajemen',
            ]);
        }
    }
}
