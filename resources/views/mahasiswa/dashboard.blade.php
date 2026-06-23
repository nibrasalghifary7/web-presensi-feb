{{--
    Dashboard Mahasiswa - M-Presence FEB
    Menampilkan ringkasan profil, kartu info cepat, dan persentase kehadiran.
    Syarat ujian minimal 75% kehadiran.
--}}
@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Salam Pembuka --}}
    <div class="bg-gradient-to-r from-uin-green to-uin-green-light rounded-2xl p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">Halo, {{ $mahasiswa->nama }}! 👋</h2>
                <p class="text-white/80 text-sm mt-1">
                    <i class="fas fa-id-card mr-1"></i> {{ $mahasiswa->nim }} &middot; {{ $mahasiswa->kelas }} &middot; Angkatan {{ $mahasiswa->angkatan }}
                </p>
            </div>
            <div class="bg-white/20 px-4 py-2 rounded-xl text-sm">
                <i class="fas fa-calendar mr-1"></i> {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Pertemuan --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-days text-blue-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPertemuan }}</p>
                    <p class="text-xs text-gray-500">Total Pertemuan</p>
                </div>
            </div>
        </div>

        {{-- Hadir --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-600">{{ $totalHadir }}</p>
                    <p class="text-xs text-gray-500">Hadir</p>
                </div>
            </div>
        </div>

        {{-- Izin/Sakit --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-medical text-amber-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-600">{{ $totalIzinSakit }}</p>
                    <p class="text-xs text-gray-500">Izin / Sakit</p>
                </div>
            </div>
        </div>

        {{-- Alpha --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600">{{ $totalAlpha }}</p>
                    <p class="text-xs text-gray-500">Alpha</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Persentase Kehadiran --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Persentase Kehadiran</h3>
                <p class="text-sm text-gray-500 mt-1">Syarat mengikuti ujian: minimal 75% kehadiran</p>
            </div>
            <div class="flex items-center gap-4">
                {{-- Progress Circle --}}
                <div class="relative w-20 h-20">
                    <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none" stroke="#e5e7eb" stroke-width="3"/>
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none"
                              stroke="{{ $persentase >= 75 ? '#10b981' : ($persentase >= 50 ? '#f59e0b' : '#ef4444') }}"
                              stroke-width="3"
                              stroke-dasharray="{{ $persentase }}, 100"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800">{{ $persentase }}%</span>
                    </div>
                </div>
                <div>
                    @if($persentase >= 75)
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle"></i> Memenuhi Syarat
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                            <i class="fas fa-exclamation-triangle"></i> Belum Memenuhi
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Hari Ini --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-calendar-day text-uin-green mr-2"></i>Jadwal Hari Ini
        </h3>

        @if($jadwalHariIni->isEmpty())
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                <p>Tidak ada jadwal kuliah hari ini</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($jadwalHariIni as $jadwal)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-uin-green/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-uin-green"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $jadwal->mataKuliah->nama_mk }}</p>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i> {{ $jadwal->jam_formatted }} &middot;
                                    <i class="fas fa-location-dot mr-1"></i> {{ $jadwal->ruang }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $jadwal->dosen->nama }}</p>
                            </div>
                        </div>
                        <a href="{{ route('mahasiswa.absensi') }}"
                           class="px-4 py-2 bg-uin-green text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark transition-colors">
                            <i class="fas fa-check mr-1"></i> Absen
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
