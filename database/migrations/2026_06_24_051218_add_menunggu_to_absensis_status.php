<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE absensis MODIFY status ENUM('Menunggu','Hadir','Izin','Sakit','Alpha') NOT NULL DEFAULT 'Menunggu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE absensis MODIFY status ENUM('Hadir','Izin','Sakit','Alpha') NOT NULL DEFAULT 'Hadir'");
    }
};
