<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // users: is_active + last_login (PRD F-07)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->tinyInteger('is_active')->default(1)->after('role');
            }
            if (!Schema::hasColumn('users', 'last_login')) {
                $table->timestamp('last_login')->nullable()->after('is_active');
            }
        });

        // mahasiswas: status_aktif (PRD F-01)
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (!Schema::hasColumn('mahasiswas', 'status_aktif')) {
                $table->tinyInteger('status_aktif')->default(1)->after('angkatan');
            }
        });

        // dosens: status_aktif (PRD F-02)
        Schema::table('dosens', function (Blueprint $table) {
            if (!Schema::hasColumn('dosens', 'status_aktif')) {
                $table->tinyInteger('status_aktif')->default(1)->after('bidang_keahlian');
            }
        });

        // mata_kuliahs: status_aktif (PRD F-03)
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            if (!Schema::hasColumn('mata_kuliahs', 'status_aktif')) {
                $table->tinyInteger('status_aktif')->default(1)->after('semester');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'last_login']);
        });
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['status_aktif']);
        });
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn(['status_aktif']);
        });
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table->dropColumn(['status_aktif']);
        });
    }
};
