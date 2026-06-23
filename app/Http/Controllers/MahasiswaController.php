<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Controller Mahasiswa
 * Menangani semua fitur yang dapat diakses oleh mahasiswa:
 * - Dashboard (ringkasan profil & statistik)
 * - Absensi (klik kehadiran)
 * - Riwayat Kehadiran
 * - Pengajuan Izin/Sakit
 */
class MahasiswaController extends Controller
{
    /**
     * Menampilkan dashboard mahasiswa.
     * Menampilkan ringkasan profil, kartu info cepat, dan persentase kehadiran.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Hitung statistik kehadiran
        $totalPertemuan = Absensi::where('nim', $mahasiswa->nim)->count();
        $totalHadir = Absensi::where('nim', $mahasiswa->nim)->where('status', 'Hadir')->count();
        $totalIzinSakit = Absensi::where('nim', $mahasiswa->nim)->whereIn('status', ['Izin', 'Sakit'])->count();
        $totalAlpha = Absensi::where('nim', $mahasiswa->nim)->where('status', 'Alpha')->count();
        $persentase = $totalPertemuan > 0 ? round(($totalHadir / $totalPertemuan) * 100, 1) : 0;

        // Ambil jadwal hari ini
        $jadwalHariIni = Jadwal::hariIni()
            ->where('kelas', $mahasiswa->kelas)
            ->with(['mataKuliah', 'dosen'])
            ->get();

        return view('mahasiswa.dashboard', compact(
            'user', 'mahasiswa', 'totalPertemuan',
            'totalHadir', 'totalIzinSakit', 'totalAlpha',
            'persentase', 'jadwalHariIni'
        ));
    }

    /**
     * Menampilkan halaman absensi (klik kehadiran).
     * Menampilkan jadwal mata kuliah yang aktif hari ini.
     */
    public function absensi()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Ambil jadwal hari ini untuk kelas mahasiswa
        $jadwalHariIni = Jadwal::hariIni()
            ->where('kelas', $mahasiswa->kelas)
            ->with(['mataKuliah', 'dosen'])
            ->get();

        // Ambil data absensi yang sudah dilakukan hari ini
        $absensiHariIni = Absensi::where('nim', $mahasiswa->nim)
            ->whereDate('tanggal', today())
            ->pluck('status', 'id_jadwal');

        return view('mahasiswa.absensi', compact('user', 'mahasiswa', 'jadwalHariIni', 'absensiHariIni'));
    }

    /**
     * Memproses klik absensi dari mahasiswa.
     * Placeholder untuk pengembangan QR Code / GPS di masa depan.
     */
    public function prosesAbsensi(Request $request, $idJadwal)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Cek apakah jadwal ada dan sesuai dengan kelas mahasiswa
        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('kelas', $mahasiswa->kelas)
            ->firstOrFail();

        // Cek apakah sudah absen hari ini untuk jadwal ini
        $sudahAbsen = Absensi::where('nim', $mahasiswa->nim)
            ->where('id_jadwal', $idJadwal)
            ->whereDate('tanggal', today())
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Anda sudah melakukan absensi untuk mata kuliah ini hari ini.');
        }

        // TODO: Validasi QR Code / GPS di sini
        // $request->validate(['qr_code' => 'required|string']);
        // $request->validate(['latitude' => 'required|numeric', 'longitude' => 'required|numeric']);

        // Catat absensi
        Absensi::create([
            'nim' => $mahasiswa->nim,
            'id_jadwal' => $idJadwal,
            'tanggal' => today(),
            'jam_masuk' => now(),
            'status' => 'Hadir',
            'validasi' => 'pending',
        ]);

        return back()->with('success', 'Absensi berhasil dicatat! Menunggu validasi dari dosen.');
    }

    /**
     * Menampilkan riwayat kehadiran mahasiswa.
     * Tabel berisi kolom: No, Mata Kuliah, Tanggal, Jam Masuk, Keterangan, Status.
     */
    public function riwayat()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Ambil semua data absensi dengan relasi jadwal dan mata kuliah
        $riwayat = Absensi::where('nim', $mahasiswa->nim)
            ->with(['jadwal.mataKuliah'])
            ->orderByDesc('tanggal')
            ->paginate(15);

        // Hitung statistik
        $totalHadir = Absensi::where('nim', $mahasiswa->nim)->where('status', 'Hadir')->count();
        $totalIzinSakit = Absensi::where('nim', $mahasiswa->nim)->whereIn('status', ['Izin', 'Sakit'])->count();
        $totalAlpha = Absensi::where('nim', $mahasiswa->nim)->where('status', 'Alpha')->count();
        $totalPertemuan = $totalHadir + $totalIzinSakit + $totalAlpha;

        return view('mahasiswa.riwayat', compact(
            'user', 'mahasiswa', 'riwayat',
            'totalHadir', 'totalIzinSakit', 'totalAlpha', 'totalPertemuan'
        ));
    }

    /**
     * Menampilkan form pengajuan izin/sakit.
     */
    public function formIzin()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Ambil daftar mata kuliah berdasarkan kelas mahasiswa
        $jadwalList = Jadwal::where('kelas', $mahasiswa->kelas)
            ->with('mataKuliah')
            ->get();

        // Ambil riwayat pengajuan izin
        $riwayatIzin = PengajuanIzin::where('nim', $mahasiswa->nim)
            ->with('jadwal.mataKuliah')
            ->orderByDesc('tanggal_izin')
            ->paginate(10);

        return view('mahasiswa.dokumen', compact('user', 'mahasiswa', 'jadwalList', 'riwayatIzin'));
    }

    /**
     * Memproses pengajuan izin/sakit dari mahasiswa.
     * Mengunggah bukti surat (foto/PDF) ke storage.
     */
    public function submitIzin(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_jadwal' => 'required|exists:jadwals,id_jadwal',
            'tanggal_izin' => 'required|date',
            'jenis' => 'required|in:Izin,Sakit',
            'alasan' => 'required|string|max:500',
            'bukti_surat' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'id_jadwal.required' => 'Pilih mata kuliah terlebih dahulu.',
            'tanggal_izin.required' => 'Tanggal izin wajib diisi.',
            'jenis.required' => 'Pilih jenis pengajuan.',
            'alasan.required' => 'Alasan wajib diisi.',
            'bukti_surat.max' => 'Ukuran file maksimal 2MB.',
            'bukti_surat.mimes' => 'Format file harus JPG, JPEG, PNG, atau PDF.',
        ]);

        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $buktiPath = null;

        // Upload bukti surat jika ada
        if ($request->hasFile('bukti_surat')) {
            $buktiPath = $request->file('bukti_surat')
                ->store('izin/' . $mahasiswa->nim, 'public');
        }

        // Simpan pengajuan
        PengajuanIzin::create([
            'nim' => $mahasiswa->nim,
            'id_jadwal' => $request->id_jadwal,
            'tanggal_izin' => $request->tanggal_izin,
            'jenis' => $request->jenis,
            'alasan' => $request->alasan,
            'bukti_surat' => $buktiPath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan izin/sakit berhasil dikirim! Menunggu persetujuan.');
    }
}
