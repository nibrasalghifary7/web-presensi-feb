<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model PengajuanIzin
 * Menyimpan pengajuan izin/sakit dari mahasiswa beserta bukti surat.
 */
class PengajuanIzin extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_izins';
    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        'nim',
        'id_jadwal',
        'tanggal_izin',
        'jenis',
        'alasan',
        'bukti_surat',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_izin' => 'date',
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
     * Relasi belongs-to ke tabel jadwal (opsional).
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
