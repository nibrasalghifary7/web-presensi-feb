<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Kelas
 * Menyimpan data kelas/rombongan belajar mahasiswa.
 */
class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'angkatan',
        'prodi',
        'jumlah_mahasiswa',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi one-to-many ke tabel mahasiswa.
     */
    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class, 'kelas', 'nama_kelas');
    }

    // ========================================
    // HELPER
    // ========================================

    /**
     * Menghitung ulang jumlah mahasiswa di kelas ini.
     */
    public function hitungJumlahMahasiswa(): int
    {
        $count = $this->mahasiswas()->count();
        $this->update(['jumlah_mahasiswa' => $count]);
        return $count;
    }
}
