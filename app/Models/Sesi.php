<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Sesi
 * Menyimpan informasi sesi pertemuan yang dibuka oleh dosen.
 */
class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesis';
    protected $primaryKey = 'id_sesi';

    protected $fillable = [
        'id_jadwal',
        'tanggal',
        'jam_buka',
        'jam_tutup',
        'pertemuan_ke',
        'status',
        'qr_code',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi belongs-to ke tabel jadwal.
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
