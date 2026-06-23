<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Dosen
 * Menyimpan data profil dosen pengajar.
 */
class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nidn',
        'user_id',
        'nama',
        'email',
        'phone',
        'bidang_keahlian',
        'status_aktif',
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
     * Relasi one-to-many ke tabel jadwal.
     * Satu dosen mengajar banyak jadwal.
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }
}
