@extends('layouts.app')

@section('page-title', 'Persentase Kehadiran')

@section('content')
<!-- Summary Global -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 dark:bg-slate-800 dark:border dark:border-slate-700">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                <i class="fas fa-chart-pie text-uin-green mr-2"></i>Rata-Rata Kehadiran
            </h3>
            <p class="text-sm text-gray-500 mt-1 dark:text-slate-400">Seluruh mata kuliah</p>
        </div>
        <div class="text-right">
            <span class="text-4xl font-bold {{ $rataRataGlobal >= 75 ? 'text-green-600 dark:text-green-400' : ($rataRataGlobal >= 60 ? 'text-yellow-500 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                {{ $rataRataGlobal }}%
            </span>
            @if($rataRataGlobal >= 75)
                <p class="text-xs text-green-600 font-semibold mt-1 dark:text-green-400">✅ Aman</p>
            @elseif($rataRataGlobal >= 60)
                <p class="text-xs text-yellow-600 font-semibold mt-1 dark:text-yellow-400">⚠️ Peringatan</p>
            @else
                <p class="text-xs text-red-600 font-semibold mt-1 dark:text-red-400">🚫 Bahaya</p>
            @endif
        </div>
    </div>
    <!-- Progress bar global -->
    <div class="mt-4 w-full bg-gray-200 rounded-full h-3 dark:bg-slate-700">
        <div class="h-3 rounded-full transition-all duration-500
            {{ $rataRataGlobal >= 75 ? 'bg-green-500 dark:bg-green-400' : ($rataRataGlobal >= 60 ? 'bg-yellow-400 dark:bg-yellow-400' : 'bg-red-500 dark:bg-red-400') }}"
            style="width: {{ min($rataRataGlobal, 100) }}%"></div>
    </div>
</div>

<!-- Daftar per Mata Kuliah -->
@if(count($rekapMK) > 0)
    <div class="grid gap-4">
        @foreach($rekapMK as $mk)
        <div class="bg-white rounded-2xl shadow-lg p-5 border-l-4 dark:bg-slate-800 dark:border dark:border-slate-700
            {{ $mk['status'] === 'aman' ? 'border-green-500 dark:border-green-400' : ($mk['status'] === 'peringatan' ? 'border-yellow-400 dark:border-yellow-400' : 'border-red-500 dark:border-red-400') }}">

            <div class="flex items-start justify-between mb-3">
                <div>
                    <h4 class="font-bold text-gray-800 text-base dark:text-white">{{ $mk['nama_mk'] }}</h4>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ $mk['kode_mk'] }} • {{ $mk['nama_dosen'] }}</p>
                </div>
                <span class="text-xs font-bold px-3 py-1 rounded-full
                    {{ $mk['status'] === 'aman' ? 'bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400' : ($mk['status'] === 'peringatan' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-500/10 dark:text-yellow-400' : 'bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-400') }}">
                    {{ $mk['status_label'] }}
                </span>
            </div>

            <!-- Progress bar -->
            <div class="mb-3">
                <div class="flex justify-between text-xs mb-1">
                    <span class="font-semibold text-gray-600 dark:text-slate-300">Kehadiran</span>
                    <span class="font-bold {{ $mk['persen'] >= 75 ? 'text-green-600 dark:text-green-400' : ($mk['persen'] >= 60 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                        {{ $mk['persen'] }}%
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-slate-700">
                    <div class="h-2.5 rounded-full transition-all duration-500
                        {{ $mk['persen'] >= 75 ? 'bg-green-500 dark:bg-green-400' : ($mk['persen'] >= 60 ? 'bg-yellow-400 dark:bg-yellow-400' : 'bg-red-500 dark:bg-red-400') }}"
                        style="width: {{ min($mk['persen'], 100) }}%"></div>
                </div>
            </div>

            <!-- Breakdown -->
            <div class="grid grid-cols-5 gap-2 text-center">
                <div class="bg-blue-50 rounded-lg p-2 dark:bg-blue-500/10">
                    <p class="text-lg font-bold text-blue-700 dark:text-blue-400">{{ $mk['hadir'] }}</p>
                    <p class="text-xs text-blue-600 dark:text-blue-400">Hadir</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-2 dark:bg-blue-500/10">
                    <p class="text-lg font-bold text-blue-700 dark:text-blue-400">{{ $mk['izin'] }}</p>
                    <p class="text-xs text-blue-600 dark:text-blue-400">Izin</p>
                </div>
                <div class="bg-yellow-50 rounded-lg p-2 dark:bg-yellow-500/10">
                    <p class="text-lg font-bold text-yellow-700 dark:text-yellow-400">{{ $mk['sakit'] }}</p>
                    <p class="text-xs text-yellow-600 dark:text-yellow-400">Sakit</p>
                </div>
                <div class="bg-red-50 rounded-lg p-2 dark:bg-red-500/10">
                    <p class="text-lg font-bold text-red-700 dark:text-red-400">{{ $mk['alpha'] }}</p>
                    <p class="text-xs text-red-600 dark:text-red-400">Alpha</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-2 dark:bg-slate-700">
                    <p class="text-lg font-bold text-gray-700 dark:text-white">{{ $mk['total_pertemuan'] }}</p>
                    <p class="text-xs text-gray-600 dark:text-slate-400">Total</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-2xl shadow-lg p-8 text-center dark:bg-slate-800">
        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3 dark:text-slate-600"></i>
        <p class="text-gray-500 dark:text-slate-400">Belum ada data kehadiran</p>
    </div>
@endif

<!-- Legend -->
<div class="mt-4 bg-gray-50 rounded-xl p-4 text-xs text-gray-600 dark:bg-slate-800 dark:border dark:border-slate-700 dark:text-slate-400">
    <p class="font-semibold mb-2">Keterangan Status:</p>
    <div class="flex flex-wrap gap-4">
        <span><span class="inline-block w-3 h-3 bg-green-500 dark:bg-green-400 rounded-full mr-1"></span> ✅ Aman (≥75%)</span>
        <span><span class="inline-block w-3 h-3 bg-yellow-400 dark:bg-yellow-400 rounded-full mr-1"></span> ⚠️ Peringatan (60–74%)</span>
        <span><span class="inline-block w-3 h-3 bg-red-500 dark:bg-red-400 rounded-full mr-1"></span> 🚫 Bahaya (&lt;60%)</span>
    </div>
</div>
@endsection
