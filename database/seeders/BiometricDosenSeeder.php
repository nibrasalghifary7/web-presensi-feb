<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder untuk akun dosen biometrik (demo).
 * Akun ini digunakan untuk fitur "Masuk Instan Biometrik" di halaman login.
 */
class BiometricDosenSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['username' => 'biometric-dosen'],
            [
                'name' => 'Dr. Biometric Demo',
                'email' => 'biometric@uinjkt.ac.id',
                'password' => Hash::make('biometric123'),
                'role' => 'dosen',
                'is_active' => 1,
            ]
        );

        Dosen::firstOrCreate(
            ['nidn' => 'BIOMETRIK001'],
            [
                'user_id' => $user->id,
                'nama' => 'Dr. Biometric Demo',
                'email' => 'biometric@uinjkt.ac.id',
                'phone' => '081234567890',
                'bidang_keahlian' => 'Teknologi Informasi',
                'status_aktif' => 1,
            ]
        );
    }
}
