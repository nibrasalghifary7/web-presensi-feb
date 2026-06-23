{{--
    Rekap Kehadiran per Mata Kuliah (Dosen)
    Menampilkan ringkasan kehadiran mahasiswa.
--}}
@extends('layouts.app')

@section('title', __('app.dosen.rekap_title'))
@section('page-title', __('app.dosen.rekap_title'))

@section('content')
<div class="space-y-6">

    {{-- Info Mata Kuliah --}}
    <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $jadwal->mataKuliah->nama_mk }}</h3>
                <p class="text-sm text-gray-500 dark:text-slate-400">{{ $jadwal->kelas }} &middot; {{ $jadwal->jam_formatted }}</p>
            </div>
            <a href="{{ route('dosen.laporan', $jadwal->id_jadwal) }}"
               class="px-4 py-2 bg-uin-green dark:bg-aurora-glow text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark dark:hover:bg-aurora-glow-secondary transition-colors">
                <i class="fas fa-print mr-1"></i> Cetak Laporan
            </a>
        </div>
    </div>

    {{-- Tabel Rekap --}}
    <div class="bg-white glass rounded-xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Hadir</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Izin</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Sakit</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Alpha</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">%</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($rekap as $nim => $absensis)
                        @php
                            $mahasiswa = $absensis->first()->mahasiswa;
                            $hadir = $absensis->where('status', 'Hadir')->count();
                            $izin = $absensis->where('status', 'Izin')->count();
                            $sakit = $absensis->where('status', 'Sakit')->count();
                            $alpha = $absensis->where('status', 'Alpha')->count();
                            $total = $absensis->count();
                            $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800">{{ $mahasiswa->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-center text-sm font-semibold text-emerald-600">{{ $hadir }}</td>
                            <td class="px-5 py-3 text-center text-sm text-amber-600">{{ $izin }}</td>
                            <td class="px-5 py-3 text-center text-sm text-yellow-600">{{ $sakit }}</td>
                            <td class="px-5 py-3 text-center text-sm text-red-600">{{ $alpha }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $persen >= 75 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $persen }}%
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-400">
                                Belum ada data kehadiran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
