<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->string('nidn', 20); // penerima: dosen
            $table->string('tipe', 50); // pengajuan_disetujui, pengajuan_ditolak
            $table->unsignedBigInteger('id_pengajuan'); // relasi ke pengajuan_izins
            $table->string('nama_mahasiswa', 100);
            $table->string('nama_matakuliah', 100);
            $table->string('jenis', 10); // Sakit / Izin
            $table->date('tanggal_izin');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('nidn')->references('nidn')->on('dosens')->cascadeOnDelete();
            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_izins')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
