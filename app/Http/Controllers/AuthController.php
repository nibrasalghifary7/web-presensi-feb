<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect(Auth::user()->getDashboardUrl());
        }

        return view('auth.login');
    }

    /**
     * Memproses permintaan login.
     * Melakukan autentikasi berdasarkan username dan password.
     * Role otomatis dideteksi dari database.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => 'NIM/NIP/Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // Cari user berdasarkan username saja (role otomatis dari database)
        $user = User::where('username', $request->username)->first();

        // Verifikasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'NIM/NIP/Username atau password salah.']);
        }

        // Lakukan login
        Auth::login($user, $request->boolean('remember'));

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Redirect ke dashboard sesuai role
        return redirect()->intended($user->getDashboardUrl())
                         ->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    /**
     * Menampilkan halaman registrasi mahasiswa.
     * Hanya mahasiswa yang bisa mendaftar sendiri.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Memproses registrasi akun mahasiswa baru.
     * Membuat record di tabel users dan mahasiswas.
     */
    public function register(Request $request)
    {
        // Validasi input registrasi
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Buat user baru dengan role mahasiswa
        $user = User::create([
            'username' => $request->nim,
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        // Buat data profil mahasiswa
        Mahasiswa::create([
            'nim' => $request->nim,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'kelas' => $request->kelas ?? 'Manajemen A',
            'angkatan' => $request->angkatan ?? date('Y'),
            'prodi' => 'Manajemen',
        ]);

        // Auto-login setelah registrasi berhasil
        Auth::login($user);

        return redirect()->route('mahasiswa.dashboard')
                         ->with('success', 'Registrasi berhasil! Selamat datang di M-Presence FEB.');
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
