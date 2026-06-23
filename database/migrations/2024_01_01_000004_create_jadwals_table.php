<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Jadwal
 * Menyimpan jadwal perkuliahan yang mencakup mata kuliah, dosen, hari, dan jam.
 * Satu mata kuliah bisa memiliki beberapa jadwal (misal: praktikum + teori).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_mk');
            $table->string('nidn', 20);
            $table->foreign('id_mk')->references('id_mk')->on('mata_kuliahs')->onDelete('cascade');
            $table->foreign('nidn')->references('nidn')->on('dosens')->onDelete('cascade');
            $table->string('hari', 20); // Hari kuliah (Senin, Selasa, dst.)
            $table->time('jam_mulai'); // Jam mulai perkuliahan
            $table->time('jam_selesai'); // Jam selesai perkuliahan
            $table->string('ruang', 50)->nullable(); // Ruang kelas
            $table->string('kelas', 20); // Kelas (misal: Manajemen A)
            $table->string('semester_aktif', 20); // Semester aktif (misal: 2024/2025 Ganjil)
            $table->timestamps();

            // Index untuk pencarian jadwal berdasarkan hari dan dosen
            $table->index(['hari', 'nidn']);
            $table->index(['hari', 'kelas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
