<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Controller Autentikasi
 * Menangani proses login, registrasi, dan logout untuk semua role.
 */
class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     * Jika user sudah login, redirect ke dashboard sesuai role.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->getDashboardUrl());
        }

        return view('auth.login');
    }

    /**
     * Memproses permintaan login.
     * Fitur PRD: lock akun setelah 5x gagal, cek is_active, catat last_login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => 'NIM/NIP/Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $username = $request->username;

        // Cek lock akun (5x gagal dalam 15 menit)
        $lockKey = 'login_attempts_' . $username;
        $attempts = Cache::get($lockKey, 0);

        if ($attempts >= 5) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Akun terkunci sementara karena 5x percobaan gagal. Coba lagi dalam 15 menit.']);
        }

        // Cari user
        $user = User::where('username', $username)->first();

        // Verifikasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Increment percobaan gagal
            Cache::put($lockKey, $attempts + 1, now()->addMinutes(15));

            $sisa = 5 - ($attempts + 1);
            $pesan = 'NIM/NIP/Username atau password salah.';
            if ($sisa > 0 && $sisa <= 3) {
                $pesan .= " Sisa percobaan: {$sisa}";
            }

            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => $pesan]);
        }

        // Cek apakah akun aktif
        if (isset($user->is_active) && !$user->is_active) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Akun ini telah dinonaktifkan. Hubungi administrator.']);
        }

        // Reset percobaan gagal setelah login berhasil
        Cache::forget($lockKey);

        // Catat waktu login terakhir
        $user->update(['last_login' => now()]);

        // Lakukan login
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended($user->getDashboardUrl())
                         ->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    /**
     * Menampilkan halaman registrasi mahasiswa.
     */
    public function showRegistrationForm()
    {
        return view('auth.register-mahasiswa');
    }

    /**
     * Menampilkan halaman registrasi dosen.
     */
    public function showDosenRegistrationForm()
    {
        return view('auth.register-dosen');
    }

    /**
     * Memproses registrasi akun mahasiswa baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'username' => $request->nim,
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'is_active' => 1,
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'kelas' => $request->kelas ?? 'Manajemen A',
            'angkatan' => $request->angkatan ?? date('Y'),
            'prodi' => 'Manajemen',
            'status_aktif' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('mahasiswa.dashboard')
                         ->with('success', 'Registrasi berhasil! Selamat datang di M-Presence FEB.');
    }

    /**
     * Memproses registrasi akun dosen baru.
     */
    public function registerDosen(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:20|unique:users,username|unique:dosens,nidn',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'username' => $request->nidn,
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'password' => Hash::make($request->password),
            'role' => 'dosen',
            'is_active' => 1,
        ]);

        Dosen::create([
            'nidn' => $request->nidn,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'status_aktif' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('dosen.dashboard')
                         ->with('success', 'Registrasi berhasil! Selamat datang di M-Presence FEB.');
    }

    /**
     * Menampilkan form ganti password (PRD F-13 opsional).
     */
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    /**
     * Memproses ganti password oleh user sendiri.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Melakukan logout dan mengakhiri sesi user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Anda telah berhasil logout.');
    }
}
