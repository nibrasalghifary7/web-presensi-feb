{{--
    Halaman Absensi Mahasiswa
    Menampilkan jadwal mata kuliah hari ini dengan tombol absensi.
    Placeholder untuk pengembangan QR Code / GPS.
--}}
@extends('layouts.app')

@section('title', 'Absensi')
@section('page-title', 'Absensi Hari Ini')

@section('content')
<div class="space-y-6">

    {{-- Info Lokasi (Placeholder GPS) --}}
    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm border border-blue-200">
        <i class="fas fa-location-dot"></i>
        <span>GPS LOKASI: Dalam Kampus (FEB)</span>
    </div>

    {{-- Daftar Jadwal Hari Ini --}}
    @if($jadwalHariIni->isEmpty())
        <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-100 text-center">
            <i class="fas fa-calendar-xmark text-5xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-600">Tidak Ada Jadwal Hari Ini</h3>
            <p class="text-sm text-gray-400 mt-1">Anda tidak memiliki mata kuliah yang dijadwalkan hari ini.</p>
        </div>
    @else
        @foreach($jadwalHariIni as $jadwal)
            @php
                $sudahAbsen = isset($absensiHariIni[$jadwal->id_jadwal]);
            @endphp
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                        {{-- Nama Mata Kuliah & Kelas --}}
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-lg font-bold text-gray-800">{{ $jadwal->mataKuliah->nama_mk }}</h3>
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                {{ $jadwal->kelas }}
                            </span>
                        </div>

                        {{-- Detail Jadwal --}}
                        <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500">
                            <span><i class="far fa-clock text-gray-400 mr-1"></i> {{ now()->translatedFormat('l') }}, {{ $jadwal->jam_formatted }} WIB</span>
                            <span><i class="fas fa-location-dot text-gray-400 mr-1"></i> {{ $jadwal->ruang }}</span>
                            <span><i class="fas fa-layer-group text-gray-400 mr-1"></i> {{ $jadwal->mataKuliah->sks }} SKS</span>
                        </div>

                        {{-- Nama Dosen --}}
                        <p class="text-sm text-gray-400 mt-2">
                            <i class="fas fa-chalkboard-teacher mr-1"></i> {{ $jadwal->dosen->nama }}
                        </p>
                    </div>

                    {{-- Tombol Absensi --}}
                    <div class="flex flex-col items-end gap-2">
                        @if($sudahAbsen)
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl text-sm font-medium">
                                <i class="fas fa-check-circle"></i> Sudah Absen
                            </span>
                            <span class="text-xs text-gray-400">Status: {{ $absensiHariIni[$jadwal->id_jadwal] }}</span>
                        @elseif(isset($sesiAktif[$jadwal->id_jadwal]))
                            <form action="{{ route('mahasiswa.absensi.proses', $jadwal->id_jadwal) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-semibold
                                               hover:bg-uin-green-dark shadow-md hover:shadow-lg transition-all">
                                    <i class="fas fa-check mr-1"></i> Absen Sekarang
                                </button>
                            </form>
                            <span class="text-xs text-emerald-600">
                                <i class="fas fa-circle text-[8px] mr-1 animate-pulse"></i> Sesi aktif — Anda bisa absen
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-sm font-medium">
                                <i class="fas fa-lock"></i> Sesi Belum Dibuka
                            </span>
                            <span class="text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i> Menunggu dosen membuka sesi pertemuan
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Placeholder Fitur Pengembangan --}}
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
        <div class="flex items-start gap-3">
            <i class="fas fa-lightbulb text-amber-500 mt-0.5"></i>
            <div>
                <p class="text-sm font-semibold text-amber-800">Fitur Pengembangan</p>
                <p class="text-xs text-amber-600 mt-1">
                    Pengembangan selanjutnya akan menambahkan:
                </p>
                <ul class="text-xs text-amber-600 mt-2 space-y-1 list-disc list-inside">
                    <li>Absensi menggunakan QR Code yang di-generate dosen</li>
                    <li>Verifikasi lokasi GPS dalam radius kampus</li>
                    <li>Notifikasi pengingat jadwal kuliah</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
