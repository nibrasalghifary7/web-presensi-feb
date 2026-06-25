<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'nidn',
        'tipe',
        'id_pengajuan',
        'nama_mahasiswa',
        'nama_matakuliah',
        'jenis',
        'tanggal_izin',
        'pesan',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'tanggal_izin' => 'date',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanIzin::class, 'id_pengajuan', 'id_pengajuan');
    }
}
