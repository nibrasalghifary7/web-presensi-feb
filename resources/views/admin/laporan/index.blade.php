{{--
    Halaman Laporan Absensi (Admin)
    Preview laporan dengan filter dan tombol export PDF.
--}}
@extends('layouts.app')

@section('title', __('app.admin.laporan_title'))
@section('page-title', __('app.admin.laporan_title'))

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Laporan Absensi</h3>
            <p class="text-sm text-gray-500">Rekapitulasi kehadiran mahasiswa</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition-colors">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.laporan.excel', request()->query()) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition-colors">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Kelas</option>
                @foreach($kelasList as $k)
                    <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
            <select name="id_mk" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Mata Kuliah</option>
                @foreach($mataKuliahs as $mk)
                    <option value="{{ $mk->id_mk }}" {{ request('id_mk') == $mk->id_mk ? 'selected' : '' }}>{{ $mk->nama_mk }}</option>
                @endforeach
            </select>
            <select name="nidn" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Dosen</option>
                @foreach($dosens as $d)
                    <option value="{{ $d->nidn }}" {{ request('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                @endforeach
            </select>
            <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" placeholder="Tanggal Mulai"
                   class="px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green outline-none">
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" placeholder="Tanggal Akhir"
                   class="px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green outline-none">
            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 bg-gray-50 text-gray-500 rounded-lg text-sm hover:bg-gray-100">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-2xl font-bold text-gray-800">{{ $totalSemua }}</p>
            <p class="text-xs text-gray-500">Total Data</p>
        </div>
        <div class="bg-emerald-50 rounded-xl p-4 shadow-sm border border-emerald-200 text-center">
            <p class="text-2xl font-bold text-emerald-600">{{ $totalHadir }}</p>
            <p class="text-xs text-emerald-700">Hadir</p>
        </div>
        <div class="bg-amber-50 rounded-xl p-4 shadow-sm border border-amber-200 text-center">
            <p class="text-2xl font-bold text-amber-600">{{ $totalIzin }}</p>
            <p class="text-xs text-amber-700">Izin</p>
        </div>
        <div class="bg-yellow-50 rounded-xl p-4 shadow-sm border border-yellow-200 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $totalSakit }}</p>
            <p class="text-xs text-yellow-700">Sakit</p>
        </div>
        <div class="bg-red-50 rounded-xl p-4 shadow-sm border border-red-200 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $totalAlpha }}</p>
            <p class="text-xs text-red-700">Alpha</p>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Dosen</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($absensis as $index => $a)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm text-gray-500">{{ $absensis->firstItem() + $index }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $a->nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800">{{ $a->mahasiswa->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $a->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $a->jadwal->kelas ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $a->jadwal->dosen->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $a->tanggal->translatedFormat('d M Y') }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $a->status_badge_class }}">
                                    {{ $a->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-chart-bar text-3xl mb-2"></i>
                                <p>Tidak ada data absensi sesuai filter</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100">{{ $absensis->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
