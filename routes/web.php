<?php

/**
 * Routing Utama Aplikasi M-Presence FEB
 *
 * Struktur route:
 * 1. Route publik (login, registrasi)
 * 2. Route Mahasiswa (middleware role:mahasiswa)
 * 3. Route Dosen (middleware role:dosen)
 * 4. Route Admin (middleware role:admin)
 */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ========================================
// ROUTE PUBLIK (Tidak perlu login)
// ========================================

/**
 * Halaman utama - redirect ke login.
 */
Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Autentikasi - Login & Registrasi.
 */
Route::middleware('guest')->group(function () {
    // Halaman Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Halaman Registrasi (khusus mahasiswa)
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/**
 * Logout (bisa diakses semua role yang sudah login).
 */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========================================
// ROUTE MAHASISWA
// Middleware: auth + role:mahasiswa
// ========================================
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');

    // Absensi
    Route::get('/absensi', [MahasiswaController::class, 'absensi'])->name('absensi');
    Route::post('/absensi/{idJadwal}', [MahasiswaController::class, 'prosesAbsensi'])->name('absensi.proses');

    // Riwayat Kehadiran
    Route::get('/riwayat', [MahasiswaController::class, 'riwayat'])->name('riwayat');

    // Pengajuan Izin/Sakit
    Route::get('/dokumen', [MahasiswaController::class, 'formIzin'])->name('dokumen');
    Route::post('/dokumen', [MahasiswaController::class, 'submitIzin'])->name('dokumen.submit');
});

// ========================================
// ROUTE DOSEN
// Middleware: auth + role:dosen
// ========================================
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');

    // Validasi Absensi
    Route::get('/validasi/{idJadwal}', [DosenController::class, 'validasiAbsensi'])->name('validasi');
    Route::post('/validasi/{idAbsensi}', [DosenController::class, 'prosesValidasi'])->name('validasi.proses');

    // Rekap & Laporan
    Route::get('/rekap/{idJadwal}', [DosenController::class, 'rekap'])->name('rekap');
    Route::get('/laporan/{idJadwal}', [DosenController::class, 'cetakLaporan'])->name('laporan');
});

// ========================================
// ROUTE ADMIN
// Middleware: auth + role:admin
// ========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD Mahasiswa
    Route::get('/mahasiswa', [AdminController::class, 'mahasiswaIndex'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [AdminController::class, 'mahasiswaCreate'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [AdminController::class, 'mahasiswaStore'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{nim}/edit', [AdminController::class, 'mahasiswaEdit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{nim}', [AdminController::class, 'mahasiswaUpdate'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{nim}', [AdminController::class, 'mahasiswaDestroy'])->name('mahasiswa.destroy');

    // CRUD Dosen
    Route::get('/dosen', [AdminController::class, 'dosenIndex'])->name('dosen.index');
    Route::get('/dosen/create', [AdminController::class, 'dosenCreate'])->name('dosen.create');
    Route::post('/dosen', [AdminController::class, 'dosenStore'])->name('dosen.store');
    Route::get('/dosen/{nidn}/edit', [AdminController::class, 'dosenEdit'])->name('dosen.edit');
    Route::put('/dosen/{nidn}', [AdminController::class, 'dosenUpdate'])->name('dosen.update');
    Route::delete('/dosen/{nidn}', [AdminController::class, 'dosenDestroy'])->name('dosen.destroy');

    // CRUD Mata Kuliah
    Route::get('/mata-kuliah', [AdminController::class, 'mataKuliahIndex'])->name('mata-kuliah.index');
    Route::post('/mata-kuliah', [AdminController::class, 'mataKuliahStore'])->name('mata-kuliah.store');
    Route::put('/mata-kuliah/{id}', [AdminController::class, 'mataKuliahUpdate'])->name('mata-kuliah.update');
    Route::delete('/mata-kuliah/{id}', [AdminController::class, 'mataKuliahDestroy'])->name('mata-kuliah.destroy');

    // Manajemen Jadwal
    Route::get('/jadwal', [AdminController::class, 'jadwalIndex'])->name('jadwal.index');
    Route::post('/jadwal', [AdminController::class, 'jadwalStore'])->name('jadwal.store');
    Route::delete('/jadwal/{id}', [AdminController::class, 'jadwalDestroy'])->name('jadwal.destroy');
});
