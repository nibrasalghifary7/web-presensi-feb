<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Dosen
 * Menyimpan data profil dosen pengajar.
 * NIDN (Nomor Induk Dosen Nasional) menjadi primary key.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->string('nidn', 20)->primary(); // NIDN sebagai Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama', 100); // Nama lengkap dosen
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('bidang_keahlian', 100)->nullable(); // Bidang keahlian dosen
            $table->timestamps();

            $table->index('nama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
