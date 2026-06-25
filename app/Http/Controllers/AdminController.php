<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\PengajuanIzin;
use App\Models\Kelas;
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

        $mahasiswas = $query->orderBy('nama')->paginate(10);
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('admin.mahasiswa.index', compact('mahasiswas', 'kelasList'));
    }

    /**
     * Menampilkan form tambah mahasiswa.
     */
    public function mahasiswaCreate()
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();
        return view('admin.mahasiswa.create', compact('kelasList'));
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
        $kelasList = Kelas::orderBy('nama_kelas')->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'kelasList'));
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

    /**
     * Menampilkan form import mahasiswa.
     */
    public function mahasiswaImportForm()
    {
        return view('admin.mahasiswa.import');
    }

    /**
     * Download template CSV import mahasiswa.
     */
    public function mahasiswaTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template-import-mahasiswa.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            // Header CSV
            fputcsv($file, ['nim', 'nama', 'email', 'phone', 'kelas', 'angkatan', 'prodi', 'password']);
            // Contoh data
            fputcsv($file, ['12408011010099', 'Contoh Mahasiswa', 'contoh@student.uin-jkt.ac.id', '081234567890', 'Manajemen A', '2024', 'Manajemen', 'password123']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Import data mahasiswa dari CSV.
     */
    public function mahasiswaImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:5120',
        ], [
            'file.required' => 'Pilih file CSV terlebih dahulu.',
            'file.mimes' => 'Format file harus CSV.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getPathname(), 'r');

        // Skip header row
        $header = fgetcsv($handle);

        $success = 0;
        $failed = 0;
        $errors = [];

        $line = 1;
        while (($data = fgetcsv($handle)) !== false) {
            $line++;

            // Pastikan jumlah kolom sesuai
            if (count($data) < 7) {
                $errors[] = "Baris {$line}: Data tidak lengkap.";
                $failed++;
                continue;
            }

            $nim = trim($data[0]);
            $nama = trim($data[1]);
            $email = trim($data[2]);
            $phone = trim($data[3]);
            $kelas = trim($data[4]);
            $angkatan = trim($data[5]);
            $prodi = trim($data[6]);
            $password = isset($data[7]) && !empty($data[7]) ? trim($data[7]) : 'password123';

            // Validasi NIM unik
            if (User::where('username', $nim)->exists()) {
                $errors[] = "Baris {$line}: NIM {$nim} sudah terdaftar.";
                $failed++;
                continue;
            }

            try {
                // Buat user
                $user = User::create([
                    'username' => $nim,
                    'name' => $nama,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => \Illuminate\Support\Facades\Hash::make($password),
                    'role' => 'mahasiswa',
                ]);

                // Buat profil mahasiswa
                Mahasiswa::create([
                    'nim' => $nim,
                    'user_id' => $user->id,
                    'nama' => $nama,
                    'email' => $email,
                    'phone' => $phone,
                    'kelas' => $kelas,
                    'angkatan' => $angkatan,
                    'prodi' => $prodi ?: 'Manajemen',
                ]);

                $success++;
            } catch (\Exception $e) {
                $errors[] = "Baris {$line}: " . $e->getMessage();
                $failed++;
            }
        }

        fclose($handle);

        $message = "Import selesai: {$success} berhasil, {$failed} gagal.";
        if (!empty($errors)) {
            $message .= ' Error: ' . implode(' | ', array_slice($errors, 0, 5));
        }

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', $message);
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

        $dosens = $query->orderBy('nama')->paginate(10);

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
        $mataKuliahs = MataKuliah::orderBy('nama_mk')->paginate(10);
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

        $jadwals = $query->orderBy('hari')->orderBy('jam_mulai')->paginate(10);
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('admin.jadwal.index', compact('jadwals', 'mataKuliahs', 'dosens', 'kelasList'));
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
     * Mengupdate jadwal.
     */
    public function jadwalUpdate(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

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

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil diupdate.');
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

    // ========================================
    // PENGAJUAN IZIN/SAKIT
    // ========================================

    /**
     * Menampilkan daftar pengajuan izin/sakit dari mahasiswa.
     * Admin bisa filter berdasarkan status dan menyetujui/menolak.
     */
    public function pengajuanIndex(Request $request)
    {
        $query = PengajuanIzin::with(['mahasiswa', 'jadwal.mataKuliah']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama atau NIM
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $pengajuans = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    /**
     * Menyetujui pengajuan izin/sakit.
     * Mengubah status pengajuan menjadi 'disetujui'.
     */
    public function pengajuanApprove($id)
    {
        $pengajuan = PengajuanIzin::findOrFail($id);
        $pengajuan->update(['status' => 'disetujui']);

        return back()->with('success', 'Pengajuan izin/sakit berhasil disetujui.');
    }

    /**
     * Menolak pengajuan izin/sakit.
     * Mengubah status pengajuan menjadi 'ditolak'.
     */
    public function pengajuanReject($id)
    {
        $pengajuan = PengajuanIzin::findOrFail($id);
        $pengajuan->update(['status' => 'ditolak']);

        return back()->with('success', 'Pengajuan izin/sakit berhasil ditolak. Notifikasi telah dikirim ke dosen.');
    }

    // ========================================
    // KELOLA DATA KELAS (F-04)
    // ========================================

    /**
     * Menampilkan daftar kelas.
     */
    public function kelasIndex(Request $request)
    {
        $query = Kelas::query()->withCount('mahasiswas');

        if ($request->filled('search')) {
            $query->where('nama_kelas', 'like', "%{$request->search}%");
        }

        $kelas = $query->orderBy('nama_kelas')->paginate(10);

        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Menyimpan data kelas baru.
     */
    public function kelasStore(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:20|unique:kelas,nama_kelas',
            'angkatan' => 'required|string|max:10',
            'prodi' => 'required|string|max:50',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'angkatan' => $request->angkatan,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Mengupdate data kelas.
     */
    public function kelasUpdate(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:20|unique:kelas,nama_kelas,' . $id . ',id_kelas',
            'angkatan' => 'required|string|max:10',
        ]);

        $kelas->update($request->only(['nama_kelas', 'angkatan', 'prodi']));

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Data kelas berhasil diupdate.');
    }

    /**
     * Menghapus data kelas.
     */
    public function kelasDestroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Data kelas berhasil dihapus.');
    }

    // ========================================
    // KELOLA ABSENSI (F-06)
    // ========================================

    /**
     * Menampilkan semua data absensi.
     * Admin bisa filter dan koreksi data absensi.
     */
    public function absensiIndex(Request $request)
    {
        $query = Absensi::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        // Filter berdasarkan mata kuliah
        if ($request->filled('id_mk')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('id_mk', $request->id_mk);
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Pencarian berdasarkan NIM atau nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $absensis = $query->orderByDesc('tanggal')->orderByDesc('created_at')->paginate(10);
        $mataKuliahs = MataKuliah::all();
        $kelasList = Jadwal::select('kelas')->distinct()->pluck('kelas');

        return view('admin.absensi.index', compact('absensis', 'mataKuliahs', 'kelasList'));
    }

    /**
     * Mengupdate status absensi (koreksi manual oleh admin).
     */
    public function absensiUpdate(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'catatan' => 'nullable|string|max:255',
        ]);

        $absensi->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
            'validasi' => 'divalidasi',
        ]);

        return back()->with('success', 'Status absensi berhasil diperbarui.');
    }

    /**
     * Menghapus data absensi.
     */
    public function absensiDestroy($id)
    {
        Absensi::findOrFail($id)->delete();

        return back()->with('success', 'Data absensi berhasil dihapus.');
    }

    // ========================================
    // KELOLA AKUN PENGGUNA (F-07)
    // ========================================

    /**
     * Menampilkan daftar akun pengguna.
     */
    public function usersIndex(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Pencarian berdasarkan username, nama, atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menyimpan akun pengguna baru.
     */
    public function usersStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun pengguna berhasil ditambahkan.');
    }

    /**
     * Mengupdate data akun pengguna.
     */
    public function usersUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'role']));

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun pengguna berhasil diupdate.');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function usersDestroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun pengguna berhasil dihapus.');
    }

    /**
     * Reset password pengguna ke default.
     */
    public function usersResetPassword($id)
    {
        $user = User::findOrFail($id);
        $newPassword = 'password123';
        $user->update(['password' => Hash::make($newPassword)]);

        return back()->with('success', 'Password berhasil direset ke: ' . $newPassword);
    }

    // ========================================
    // LAPORAN ABSENSI (F-08)
    // ========================================

    /**
     * Menampilkan halaman laporan absensi dengan filter.
     */
    public function laporanIndex(Request $request)
    {
        $query = Absensi::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        // Filter berdasarkan mata kuliah
        if ($request->filled('id_mk')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('id_mk', $request->id_mk);
            });
        }

        // Filter berdasarkan dosen
        if ($request->filled('nidn')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('nidn', $request->nidn);
            });
        }

        // Filter berdasarkan tanggal range
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->where('tanggal', '<=', $request->tanggal_akhir);
        }

        $absensis = $query->orderByDesc('tanggal')->paginate(50);

        // Data untuk filter
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();
        $kelasList = Jadwal::select('kelas')->distinct()->pluck('kelas');

        // Rekap statistik
        $totalHadir = (clone $query)->where('status', 'Hadir')->count();
        $totalIzin = (clone $query)->where('status', 'Izin')->count();
        $totalSakit = (clone $query)->where('status', 'Sakit')->count();
        $totalAlpha = (clone $query)->where('status', 'Alpha')->count();
        $totalSemua = $totalHadir + $totalIzin + $totalSakit + $totalAlpha;

        return view('admin.laporan.index', compact(
            'absensis', 'mataKuliahs', 'dosens', 'kelasList',
            'totalHadir', 'totalIzin', 'totalSakit', 'totalAlpha', 'totalSemua'
        ));
    }

    /**
     * Export laporan absensi dalam format PDF.
     */
    public function laporanPdf(Request $request)
    {
        $query = Absensi::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        // Apply same filters
        if ($request->filled('kelas')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }
        if ($request->filled('id_mk')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('id_mk', $request->id_mk);
            });
        }
        if ($request->filled('nidn')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('nidn', $request->nidn);
            });
        }
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->where('tanggal', '<=', $request->tanggal_akhir);
        }

        $absensis = $query->orderByDesc('tanggal')->get();

        // Rekap per mahasiswa
        $rekap = $absensis->groupBy('nim')->map(function ($items) {
            return [
                'nama' => $items->first()->mahasiswa->nama,
                'hadir' => $items->where('status', 'Hadir')->count(),
                'izin' => $items->where('status', 'Izin')->count(),
                'sakit' => $items->where('status', 'Sakit')->count(),
                'alpha' => $items->where('status', 'Alpha')->count(),
                'total' => $items->count(),
            ];
        });

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan.pdf', compact('absensis', 'rekap'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-absensi-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export laporan absensi dalam format Excel (CSV).
     */
    public function laporanExcel(Request $request)
    {
        $query = Absensi::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        // Apply same filters
        if ($request->filled('kelas')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }
        if ($request->filled('id_mk')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('id_mk', $request->id_mk);
            });
        }
        if ($request->filled('nidn')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('nidn', $request->nidn);
            });
        }
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->where('tanggal', '<=', $request->tanggal_akhir);
        }

        $absensis = $query->orderByDesc('tanggal')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan-absensi-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($absensis) {
            $file = fopen('php://output', 'w');
            // BOM untuk UTF-8 Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header CSV
            fputcsv($file, ['No', 'NIM', 'Nama', 'Mata Kuliah', 'Kelas', 'Dosen', 'Tanggal', 'Jam Masuk', 'Status', 'Validasi']);
            // Data
            foreach ($absensis as $index => $a) {
                fputcsv($file, [
                    $index + 1,
                    $a->nim,
                    $a->mahasiswa->nama ?? '-',
                    $a->jadwal->mataKuliah->nama_mk ?? '-',
                    $a->jadwal->kelas ?? '-',
                    $a->jadwal->dosen->nama ?? '-',
                    $a->tanggal->format('Y-m-d'),
                    $a->jam_masuk ? substr($a->jam_masuk, 0, 5) : '-',
                    $a->status,
                    $a->validasi,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
