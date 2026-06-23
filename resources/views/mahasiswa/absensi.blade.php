{{--
    Halaman Absensi Mahasiswa - Dual Theme
--}}
@extends('layouts.app')

@section('title', __('app.mahasiswa.absensi_title'))
@section('page-title', __('app.mahasiswa.absensi_title'))

@section('content')
<div class="space-y-6">
    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm border border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20">
        <i class="fas fa-location-dot"></i>
        <span>GPS LOKASI: Dalam Kampus (FEB)</span>
    </div>

    @if($jadwalHariIni->isEmpty())
        <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-100 glass text-center">
            <i class="fas fa-calendar-xmark text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-600 dark:text-white">{{ __('app.mahasiswa.no_jadwal') }}</h3>
        </div>
    @else
        @foreach($jadwalHariIni as $jadwal)
            @php $sudahAbsen = isset($absensiHariIni[$jadwal->id_jadwal]); @endphp
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 glass">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $jadwal->mataKuliah->nama_mk }}</h3>
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs font-medium dark:bg-white/10 dark:text-slate-300">{{ $jadwal->kelas }}</span>
                        </div>
                        <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500 dark:text-slate-400">
                            <span><i class="far fa-clock text-gray-400 dark:text-slate-500 mr-1"></i> {{ now()->translatedFormat('l') }}, {{ $jadwal->jam_formatted }} WIB</span>
                            <span><i class="fas fa-location-dot text-gray-400 dark:text-slate-500 mr-1"></i> {{ $jadwal->ruang }}</span>
                            <span><i class="fas fa-layer-group text-gray-400 dark:text-slate-500 mr-1"></i> {{ $jadwal->mataKuliah->sks }} SKS</span>
                        </div>
                        <p class="text-sm text-gray-400 dark:text-slate-500 mt-2"><i class="fas fa-chalkboard-teacher mr-1"></i> {{ $jadwal->dosen->nama }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        @if($sudahAbsen)
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl text-sm font-medium dark:bg-emerald-500/10 dark:text-emerald-400">
                                <i class="fas fa-check-circle"></i> {{ __('app.mahasiswa.sudah_absen') }}
                            </span>
                        @elseif(isset($sesiAktif[$jadwal->id_jadwal]))
                            <form action="{{ route('mahasiswa.absensi.proses', $jadwal->id_jadwal) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark shadow-md transition-all dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary">
                                    <i class="fas fa-check mr-1"></i> {{ __('app.mahasiswa.absen_sekarang') }}
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-sm font-medium dark:bg-white/5 dark:text-slate-400">
                                <i class="fas fa-lock"></i> {{ __('app.mahasiswa.sesi_belum_dibuka') }}
                            </span>
                            <span class="text-xs text-gray-400 dark:text-slate-500"><i class="fas fa-info-circle mr-1"></i> {{ __('app.mahasiswa.menunggu_sesi') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
