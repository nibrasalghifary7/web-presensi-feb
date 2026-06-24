{{--
    Form Tambah Dosen (Admin)
--}}
@extends('layouts.app')

@section('title', __('app.admin.dosen_add'))
@section('page-title', __('app.admin.dosen_add'))

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5">
            <i class="fas fa-chalkboard-teacher text-uin-green mr-2"></i>Form Tambah Dosen
        </h3>

        <form method="POST" action="{{ route('admin.dosen.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">NIDN</label>
                    <input type="text" name="nidn" value="{{ old('nidn') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none dark:bg-slate-700 dark:text-white">
                    @error('nidn') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none dark:bg-slate-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none dark:bg-slate-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">No. HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none dark:bg-slate-700 dark:text-white">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Bidang Keahlian</label>
                    <input type="text" name="bidang_keahlian" value="{{ old('bidang_keahlian') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none dark:bg-slate-700 dark:text-white">
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="px-6 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
