<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Sesi;
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
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'validasi' => 'required|in:divalidasi,ditolak',
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
     * Mencetak laporan kehadiran dalam format PDF.
     * Placeholder - implementasi PDF library (DomPDF/Snappy) ditambahkan nanti.
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

        // TODO: Generate PDF menggunakan DomPDF atau Laravel Snappy
        // return \PDF::loadView('dosen.laporan-pdf', compact('jadwal', 'rekap'))
        //     ->stream('laporan-' . $jadwal->mataKuliah->kode_mk . '.pdf');

        return view('dosen.laporan', compact('user', 'dosen', 'jadwal', 'rekap'));
    }
}
