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
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ========================================
// ROUTE PUBLIK (Tidak perlu login)
// ========================================

/**
 * Halaman utama - redirect ke login.
 */
Route::get('/', function () {
    return view('index');
});

/**
 * Switch bahasa aplikasi.
 */
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

/**
 * Dashboard redirect — cegah redirect loop dari guest middleware.
 */
Route::middleware('auth')->get('/dashboard', function () {
    return redirect(Auth::user()->getDashboardUrl());
});

/**
 * Autentikasi - Login & Registrasi.
 */
Route::middleware('guest')->group(function () {
    // Halaman Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/login/biometric', [AuthController::class, 'biometricLogin'])->name('login.biometric');

    // Halaman Registrasi
    Route::get('/register', function () { return redirect()->route('register-mahasiswa'); })->name('register');
    Route::get('/register-mahasiswa', [AuthController::class, 'showRegistrationForm'])->name('register-mahasiswa');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/register-dosen', [AuthController::class, 'showDosenRegistrationForm'])->name('register-dosen');
    Route::post('/register-dosen', [AuthController::class, 'registerDosen'])->name('register-dosen.post');
});

/**
 * Logout (bisa diakses semua role yang sudah login).
 */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Ganti Password (semua role yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/ganti-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/ganti-password', [AuthController::class, 'changePassword'])->name('password.change');
});

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

    // Riwayat Pengajuan
    Route::get('/riwayat-pengajuan', [MahasiswaController::class, 'riwayatPengajuan'])->name('riwayat-pengajuan');

    // Profil Mahasiswa (PRD F-13)
    Route::get('/profil', [MahasiswaController::class, 'profil'])->name('profil');

    // Persentase Kehadiran (PRD F-16)
    Route::get('/kehadiran', [MahasiswaController::class, 'kehadiran'])->name('kehadiran');
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
    Route::get('/laporan/{idJadwal}/pdf', [DosenController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/{idJadwal}/excel', [DosenController::class, 'exportExcel'])->name('laporan.excel');

    // Pengajuan Izin Mahasiswa
    Route::get('/pengajuan', [DosenController::class, 'pengajuanIndex'])->name('pengajuan.index');

    // Sesi Pertemuan
    Route::post('/sesi/buka/{idJadwal}', [DosenController::class, 'bukaSesi'])->name('sesi.buka');
    Route::post('/sesi/tutup/{idSesi}', [DosenController::class, 'tutupSesi'])->name('sesi.tutup');

    // Pengajuan Izin/Sakit — approve/reject
    Route::post('/pengajuan/{id}/approve', [DosenController::class, 'pengajuanApprove'])->name('pengajuan.approve');
    Route::post('/pengajuan/{id}/reject', [DosenController::class, 'pengajuanReject'])->name('pengajuan.reject');

    // Profil Dosen
    Route::get('/profil', [DosenController::class, 'profil'])->name('profil');
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
    Route::get('/mahasiswa/import', [AdminController::class, 'mahasiswaImportForm'])->name('mahasiswa.import.form');
    Route::post('/mahasiswa/import', [AdminController::class, 'mahasiswaImport'])->name('mahasiswa.import');
    Route::get('/mahasiswa/template', [AdminController::class, 'mahasiswaTemplate'])->name('mahasiswa.template');

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
    Route::put('/jadwal/{id}', [AdminController::class, 'jadwalUpdate'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [AdminController::class, 'jadwalDestroy'])->name('jadwal.destroy');

    // Pengajuan Izin/Sakit
    Route::get('/pengajuan', [AdminController::class, 'pengajuanIndex'])->name('pengajuan.index');
    Route::post('/pengajuan/{id}/approve', [AdminController::class, 'pengajuanApprove'])->name('pengajuan.approve');
    Route::post('/pengajuan/{id}/reject', [AdminController::class, 'pengajuanReject'])->name('pengajuan.reject');

    // CRUD Kelas (F-04)
    Route::get('/kelas', [AdminController::class, 'kelasIndex'])->name('kelas.index');
    Route::post('/kelas', [AdminController::class, 'kelasStore'])->name('kelas.store');
    Route::put('/kelas/{id}', [AdminController::class, 'kelasUpdate'])->name('kelas.update');
    Route::delete('/kelas/{id}', [AdminController::class, 'kelasDestroy'])->name('kelas.destroy');

    // Kelola Absensi (F-06)
    Route::get('/absensi', [AdminController::class, 'absensiIndex'])->name('absensi.index');
    Route::put('/absensi/{id}', [AdminController::class, 'absensiUpdate'])->name('absensi.update');
    Route::delete('/absensi/{id}', [AdminController::class, 'absensiDestroy'])->name('absensi.destroy');

    // Kelola Akun Pengguna (F-07)
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
    Route::post('/users', [AdminController::class, 'usersStore'])->name('users.store');
    Route::put('/users/{id}', [AdminController::class, 'usersUpdate'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('users.destroy');
    Route::post('/users/{id}/reset-password', [AdminController::class, 'usersResetPassword'])->name('users.reset-password');

    // Laporan Absensi (F-08)
    Route::get('/laporan', [AdminController::class, 'laporanIndex'])->name('laporan.index');
    Route::get('/laporan/pdf', [AdminController::class, 'laporanPdf'])->name('laporan.pdf');
    Route::get('/laporan/excel', [AdminController::class, 'laporanExcel'])->name('laporan.excel');

    // Monitoring Presensi Dosen
    Route::get('/presensi', [AdminDosenController::class, 'index'])->name('presensi.index');
    Route::get('/presensi/{idJadwal}/validasi', [AdminDosenController::class, 'validasi'])->name('presensi.validasi');
    Route::get('/presensi/{idJadwal}/rekap', [AdminDosenController::class, 'rekap'])->name('presensi.rekap');
    Route::get('/presensi/{idJadwal}/laporan', [AdminDosenController::class, 'laporan'])->name('presensi.laporan');
    Route::get('/presensi/{idJadwal}/pdf', [AdminDosenController::class, 'exportPdf'])->name('presensi.exportPdf');
    Route::get('/presensi/{idJadwal}/excel', [AdminDosenController::class, 'exportExcel'])->name('presensi.exportExcel');
    Route::put('/presensi/{idAbsensi}/update-status', [AdminDosenController::class, 'updateStatus'])->name('presensi.updateStatus');
});
