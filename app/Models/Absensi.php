<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Absensi
 * Mencatat data kehadiran mahasiswa pada setiap jadwal perkuliahan.
 */
class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'nim',
        'id_jadwal',
        'tanggal',
        'jam_masuk',
        'status',
        'validasi',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi belongs-to ke tabel mahasiswa.
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    /**
     * Relasi belongs-to ke tabel jadwal.
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    // ========================================
    // HELPER
    // ========================================

    /**
     * Mendapatkan class CSS untuk badge status.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'Hadir' => 'bg-emerald-100 text-emerald-700',
            'Izin' => 'bg-amber-100 text-amber-700',
            'Sakit' => 'bg-yellow-100 text-yellow-700',
            'Alpha' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
