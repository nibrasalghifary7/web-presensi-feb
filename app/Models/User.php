<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model User
 * Model utama untuk autentikasi multi-role (Admin, Dosen, Mahasiswa).
 * Setiap user memiliki role yang menentukan akses ke sistem.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'pin',
        'role',
        'name',
        'email',
        'phone',
        'is_active',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // ========================================
    // RELASI
    // ========================================

    /**
     * Relasi one-to-one dengan tabel mahasiswa.
     * Hanya berlaku jika role = 'mahasiswa'.
     */
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    /**
     * Relasi one-to-one dengan tabel dosen.
     * Hanya berlaku jika role = 'dosen'.
     */
    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class, 'user_id');
    }

    // ========================================
    // ACCESSOR & HELPER
    // ========================================

    /**
     * Cek apakah user memiliki role admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user memiliki role dosen.
     */
    public function isDosen(): bool
    {
        return $this->role === 'dosen';
    }

    /**
     * Cek apakah user memiliki role mahasiswa.
     */
    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    /**
     * Mendapatkan URL dashboard berdasarkan role.
     */
    public function getDashboardUrl(): string
    {
        return match ($this->role) {
            'admin' => route('admin.dashboard'),
            'dosen' => route('dosen.dashboard'),
            default => route('mahasiswa.dashboard'),
        };
    }
}
