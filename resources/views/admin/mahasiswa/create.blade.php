{{--
    Form Tambah Mahasiswa (Admin)
--}}
@extends('layouts.app')

@section('title', __('app.admin.mahasiswa_add'))
@section('page-title', __('app.admin.mahasiswa_add'))

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5">
            <i class="fas fa-user-plus text-uin-green mr-2"></i>{{ __('app.admin.mahasiswa_add') }}
        </h3>

        <form method="POST" action="{{ route('admin.mahasiswa.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                    @error('nim') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">No. HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Kelas</label>
                    <select name="kelas" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k->nama_kelas }}" {{ old('kelas') == $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Angkatan</label>
                    <select name="angkatan" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit"
                        class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="{{ route('admin.mahasiswa.index') }}"
                   class="px-6 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
