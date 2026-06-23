<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tabel Pengajuan Izin
 * Menyimpan data pengajuan izin/sakit dari mahasiswa beserta bukti surat.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_izins', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->string('nim', 20);
            $table->unsignedBigInteger('id_jadwal')->nullable();
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwals')->onDelete('set null');
            $table->date('tanggal_izin'); // Tanggal izin/sakit
            $table->enum('jenis', ['Izin', 'Sakit']); // Jenis pengajuan
            $table->text('alasan'); // Alasan pengajuan
            $table->string('bukti_surat', 255)->nullable(); // Path file bukti surat (foto/PDF)
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable(); // Catatan dari admin/dosen
            $table->timestamps();

            $table->index(['nim', 'status']);
            $table->index('tanggal_izin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_izins');
    }
};
