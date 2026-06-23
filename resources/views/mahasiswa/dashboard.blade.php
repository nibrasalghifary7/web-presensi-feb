{{--
    Dashboard Mahasiswa
    Light: Clean white + Blue accent
    Dark: Aurora Glass
--}}
@extends('layouts.app')

@section('title', __('app.mahasiswa.dashboard'))
@section('page-title', __('app.mahasiswa.dashboard'))

@section('content')
<div class="space-y-6">

    {{-- Salam --}}
    <div class="bg-gradient-to-r from-primary to-primary-light rounded-2xl p-6 text-white shadow-lg shadow-primary/10 dark:from-aurora-glow dark:to-aurora-glow-tertiary dark:shadow-aurora-glow/10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">{{ __('app.dosen.welcome') }}, {{ $mahasiswa->nama }}! 👋</h2>
                <p class="text-white/80 text-sm mt-1">
                    <i class="fas fa-id-card mr-1"></i> {{ $mahasiswa->nim }} &middot; {{ $mahasiswa->kelas }} &middot; {{ __('app.table.angkatan') }} {{ $mahasiswa->angkatan }}
                </p>
            </div>
            <div class="bg-white/20 px-4 py-2 rounded-xl text-sm">
                <i class="fas fa-calendar mr-1"></i> {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-blue">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center dark:bg-blue-500/10 dark:border dark:border-blue-500/20">
                    <i class="fas fa-calendar-days text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPertemuan }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.mahasiswa.total_pertemuan') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-emerald">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center dark:bg-emerald-500/10 dark:border dark:border-emerald-500/20">
                    <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $totalHadir }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.mahasiswa.hadir') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-amber">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center dark:bg-amber-500/10 dark:border dark:border-amber-500/20">
                    <i class="fas fa-file-medical text-amber-600 dark:text-amber-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $totalIzinSakit }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.mahasiswa.izin_sakit') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 glass stat-glow-red">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center dark:bg-red-500/10 dark:border dark:border-red-500/20">
                    <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $totalAlpha }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.mahasiswa.alpha') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Persentase --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 glass">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ __('app.mahasiswa.persentase') }}</h3>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">{{ __('app.mahasiswa.persentase_desc') }}</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative w-20 h-20">
                    <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e5e7eb" stroke-width="3" class="dark:stroke-slate-700"/>
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="{{ $persentase>=75?'#10b981':($persentase>=50?'#f59e0b':'#ef4444') }}" stroke-width="3" stroke-dasharray="{{ $persentase }}, 100"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800 dark:text-white">{{ $persentase }}%</span>
                    </div>
                </div>
                <div>
                    @if($persentase>=75)
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium dark:bg-emerald-500/10 dark:text-emerald-400">
                            <i class="fas fa-check-circle"></i> {{ __('app.mahasiswa.memenuhi_syarat') }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium dark:bg-red-500/10 dark:text-red-400">
                            <i class="fas fa-exclamation-triangle"></i> {{ __('app.mahasiswa.belum_memenuhi') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Hari Ini --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 glass">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
            <i class="fas fa-calendar-day text-primary dark:text-aurora-glow mr-2"></i>{{ __('app.mahasiswa.jadwal_hari_ini') }}
        </h3>
        @if($jadwalHariIni->isEmpty())
            <div class="text-center py-8 text-gray-400 dark:text-slate-500">
                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                <p>{{ __('app.mahasiswa.no_jadwal') }}</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($jadwalHariIni as $jadwal)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 dark:bg-white/5 dark:border-white/5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center dark:bg-aurora-glow/10">
                                <i class="fas fa-book text-primary dark:text-aurora-glow"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-white">{{ $jadwal->mataKuliah->nama_mk }}</p>
                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    <i class="fas fa-clock mr-1"></i> {{ $jadwal->jam_formatted }} &middot;
                                    <i class="fas fa-location-dot mr-1"></i> {{ $jadwal->ruang }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-slate-500">{{ $jadwal->dosen->nama }}</p>
                            </div>
                        </div>
                        <a href="{{ route('mahasiswa.absensi') }}"
                           class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary">
                            <i class="fas fa-check mr-1"></i> {{ __('app.mahasiswa.absen') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
