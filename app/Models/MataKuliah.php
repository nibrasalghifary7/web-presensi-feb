<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model MataKuliah
 * Menyimpan daftar mata kuliah yang tersedia.
 */
class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';
    protected $primaryKey = 'id_mk';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'prodi',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi one-to-many ke tabel jadwal.
     * Satu mata kuliah bisa memiliki banyak jadwal.
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_mk', 'id_mk');
    }
}
