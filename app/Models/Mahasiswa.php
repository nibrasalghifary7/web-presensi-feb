<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Mahasiswa
 * Menyimpan data profil mahasiswa yang terhubung dengan user.
 */
class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false; // NIM bukan auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'user_id',
        'nama',
        'email',
        'phone',
        'kelas',
        'angkatan',
        'prodi',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi belongs-to ke tabel users.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi one-to-many ke tabel absensi.
     * Satu mahasiswa memiliki banyak data absensi.
     */
    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'nim', 'nim');
    }

    /**
     * Relasi one-to-many ke tabel pengajuan izin.
     */
    public function pengajuanIzins(): HasMany
    {
        return $this->hasMany(PengajuanIzin::class, 'nim', 'nim');
    }

    // ========================================
    // ACCESSOR & HELPER
    // ========================================

    /**
     * Menghitung total kehadiran (Hadir).
     */
    public function getTotalHadirAttribute(): int
    {
        return $this->absensis()->where('status', 'Hadir')->count();
    }

    /**
     * Menghitung total izin/sakit.
     */
    public function getTotalIzinSakitAttribute(): int
    {
        return $this->absensis()->whereIn('status', ['Izin', 'Sakit'])->count();
    }

    /**
     * Menghitung total alpha (tanpa keterangan).
     */
    public function getTotalAlphaAttribute(): int
    {
        return $this->absensis()->where('status', 'Alpha')->count();
    }

    /**
     * Menghitung persentase kehadiran.
     * Syarat ujian minimal 75% kehadiran.
     */
    public function getPersentaseKehadiranAttribute(): float
    {
        $total = $this->absensis()->count();
        if ($total === 0) return 0;

        $hadir = $this->absensis()->where('status', 'Hadir')->count();
        return round(($hadir / $total) * 100, 1);
    }
}
