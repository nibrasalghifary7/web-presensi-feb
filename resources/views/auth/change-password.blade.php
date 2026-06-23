@extends('layouts.app')

@section('page-title', 'Ganti Password')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-full mb-3">
                <i class="fas fa-key text-blue-600 text-xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Ganti Password</h2>
            <p class="text-sm text-gray-500 mt-1">Ubah password akun Anda</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                @foreach($errors->all() as $error)
                    <p><i class="fas fa-exclamation-circle mr-1"></i>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.change') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-lock text-uin-green mr-1"></i> Password Lama
                </label>
                <input type="password" name="current_password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 outline-none transition-all text-sm"
                       placeholder="Masukkan password lama" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-key text-uin-green mr-1"></i> Password Baru
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 outline-none transition-all text-sm"
                       placeholder="Minimal 6 karakter" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-check-double text-uin-green mr-1"></i> Konfirmasi Password Baru
                </label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 outline-none transition-all text-sm"
                       placeholder="Ulangi password baru" required>
            </div>

            <button type="submit"
                    class="w-full bg-uin-green hover:bg-uin-green-dark text-white font-bold py-3 px-4 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Simpan Password Baru
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="javascript:history.back()" class="text-sm text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
