<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Jadwal
 * Menyimpan jadwal perkuliahan (mata kuliah + dosen + hari + jam).
 */
class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_mk',
        'nidn',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang',
        'kelas',
        'semester_aktif',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi belongs-to ke tabel mata kuliah.
     */
    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    /**
     * Relasi belongs-to ke tabel dosen.
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    /**
     * Relasi one-to-many ke tabel absensi.
     */
    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'id_jadwal', 'id_jadwal');
    }

    /**
     * Relasi one-to-many ke tabel sesi.
     */
    public function sesis(): HasMany
    {
        return $this->hasMany(Sesi::class, 'id_jadwal', 'id_jadwal');
    }

    // ========================================
    // HELPER
    // ========================================

    /**
     * Mendapatkan jadwal hari ini untuk dosen tertentu.
     */
    public function scopeHariIni($query)
    {
        $hariIni = match (now()->dayOfWeek) {
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        };

        return $query->where('hari', $hariIni);
    }

    /**
     * Format jam kuliah (misal: 08:00 - 10:30).
     */
    public function getJamFormattedAttribute(): string
    {
        return substr($this->jam_mulai, 0, 5) . ' - ' . substr($this->jam_selesai, 0, 5);
    }
}
