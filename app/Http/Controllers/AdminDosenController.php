<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dosen\PresensiController;
use Illuminate\Http\Request;

/**
 * Controller Admin - Dosen/Presensi
 * Menangani fitur admin yang berkaitan dengan monitoring presensi dosen:
 * - Monitoring presensi per jadwal
 * - Validasi absensi (admin override)
 * - Rekap & cetak laporan
 */
class AdminDosenController extends Controller
{
    /**
     * Menampilkan monitoring presensi dosen.
     * Admin bisa melihat semua jadwal dan statistik kehadiran.
     */
    public function index(Request $request)
    {
        $presensiController = new PresensiController();
        return $presensiController->index($request);
    }

    /**
     * Menampilkan halaman validasi absensi (admin view).
     * Admin bisa memvalidasi absensi dari semua jadwal.
     */
    public function validasi($idJadwal)
    {
        $presensiController = new PresensiController();
        return $presensiController->validasi($idJadwal);
    }

    /**
     * Menampilkan rekap kehadiran per jadwal (admin view).
     */
    public function rekap($idJadwal)
    {
        $presensiController = new PresensiController();
        return $presensiController->rekap($idJadwal);
    }

    /**
     * Menampilkan laporan kehadiran (admin view).
     */
    public function laporan($idJadwal)
    {
        $presensiController = new PresensiController();
        return $presensiController->cetakLaporan($idJadwal);
    }

    /**
     * Export laporan kehadiran dalam format PDF (admin).
     */
    public function exportPdf($idJadwal)
    {
        $presensiController = new PresensiController();
        return $presensiController->exportPdf($idJadwal);
    }

    /**
     * Export laporan kehadiran dalam format Excel (admin).
     */
    public function exportExcel($idJadwal)
    {
        $presensiController = new PresensiController();
        return $presensiController->exportExcel($idJadwal);
    }

    /**
     * Update status absensi oleh admin.
     */
    public function updateStatus(Request $request, $idAbsensi)
    {
        $presensiController = new PresensiController();
        return $presensiController->updateStatus($idAbsensi, $request);
    }
}
