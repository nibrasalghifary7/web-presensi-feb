{{--
    Rekap Kehadiran per Jadwal (Admin)
    Menampilkan ringkasan kehadiran mahasiswa.
--}}
@extends('layouts.app')

@section('title', 'Rekap Kehadiran')
@section('page-title', 'Rekap Kehadiran')

@section('content')
<div class="space-y-6">

    {{-- Info Mata Kuliah --}}
    <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $jadwal->mataKuliah->nama_mk }}</h3>
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    {{ $jadwal->kelas }} &middot; {{ $jadwal->jam_formatted }} &middot; Dosen: {{ $jadwal->dosen->nama ?? '-' }}
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.presensi.exportPdf', $jadwal->id_jadwal) }}"
                   class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-600 dark:hover:bg-red-700 transition-colors">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
                <a href="{{ route('admin.presensi.exportExcel', $jadwal->id_jadwal) }}"
                   class="px-4 py-2 bg-emerald-500 dark:bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 dark:hover:bg-emerald-700 transition-colors">
                    <i class="fas fa-file-excel mr-1"></i> Excel
                </a>
                <a href="{{ route('admin.presensi.index') }}"
                   class="px-4 py-2 bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-white/10 transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- Tabel Rekap --}}
    <div class="bg-white glass rounded-xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Hadir</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Izin</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Sakit</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Alpha</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">%</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-white/5">
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
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $mahasiswa->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-center text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ $hadir }}</td>
                            <td class="px-5 py-3 text-center text-sm text-amber-600 dark:text-amber-400">{{ $izin }}</td>
                            <td class="px-5 py-3 text-center text-sm text-yellow-600 dark:text-yellow-400">{{ $sakit }}</td>
                            <td class="px-5 py-3 text-center text-sm text-red-600 dark:text-red-400">{{ $alpha }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $persen >= 75 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-400' }}">
                                    {{ $persen }}%
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-400 dark:text-slate-500">
                                <i class="fas fa-clipboard-list text-4xl mb-3"></i>
                                <p>Belum ada data kehadiran</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
