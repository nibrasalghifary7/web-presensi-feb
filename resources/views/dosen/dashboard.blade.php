{{--
    Dashboard Dosen
    Menampilkan jadwal mengajar hari ini dan akses ke fitur validasi.
--}}
@extends('layouts.app')

@section('title', 'Dashboard Dosen')
@section('page-title', 'Dashboard Dosen')

@section('content')
<div class="space-y-6">

    {{-- Salam --}}
    <div class="bg-gradient-to-r from-uin-green to-uin-green-light rounded-2xl p-6 text-white">
        <h2 class="text-2xl font-bold">Selamat Datang, {{ $dosen->nama }}</h2>
        <p class="text-white/80 text-sm mt-1">
            <i class="fas fa-id-badge mr-1"></i> NIDN: {{ $dosen->nidn }} &middot; {{ $dosen->bidang_keahlian }}
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-day text-blue-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $jadwalHariIni->count() }}</p>
                    <p class="text-xs text-gray-500">Jadwal Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-amber-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-600">{{ $totalValidasiPending }}</p>
                    <p class="text-xs text-gray-500">Menunggu Validasi</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Mengajar Hari Ini --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-calendar-days text-uin-green mr-2"></i>Jadwal Mengajar Hari Ini
        </h3>

        @if($jadwalHariIni->isEmpty())
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                <p>Tidak ada jadwal mengajar hari ini</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($jadwalHariIni as $jadwal)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $jadwal->mataKuliah->nama_mk }}</p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-clock mr-1"></i> {{ $jadwal->jam_formatted }} &middot;
                                <i class="fas fa-users mr-1"></i> {{ $jadwal->kelas }} &middot;
                                <i class="fas fa-location-dot mr-1"></i> {{ $jadwal->ruang }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('dosen.validasi', $jadwal->id_jadwal) }}"
                               class="px-4 py-2 bg-uin-green text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark transition-colors">
                                <i class="fas fa-check-double mr-1"></i> Validasi
                            </a>
                            <a href="{{ route('dosen.rekap', $jadwal->id_jadwal) }}"
                               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                <i class="fas fa-chart-bar mr-1"></i> Rekap
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
