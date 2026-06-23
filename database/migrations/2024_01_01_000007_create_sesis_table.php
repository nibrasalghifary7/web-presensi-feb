<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Sesi Absensi
 * Menyimpan informasi sesi pertemuan yang dibuka oleh dosen.
 * Dosen membuka sesi untuk memulai proses absensi pada jadwal tertentu.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesis', function (Blueprint $table) {
            $table->id('id_sesi');
            $table->unsignedBigInteger('id_jadwal');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwals')->onDelete('cascade');
            $table->date('tanggal'); // Tanggal sesi
            $table->time('jam_buka')->nullable(); // Jam sesi dibuka
            $table->time('jam_tutup')->nullable(); // Jam sesi ditutup
            $table->integer('pertemuan_ke'); // Nomor pertemuan
            $table->enum('status', ['dibuka', 'ditutup'])->default('dibuka');
            $table->string('qr_code', 255)->nullable(); // Placeholder untuk QR Code
            $table->timestamps();

            $table->unique(['id_jadwal', 'tanggal'], 'sesi_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesis');
    }
};
