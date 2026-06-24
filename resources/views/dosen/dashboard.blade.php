{{--
    Dashboard Dosen
    Menampilkan jadwal mengajar hari ini dan akses ke fitur validasi.
--}}
@extends('layouts.app')

@section('title', __('app.dosen.dashboard'))
@section('page-title', __('app.dosen.dashboard'))

@section('content')
<div class="space-y-6">

    {{-- Salam --}}
    <div class="bg-gradient-to-r from-primary to-primary-light rounded-2xl p-6 text-white shadow-lg shadow-primary/10 dark:from-aurora-glow dark:to-aurora-glow-tertiary dark:shadow-aurora-glow/10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">{{ __('app.dosen.welcome') }}, {{ $dosen->nama }}</h2>
        <p class="text-white/80 text-sm mt-1">
            <i class="fas fa-id-badge mr-1"></i> {{ __('app.table.nidn') }}: {{ $dosen->nidn }} &middot; {{ $dosen->bidang_keahlian }}
        </p>
            </div>
            <div class="bg-white/10 px-4 py-2 rounded-xl text-sm text-white">
                <i class="fas fa-calendar mr-1"></i> {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 dark:bg-blue-500/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-day text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $jadwalHariIni->count() }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.dosen.jadwal_hari_ini') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 dark:bg-amber-500/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-amber-600 dark:text-amber-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $totalValidasiPending }}</p>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ __('app.dosen.validasi_pending') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Mengajar Hari Ini --}}
    <div class="bg-white glass rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/5">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
            <i class="fas fa-calendar-days text-uin-green dark:text-aurora-glow mr-2"></i>{{ __('app.dosen.jadwal_hari_ini') }}
        </h3>

        @if($jadwalHariIni->isEmpty())
            <div class="text-center py-8 text-gray-400 dark:text-slate-500">
                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                <p>Tidak ada jadwal mengajar hari ini</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($jadwalHariIni as $jadwal)
                    @php
                        $sesiAktif = $jadwal->sesis()->whereDate('tanggal', today())->where('status', 'dibuka')->first();
                    @endphp
                    <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-gray-800 dark:text-white">{{ $jadwal->mataKuliah->nama_mk }}</p>
                                    @if($sesiAktif)
                                        <span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-full text-xs font-semibold animate-pulse">
                                            <i class="fas fa-circle text-[6px] mr-1"></i>Sesi Aktif
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                                    <i class="fas fa-clock mr-1"></i> {{ $jadwal->jam_formatted }} &middot;
                                    <i class="fas fa-users mr-1"></i> {{ $jadwal->kelas }} &middot;
                                    <i class="fas fa-location-dot mr-1"></i> {{ $jadwal->ruang }}
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                {{-- Tombol Buka/Tutup Sesi --}}
                                @if($sesiAktif)
                                    <form action="{{ route('dosen.sesi.tutup', $sesiAktif->id_sesi) }}" method="POST"
                                          onsubmit="return confirm('Tutup sesi pertemuan ini? Mahasiswa tidak bisa absen lagi.')">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">
                                            <i class="fas fa-stop-circle mr-1"></i> Tutup Sesi
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('dosen.sesi.buka', $jadwal->id_jadwal) }}" method="POST"
                                          onsubmit="return confirm('Buka sesi pertemuan? Mahasiswa akan bisa melakukan absensi.')">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition-colors">
                                            <i class="fas fa-play-circle mr-1"></i> Buka Sesi
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('dosen.validasi', $jadwal->id_jadwal) }}"
                                   class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors
                                          dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary">
                                    <i class="fas fa-check-double mr-1"></i> Validasi
                                </a>
                                <a href="{{ route('dosen.rekap', $jadwal->id_jadwal) }}"
                                   class="px-4 py-2 bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-white/15 transition-colors">
                                    <i class="fas fa-chart-bar mr-1"></i> Rekap
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
