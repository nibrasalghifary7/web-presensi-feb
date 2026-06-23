<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Mahasiswa
 * Menyimpan data profil mahasiswa yang terhubung dengan tabel users.
 * NIM menjadi primary key sekaligus foreign key ke tabel users (username).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim', 20)->primary(); // NIM sebagai Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama', 100); // Nama lengkap mahasiswa
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('kelas', 20); // Kelas (misal: Manajemen A, Akuntansi B)
            $table->string('angkatan', 10); // Tahun angkatan (misal: 2024)
            $table->string('prodi', 50)->default('Manajemen'); // Program studi
            $table->timestamps();

            // Index untuk pencarian berdasarkan kelas dan angkatan
            $table->index(['kelas', 'angkatan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
