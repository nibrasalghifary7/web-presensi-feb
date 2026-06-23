<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Users
 * Menyimpan data autentikasi untuk semua role (Admin, Dosen, Mahasiswa).
 * Field 'role' menentukan hak akses pengguna ke sistem.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique(); // NIM untuk mahasiswa, NIP untuk dosen, username untuk admin
            $table->string('password', 255);
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->default('mahasiswa');
            $table->string('name', 100); // Nama lengkap pengguna
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable(); // Nomor HP
            $table->rememberToken();
            $table->timestamps();

            // Index untuk pencarian berdasarkan role
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
