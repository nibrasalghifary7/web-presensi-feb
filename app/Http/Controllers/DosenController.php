<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Sesi;
use App\Models\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller Dosen
 * Menangani fitur yang dapat diakses oleh dosen:
 * - Dashboard (jadwal mengajar hari ini)
 * - Validasi Absensi
 * - Rekap & Cetak Laporan
 */
class DosenController extends Controller
{
    /**
     * Menampilkan dashboard dosen.
     * Menampilkan jadwal mengajar hari ini.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Ambil jadwal mengajar hari ini
        $jadwalHariIni = Jadwal::hariIni()
            ->where('nidn', $dosen->nidn)
            ->with(['mataKuliah'])
            ->get();

        // Hitung total mahasiswa yang perlu divalidasi
        $totalValidasiPending = Absensi::whereHas('jadwal', function ($q) use ($dosen) {
            $q->where('nidn', $dosen->nidn);
        })->where('validasi', 'pending')->count();

        return view('dosen.dashboard', compact('user', 'dosen', 'jadwalHariIni', 'totalValidasiPending'));
    }

    /**
     * Menampilkan daftar mahasiswa untuk validasi absensi.
     * Dosen bisa melihat siapa yang sudah absen dan memvalidasi.
     */
    public function validasiAbsensi($idJadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal milik dosen ini
        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('nidn', $dosen->nidn)
            ->with(['mataKuliah'])
            ->firstOrFail();

        // Ambil semua absensi untuk jadwal hari ini
        $absensis = Absensi::where('id_jadwal', $idJadwal)
            ->whereDate('tanggal', today())
            ->with('mahasiswa')
            ->get();

        return view('dosen.validasi', compact('user', 'dosen', 'jadwal', 'absensis'));
    }

    /**
     * Memproses validasi absensi oleh dosen.
     * Dosen bisa mengubah status kehadiran atau memvalidasi.
     */
    public function prosesValidasi(Request $request, $idAbsensi)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Hadir,Izin,Sakit,Alpha',
            'validasi' => 'required|in:pending,divalidasi,ditolak',
        ]);

        $absensi = Absensi::findOrFail($idAbsensi);

        // Pastikan dosen berhak memvalidasi (jadwal miliknya)
        $jadwal = Jadwal::where('id_jadwal', $absensi->id_jadwal)
            ->where('nidn', Auth::user()->dosen->nidn)
            ->firstOrFail();

        $absensi->update([
            'status' => $request->status,
            'validasi' => $request->validasi,
        ]);

        return back()->with('success', 'Status kehadiran berhasil diperbarui.');
    }

    /**
     * Menampilkan rekap kehadiran per mata kuliah.
     */
    public function rekap($idJadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('nidn', $dosen->nidn)
            ->with(['mataKuliah'])
            ->firstOrFail();

        // Ambil semua mahasiswa kelas ini dengan data absensi
        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        return view('dosen.rekap', compact('user', 'dosen', 'jadwal', 'rekap'));
    }

    /**
     * Menampilkan laporan kehadiran (HTML view).
     */
    public function cetakLaporan($idJadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('nidn', $dosen->nidn)
            ->with(['mataKuliah'])
            ->firstOrFail();

        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        return view('dosen.laporan', compact('user', 'dosen', 'jadwal', 'rekap'));
    }

    /**
     * Export laporan kehadiran dalam format PDF.
     * Menggunakan DomPDF untuk generate file PDF.
     */
    public function exportPdf($idJadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('nidn', $dosen->nidn)
            ->with(['mataKuliah'])
            ->firstOrFail();

        $rekap = Absensi::where('id_jadwal', $idJadwal)
            ->with('mahasiswa')
            ->orderBy('nim')
            ->get()
            ->groupBy('nim');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dosen.laporan-pdf', compact('user', 'dosen', 'jadwal', 'rekap'));
        $pdf->setPaper('a4', 'portrait');

        $filename = 'laporan-kehadiran-' . $jadwal->mataKuliah->kode_mk . '-' . $jadwal->kelas . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export laporan kehadiran dalam format Excel (CSV).
     */
    public function exportExcel($idJadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('nidn', $dosen->nidn)
            ->with(['mataKuliah'])
            ->firstOrFail();

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
            // BOM untuk UTF-8 Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header info
            fputcsv($file, ['Laporan Kehadiran Mahasiswa']);
            fputcsv($file, ['Mata Kuliah', $jadwal->mataKuliah->nama_mk]);
            fputcsv($file, ['Kelas', $jadwal->kelas]);
            fputcsv($file, ['Dosen', $jadwal->dosen->nama]);
            fputcsv($file, []);
            // Header kolom
            fputcsv($file, ['No', 'NIM', 'Nama', 'Hadir', 'Izin', 'Sakit', 'Alpha', 'Total', 'Persentase']);
            // Data
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

    // ========================================
    // PENGAJUAN IZIN MAHASISWA
    // ========================================

    /**
     * Menampilkan daftar pengajuan izin/sakit mahasiswa.
     * Dosen bisa melihat pengajuan dari mahasiswa di kelas yang diajar.
     */
    public function pengajuanIndex(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Ambil semua kelas yang diajar dosen ini
        $kelasDosen = Jadwal::where('nidn', $dosen->nidn)->pluck('kelas')->unique();

        $query = PengajuanIzin::with(['mahasiswa', 'jadwal.mataKuliah'])
            ->whereHas('jadwal', function ($q) use ($dosen) {
                $q->where('nidn', $dosen->nidn);
            });

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        $pengajuans = $query->orderByDesc('created_at')->paginate(10);

        return view('dosen.pengajuan', compact('user', 'dosen', 'pengajuans', 'kelasDosen'));
    }

    // ========================================
    // SESI PERTEMUAN
    // ========================================

    /**
     * Membuka sesi pertemuan untuk jadwal tertentu.
     * Dosen membuka sesi agar mahasiswa bisa melakukan absensi.
     */
    public function bukaSesi($idJadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal milik dosen ini
        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('nidn', $dosen->nidn)
            ->firstOrFail();

        // Cek apakah sudah ada sesi aktif hari ini untuk jadwal ini
        $sudahAda = Sesi::where('id_jadwal', $idJadwal)
            ->whereDate('tanggal', today())
            ->where('status', 'dibuka')
            ->exists();

        if ($sudahAda) {
            return back()->with('error', 'Sudah ada sesi aktif untuk jadwal ini hari ini.');
        }

        // Hitung pertemuan ke berapa
        $pertemuanKe = Sesi::where('id_jadwal', $idJadwal)->count() + 1;

        Sesi::create([
            'id_jadwal' => $idJadwal,
            'tanggal' => today(),
            'jam_buka' => now(),
            'pertemuan_ke' => $pertemuanKe,
            'status' => 'dibuka',
        ]);

        return back()->with('success', 'Sesi pertemuan ke-' . $pertemuanKe . ' berhasil dibuka. Mahasiswa sudah bisa melakukan absensi.');
    }

    /**
     * Menutup sesi pertemuan.
     * Setelah sesi ditutup, mahasiswa tidak bisa absen lagi.
     */
    public function tutupSesi($idSesi)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan sesi milik jadwal dosen ini
        $sesi = Sesi::where('id_sesi', $idSesi)
            ->whereHas('jadwal', function ($q) use ($dosen) {
                $q->where('nidn', $dosen->nidn);
            })
            ->firstOrFail();

        $sesi->update([
            'jam_tutup' => now(),
            'status' => 'ditutup',
        ]);

        return back()->with('success', 'Sesi pertemuan ke-' . $sesi->pertemuan_ke . ' berhasil ditutup.');
    }
}
