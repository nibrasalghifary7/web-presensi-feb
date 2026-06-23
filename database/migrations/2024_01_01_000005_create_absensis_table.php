<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Absensi
 * Mencatat data kehadiran mahasiswa pada setiap jadwal perkuliahan.
 * Status kehadiran: Hadir, Izin, Sakit, Alpha (tanpa keterangan).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->string('nim', 20);
            $table->unsignedBigInteger('id_jadwal');
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwals')->onDelete('cascade');
            $table->date('tanggal'); // Tanggal absensi
            $table->time('jam_masuk')->nullable(); // Jam mahasiswa melakukan absen
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha'])->default('Alpha');
            $table->enum('validasi', ['pending', 'divalidasi', 'ditolak'])->default('pending'); // Status validasi oleh dosen
            $table->text('catatan')->nullable(); // Catatan tambahan (misal: alasan izin)
            $table->timestamps();

            // Satu mahasiswa hanya bisa absen sekali per jadwal per tanggal
            $table->unique(['nim', 'id_jadwal', 'tanggal'], 'absensi_unique');
            $table->index(['tanggal', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
