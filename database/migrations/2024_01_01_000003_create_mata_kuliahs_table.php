<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Mata Kuliah
 * Menyimpan daftar mata kuliah yang tersedia di program studi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id('id_mk');
            $table->string('kode_mk', 20)->unique(); // Kode mata kuliah (misal: MK001)
            $table->string('nama_mk', 100); // Nama mata kuliah
            $table->integer('sks'); // Jumlah SKS
            $table->string('semester', 10); // Semester (misal: Ganjil, Genap)
            $table->string('prodi', 50)->default('Manajemen'); // Program studi
            $table->timestamps();

            $table->index(['prodi', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
