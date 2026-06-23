<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controller Admin
 * Menangani fitur yang dapat diakses oleh admin:
 * - Dashboard Statistik Global
 * - CRUD Data Mahasiswa
 * - CRUD Data Dosen
 * - CRUD Data Mata Kuliah
 * - Manajemen Jadwal Kuliah
 */
class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan statistik global.
     */
    public function dashboard()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMataKuliah = MataKuliah::count();
        $totalJadwal = Jadwal::count();
        $totalAbsensiHariIni = Absensi::whereDate('tanggal', today())->count();
        $totalPengajuanPending = \App\Models\PengajuanIzin::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalMahasiswa', 'totalDosen', 'totalMataKuliah',
            'totalJadwal', 'totalAbsensiHariIni', 'totalPengajuanPending'
        ));
    }

    // ========================================
    // CRUD MAHASISWA
    // ========================================

    /**
     * Menampilkan daftar semua mahasiswa.
     */
    public function mahasiswaIndex(Request $request)
    {
        $query = Mahasiswa::with('user');

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // Filter berdasarkan angkatan
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        // Pencarian berdasarkan nama atau NIM
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $mahasiswas = $query->orderBy('nama')->paginate(20);

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Menampilkan form tambah mahasiswa.
     */
    public function mahasiswaCreate()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Menyimpan data mahasiswa baru.
     */
    public function mahasiswaStore(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'kelas' => 'required|string|max:20',
            'angkatan' => 'required|string|max:10',
        ]);

        // Buat user
        $user = User::create([
            'username' => $request->nim,
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password123'), // Default password
            'role' => 'mahasiswa',
        ]);

        // Buat profil mahasiswa
        Mahasiswa::create([
            'nim' => $request->nim,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'kelas' => $request->kelas,
            'angkatan' => $request->angkatan,
            'prodi' => $request->prodi ?? 'Manajemen',
        ]);

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit mahasiswa.
     */
    public function mahasiswaEdit($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->with('user')->firstOrFail();
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Mengupdate data mahasiswa.
     */
    public function mahasiswaUpdate(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'kelas' => 'required|string|max:20',
            'angkatan' => 'required|string|max:10',
        ]);

        $mahasiswa->update($request->only(['nama', 'email', 'phone', 'kelas', 'angkatan', 'prodi']));

        // Update juga data user
        $mahasiswa->user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    /**
     * Menghapus data mahasiswa.
     */
    public function mahasiswaDestroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->user->delete(); // Akan meng-cascade ke mahasiswas

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // ========================================
    // CRUD DOSEN
    // ========================================

    /**
     * Menampilkan daftar semua dosen.
     */
    public function dosenIndex(Request $request)
    {
        $query = Dosen::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nidn', 'like', "%{$search}%");
            });
        }

        $dosens = $query->orderBy('nama')->paginate(20);

        return view('admin.dosen.index', compact('dosens'));
    }

    /**
     * Menampilkan form tambah dosen.
     */
    public function dosenCreate()
    {
        return view('admin.dosen.create');
    }

    /**
     * Menyimpan data dosen baru.
     */
    public function dosenStore(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:20|unique:dosens,nidn',
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'bidang_keahlian' => 'nullable|string|max:100',
        ]);

        $user = User::create([
            'username' => $request->nidn,
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password123'),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'nidn' => $request->nidn,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'bidang_keahlian' => $request->bidang_keahlian,
        ]);

        return redirect()->route('admin.dosen.index')
                         ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit dosen.
     */
    public function dosenEdit($nidn)
    {
        $dosen = Dosen::where('nidn', $nidn)->with('user')->firstOrFail();
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Mengupdate data dosen.
     */
    public function dosenUpdate(Request $request, $nidn)
    {
        $dosen = Dosen::where('nidn', $nidn)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'bidang_keahlian' => 'nullable|string|max:100',
        ]);

        $dosen->update($request->only(['nama', 'email', 'phone', 'bidang_keahlian']));
        $dosen->user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dosen.index')
                         ->with('success', 'Data dosen berhasil diupdate.');
    }

    /**
     * Menghapus data dosen.
     */
    public function dosenDestroy($nidn)
    {
        $dosen = Dosen::where('nidn', $nidn)->firstOrFail();
        $dosen->user->delete();

        return redirect()->route('admin.dosen.index')
                         ->with('success', 'Data dosen berhasil dihapus.');
    }

    // ========================================
    // CRUD MATA KULIAH
    // ========================================

    /**
     * Menampilkan daftar mata kuliah.
     */
    public function mataKuliahIndex()
    {
        $mataKuliahs = MataKuliah::orderBy('nama_mk')->paginate(20);
        return view('admin.mata-kuliah.index', compact('mataKuliahs'));
    }

    /**
     * Menyimpan data mata kuliah baru.
     */
    public function mataKuliahStore(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:20|unique:mata_kuliahs,kode_mk',
            'nama_mk' => 'required|string|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|string|max:10',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.mata-kuliah.index')
                         ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    /**
     * Mengupdate data mata kuliah.
     */
    public function mataKuliahUpdate(Request $request, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        $request->validate([
            'nama_mk' => 'required|string|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|string|max:10',
        ]);

        $mataKuliah->update($request->only(['nama_mk', 'sks', 'semester', 'prodi']));

        return redirect()->route('admin.mata-kuliah.index')
                         ->with('success', 'Data mata kuliah berhasil diupdate.');
    }

    /**
     * Menghapus data mata kuliah.
     */
    public function mataKuliahDestroy($id)
    {
        MataKuliah::findOrFail($id)->delete();

        return redirect()->route('admin.mata-kuliah.index')
                         ->with('success', 'Data mata kuliah berhasil dihapus.');
    }

    // ========================================
    // MANAJEMEN JADWAL
    // ========================================

    /**
     * Menampilkan daftar jadwal kuliah.
     */
    public function jadwalIndex(Request $request)
    {
        $query = Jadwal::with(['mataKuliah', 'dosen']);

        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        $jadwals = $query->orderBy('hari')->orderBy('jam_mulai')->paginate(20);
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();

        return view('admin.jadwal.index', compact('jadwals', 'mataKuliahs', 'dosens'));
    }

    /**
     * Menyimpan jadwal baru.
     */
    public function jadwalStore(Request $request)
    {
        $request->validate([
            'id_mk' => 'required|exists:mata_kuliahs,id_mk',
            'nidn' => 'required|exists:dosens,nidn',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruang' => 'nullable|string|max:50',
            'kelas' => 'required|string|max:20',
            'semester_aktif' => 'required|string|max:20',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Menghapus jadwal.
     */
    public function jadwalDestroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil dihapus.');
    }
}
