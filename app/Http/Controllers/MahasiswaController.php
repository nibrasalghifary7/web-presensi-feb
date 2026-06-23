<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\PengajuanIzin;
use App\Models\Sesi;
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

        // Hitung statistik kehadiran (hanya yang sudah divalidasi dosen)
        $totalPertemuan = Absensi::where('nim', $mahasiswa->nim)->where('status', '!=', 'Menunggu')->count();
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
     * Menampilkan jadwal mata kuliah yang aktif hari ini beserta status sesi.
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

        // Ambil sesi aktif hari ini untuk jadwal-jadwal ini
        $sesiAktif = Sesi::whereIn('id_jadwal', $jadwalHariIni->pluck('id_jadwal'))
            ->whereDate('tanggal', today())
            ->where('status', 'dibuka')
            ->pluck('id_sesi', 'id_jadwal');

        return view('mahasiswa.absensi', compact('user', 'mahasiswa', 'jadwalHariIni', 'absensiHariIni', 'sesiAktif'));
    }

    /**
     * Memproses klik absensi dari mahasiswa.
     * Hanya bisa absen jika sesi pertemuan sudah dibuka oleh dosen.
     */
    public function prosesAbsensi(Request $request, $idJadwal)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Cek apakah jadwal ada dan sesuai dengan kelas mahasiswa
        $jadwal = Jadwal::where('id_jadwal', $idJadwal)
            ->where('kelas', $mahasiswa->kelas)
            ->firstOrFail();

        // Cek apakah ada sesi aktif untuk jadwal ini hari ini
        $sesiAktif = Sesi::where('id_jadwal', $idJadwal)
            ->whereDate('tanggal', today())
            ->where('status', 'dibuka')
            ->first();

        if (!$sesiAktif) {
            return back()->with('error', 'Sesi pertemuan belum dibuka oleh dosen. Anda belum bisa melakukan absensi.');
        }

        // Cek apakah sudah absen hari ini untuk jadwal ini
        $sudahAbsen = Absensi::where('nim', $mahasiswa->nim)
            ->where('id_jadwal', $idJadwal)
            ->whereDate('tanggal', today())
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Anda sudah melakukan absensi untuk mata kuliah ini hari ini.');
        }

        // Catat absensi dengan status "Menunggu" (belum divalidasi dosen)
        Absensi::create([
            'nim' => $mahasiswa->nim,
            'id_jadwal' => $idJadwal,
            'tanggal' => today(),
            'jam_masuk' => now(),
            'status' => 'Menunggu',
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
            ->paginate(10);

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

    /**
     * Menampilkan halaman profil mahasiswa (PRD F-13).
     * Data read-only, tidak bisa edit mandiri.
     */
    public function profil()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.profil', compact('user', 'mahasiswa'));
    }

    /**
     * Menampilkan persentase kehadiran per mata kuliah (PRD F-16).
     * Progress bar dengan warna indikator: Hijau (≥75%), Kuning (60-74%), Merah (<60%).
     */
    public function kehadiran()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Ambil semua absensi mahasiswa, group by jadwal (mata kuliah)
        $absensiPerMK = Absensi::where('nim', $mahasiswa->nim)
            ->with(['jadwal.mataKuliah', 'jadwal.dosen'])
            ->get()
            ->groupBy('id_jadwal');

        $rekapMK = [];
        $totalHadirGlobal = 0;
        $totalPertemuanGlobal = 0;

        foreach ($absensiPerMK as $idJadwal => $absensis) {
            $jadwal = $absensis->first()->jadwal;
            $mk = $jadwal->mataKuliah;
            $dosen = $jadwal->dosen;

            // Hanya hitung yang sudah divalidasi (bukan Menunggu)
            $validated = $absensis->where('status', '!=', 'Menunggu');
            $totalPertemuan = $validated->count();
            $hadir = $validated->where('status', 'Hadir')->count();
            $izin = $validated->where('status', 'Izin')->count();
            $sakit = $validated->where('status', 'Sakit')->count();
            $alpha = $validated->where('status', 'Alpha')->count();
            $persen = $totalPertemuan > 0 ? round(($hadir / $totalPertemuan) * 100, 1) : 0;

            // Status berdasarkan threshold PRD
            if ($persen >= 75) {
                $statusKehadiran = 'aman';
                $statusLabel = 'Aman';
            } elseif ($persen >= 60) {
                $statusKehadiran = 'peringatan';
                $statusLabel = 'Peringatan';
            } else {
                $statusKehadiran = 'bahaya';
                $statusLabel = 'Bahaya';
            }

            $rekapMK[] = [
                'kode_mk' => $mk->kode_mk ?? '-',
                'nama_mk' => $mk->nama_mk ?? '-',
                'nama_dosen' => $dosen->nama ?? '-',
                'total_pertemuan' => $totalPertemuan,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpha' => $alpha,
                'persen' => $persen,
                'status' => $statusKehadiran,
                'status_label' => $statusLabel,
            ];

            $totalHadirGlobal += $hadir;
            $totalPertemuanGlobal += $totalPertemuan;
        }

        $rataRataGlobal = $totalPertemuanGlobal > 0 ? round(($totalHadirGlobal / $totalPertemuanGlobal) * 100, 1) : 0;

        return view('mahasiswa.kehadiran', compact('user', 'mahasiswa', 'rekapMK', 'rataRataGlobal'));
    }
}
