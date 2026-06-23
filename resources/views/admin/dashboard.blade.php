{{--
    Dashboard Admin
    Light: Clean white theme
    Dark: Aurora Glass theme
--}}
@extends('layouts.app')

@section('title', __('app.admin.dashboard'))
@section('page-title', __('app.admin.dashboard'))

@section('content')
<div class="space-y-6">

    {{-- Statistik Global --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- Total Mahasiswa --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-blue">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center dark:bg-blue-500/10 dark:border dark:border-blue-500/20">
                    <i class="fas fa-user-graduate text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalMahasiswa }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.admin.total_mahasiswa') }}</p>
                </div>
            </div>
        </div>

        {{-- Total Dosen --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-purple">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-purple-100 rounded-xl flex items-center justify-center dark:bg-purple-500/10 dark:border dark:border-purple-500/20">
                    <i class="fas fa-chalkboard-teacher text-purple-600 dark:text-purple-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalDosen }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.admin.total_dosen') }}</p>
                </div>
            </div>
        </div>

        {{-- Mata Kuliah --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-emerald">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center dark:bg-emerald-500/10 dark:border dark:border-emerald-500/20">
                    <i class="fas fa-book text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalMataKuliah }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.admin.total_matkul') }}</p>
                </div>
            </div>
        </div>

        {{-- Jadwal Kuliah --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-amber">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center dark:bg-amber-500/10 dark:border dark:border-amber-500/20">
                    <i class="fas fa-calendar-alt text-amber-600 dark:text-amber-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalJadwal }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.admin.total_jadwal') }}</p>
                </div>
            </div>
        </div>

        {{-- Absensi Hari Ini --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-cyan">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-cyan-100 rounded-xl flex items-center justify-center dark:bg-cyan-500/10 dark:border dark:border-cyan-500/20">
                    <i class="fas fa-check-double text-cyan-600 dark:text-cyan-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalAbsensiHariIni }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.admin.absensi_hari_ini') }}</p>
                </div>
            </div>
        </div>

        {{-- Pengajuan Pending --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-red">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center dark:bg-red-500/10 dark:border dark:border-red-500/20">
                    <i class="fas fa-file-circle-exclamation text-red-600 dark:text-red-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $totalPengajuanPending }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.admin.pengajuan_pending') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 glass">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">{{ __('app.admin.quick_access') }}</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="{{ route('admin.mahasiswa.index') }}" class="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors dark:bg-blue-500/10 dark:hover:bg-blue-500/20">
                <i class="fas fa-user-graduate text-blue-600 dark:text-blue-400 text-xl"></i>
                <span class="text-xs font-medium text-blue-800 dark:text-blue-300">{{ __('app.admin.kelola_mahasiswa') }}</span>
            </a>
            <a href="{{ route('admin.dosen.index') }}" class="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors dark:bg-purple-500/10 dark:hover:bg-purple-500/20">
                <i class="fas fa-chalkboard-teacher text-purple-600 dark:text-purple-400 text-xl"></i>
                <span class="text-xs font-medium text-purple-800 dark:text-purple-300">{{ __('app.admin.kelola_dosen') }}</span>
            </a>
            <a href="{{ route('admin.mata-kuliah.index') }}" class="flex flex-col items-center gap-2 p-4 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition-colors dark:bg-emerald-500/10 dark:hover:bg-emerald-500/20">
                <i class="fas fa-book text-emerald-600 dark:text-emerald-400 text-xl"></i>
                <span class="text-xs font-medium text-emerald-800 dark:text-emerald-300">{{ __('app.menu.mata_kuliah') }}</span>
            </a>
            <a href="{{ route('admin.jadwal.index') }}" class="flex flex-col items-center gap-2 p-4 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors dark:bg-amber-500/10 dark:hover:bg-amber-500/20">
                <i class="fas fa-calendar-alt text-amber-600 dark:text-amber-400 text-xl"></i>
                <span class="text-xs font-medium text-amber-800 dark:text-amber-300">{{ __('app.menu.jadwal') }}</span>
            </a>
        </div>
    </div>
</div>
@endsection
