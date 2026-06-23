{{--
    Halaman Laporan / Cetak Kehadiran (Dosen)
    Tampilan cetak untuk laporan kehadiran per mata kuliah.
--}}
@extends('layouts.app')

@section('title', __('app.dosen.laporan_title'))
@section('page-title', __('app.dosen.laporan_title'))

@section('content')
<div class="space-y-6">
    <div class="bg-white glass rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Laporan Kehadiran</h2>
                <p class="text-sm text-gray-500 dark:text-slate-400">{{ $jadwal->mataKuliah->nama_mk }} - {{ $jadwal->kelas }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('dosen.laporan.pdf', $jadwal->id_jadwal) }}"
                   class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
                <a href="{{ route('dosen.laporan.excel', $jadwal->id_jadwal) }}"
                   class="px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition-colors">
                    <i class="fas fa-file-excel mr-1"></i> Excel
                </a>
                <button onclick="window.print()" class="px-4 py-2 bg-uin-green dark:bg-aurora-glow text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark dark:hover:bg-aurora-glow-secondary transition-colors">
                    <i class="fas fa-print mr-1"></i> Cetak
                </button>
            </div>
        </div>

        {{-- Header Laporan --}}
        <div class="text-center mb-6 pb-4 border-b border-gray-200 dark:border-white/10">
            <p class="font-bold text-gray-800 dark:text-white">FAKULTAS EKONOMI DAN BISNIS</p>
            <p class="font-bold text-gray-800 dark:text-white">UIN SYARIF HIDAYATULLAH JAKARTA</p>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-2">LAPORAN KEHADIRAN MAHASISWA</p>
            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $jadwal->mataKuliah->nama_mk }} ({{ $jadwal->mataKuliah->sks }} SKS)</p>
            <p class="text-sm text-gray-500 dark:text-slate-400">Dosen: {{ $jadwal->dosen->nama }}</p>
            <p class="text-sm text-gray-500 dark:text-slate-400">Kelas: {{ $jadwal->kelas }} &middot; Semester: {{ $jadwal->semester_aktif }}</p>
        </div>

        {{-- Tabel --}}
        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2 text-xs">No</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">NIM</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Nama</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Hadir</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Izin</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Sakit</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Alpha</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">%</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $nim => $absensis)
                    @php
                        $mhs = $absensis->first()->mahasiswa;
                        $h = $absensis->where('status', 'Hadir')->count();
                        $i = $absensis->where('status', 'Izin')->count();
                        $s = $absensis->where('status', 'Sakit')->count();
                        $a = $absensis->where('status', 'Alpha')->count();
                        $t = $absensis->count();
                        $p = $t > 0 ? round(($h / $t) * 100, 1) : 0;
                    @endphp
                    <tr>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm">{{ $nim }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm">{{ $mhs->nama ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center">{{ $h }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center">{{ $i }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center">{{ $s }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center">{{ $a }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center font-semibold">{{ $p }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="border border-gray-300 px-3 py-8 text-center text-gray-400">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <div class="mt-12 flex justify-end">
            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-slate-300">Tangerang Selatan, {{ now()->translatedFormat('d F Y') }}</p>
                <p class="text-sm text-gray-600 dark:text-slate-300 mt-1">Dosen Pengampu,</p>
                <div class="h-16"></div>
                <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $jadwal->dosen->nama }}</p>
                <p class="text-xs text-gray-500">NIDN: {{ $jadwal->dosen->nidn }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
