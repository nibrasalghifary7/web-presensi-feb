<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use Illuminate\Http\Request;

/**
 * Controller Presensi (shared logic)
 * Digunakan oleh DosenController dan AdminDosenController
 * untuk menampilkan data presensi, validasi, rekap, dan laporan.
 */
class PresensiController extends Controller
{
    /**
     * Menampilkan daftar jadwal dengan statistik presensi.
     * Digunakan oleh admin untuk monitoring presensi dosen.
     */
    public function index(Request $request)
    {
        $query = Jadwal::with(['mataKuliah', 'dosen']);

        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }

        if ($request->filled('nidn')) {
            $query->where('nidn', $request->nidn);
        }

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        $jadwals = $query->orderBy('hari')->orderBy('jam_mulai')->paginate(15);

        // Hitung statistik presensi per jadwal
        foreach ($jadwals as $jadwal) {
            $today = now()->toDateString();
            $jadwal->total_absensi_hari_ini = Absensi::where('id_jadwal', $jadwal->id_jadwal)
                ->whereDate('tanggal', $today)
                ->count();
            $jadwal->total_hadir_hari_ini = Absensi::where('id_jadwal', $jadwal->id_jadwal)
                ->whereDate('tanggal', $today)
                ->where('status', 'Hadir')
                ->count();
            $jadwal->total_pending_hari_ini = Absensi::where('id_jadwal', $jadwal->id_jadwal)
                ->whereDate('tanggal', $today)
                ->where('validasi', 'pending')
                ->count();
        }

        return view('admin.dosen.mahasiswa', compact('jadwals'));
    }

    /**
     * Menampilkan halaman validasi absensi untuk admin.
     * Admin bisa memvalidasi semua absensi tanpa batasan dosen.
     */
    public function validasi($idJadwal)
    {
        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])->findOrFail($idJadwal);

        $absensis = Absensi::where('id_jadwal', $idJadwal)
            ->whereDate('tanggal', today())
            ->with('mahasiswa')
            ->get();

        return view('admin.dosen.validasi', compact('jadwal', 'absensis'));
    }

    /**
     * Menampilkan rekap kehadiran per jadwal untuk admin.
     */
    public function rekap($idJadwal)
    {
        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])->findOrFail($idJadwal);

        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        return view('admin.dosen.rekap', compact('jadwal', 'rekap'));
    }

    /**
     * Menampilkan laporan kehadiran (HTML view) untuk admin.
     */
    public function cetakLaporan($idJadwal)
    {
        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])->findOrFail($idJadwal);

        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        return view('admin.dosen.rekap', compact('jadwal', 'rekap'));
    }

    /**
     * Export laporan kehadiran dalam format PDF (admin).
     */
    public function exportPdf($idJadwal)
    {
        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])->findOrFail($idJadwal);

        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dosen.laporan-pdf', [
            'user' => auth()->user(),
            'dosen' => $jadwal->dosen,
            'jadwal' => $jadwal,
            'rekap' => $rekap,
        ]);
        $pdf->setPaper('a4', 'portrait');

        $filename = 'laporan-kehadiran-' . $jadwal->mataKuliah->kode_mk . '-' . $jadwal->kelas . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export laporan kehadiran dalam format Excel/CSV (admin).
     */
    public function exportExcel($idJadwal)
    {
        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])->findOrFail($idJadwal);

        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        $filename = 'laporan-kehadiran-' . $jadwal->mataKuliah->kode_mk . '-' . $jadwal->kelas . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($rekap, $jadwal) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['Laporan Kehadiran Mahasiswa']);
            fputcsv($file, ['Mata Kuliah', $jadwal->mataKuliah->nama_mk]);
            fputcsv($file, ['Kelas', $jadwal->kelas]);
            fputcsv($file, ['Dosen', $jadwal->dosen->nama]);
            fputcsv($file, []);
            fputcsv($file, ['No', 'NIM', 'Nama', 'Hadir', 'Izin', 'Sakit', 'Alpha', 'Total', 'Persentase']);

            $no = 1;
            foreach ($rekap as $nim => $absensis) {
                $mahasiswa = $absensis->first()->mahasiswa;
                $hadir = $absensis->where('status', 'Hadir')->count();
                $izin = $absensis->where('status', 'Izin')->count();
                $sakit = $absensis->where('status', 'Sakit')->count();
                $alpha = $absensis->where('status', 'Alpha')->count();
                $total = $absensis->count();
                $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;

                fputcsv($file, [
                    $no++,
                    $nim,
                    $mahasiswa->nama ?? '-',
                    $hadir,
                    $izin,
                    $sakit,
                    $alpha,
                    $total,
                    $persen . '%',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Update status absensi oleh admin.
     * Admin bisa mengubah status dan validasi tanpa batasan.
     */
    public function updateStatus($idAbsensi, Request $request)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Hadir,Izin,Sakit,Alpha',
            'validasi' => 'required|in:pending,divalidasi,ditolak',
        ]);

        $absensi = Absensi::findOrFail($idAbsensi);
        $absensi->update([
            'status' => $request->status,
            'validasi' => $request->validasi,
        ]);

        return back()->with('success', 'Status kehadiran berhasil diperbarui.');
    }
}
