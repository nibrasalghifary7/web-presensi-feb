{{--
    Riwayat Kehadiran Mahasiswa
    Tabel berisi: No, Mata Kuliah, Tanggal, Jam Masuk, Keterangan, Badge Status.
    Warna badge: Hijau=Hadir, Kuning=Izin/Sakit, Merah=Alpha.
--}}
@extends('layouts.app')

@section('title', 'Riwayat Kehadiran')
@section('page-title', 'Riwayat Kehadiran')

@section('content')
<div class="space-y-6">

    {{-- Statistik Ringkas --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-emerald-600">{{ $totalHadir }}</p>
            <p class="text-xs text-emerald-700">Hadir</p>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-amber-600">{{ $totalIzinSakit }}</p>
            <p class="text-xs text-amber-700">Izin/Sakit</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $totalAlpha }}</p>
            <p class="text-xs text-red-700">Alpha</p>
        </div>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">
                <i class="fas fa-clock-rotate-left text-uin-green mr-2"></i>Data Kehadiran
            </h3>
        </div>

        @if($riwayat->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p>Belum ada riwayat kehadiran</p>
            </div>
        @else
            {{-- Tabel untuk Desktop --}}
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam Masuk</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Keterangan</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($riwayat as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm text-gray-500">{{ $riwayat->firstItem() + $index }}</td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-800">
                                    {{ $item->jadwal->mataKuliah->nama_mk ?? '-' }}
                                </td>
                                <td class="px-5 py-3 text-sm text-gray-600">{{ $item->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600">{{ $item->jam_masuk ? substr($item->jam_masuk, 0, 5) : '-' }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600">{{ $item->catatan ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $item->status_badge_class }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Card untuk Mobile --}}
            <div class="sm:hidden divide-y divide-gray-100">
                @foreach($riwayat as $index => $item)
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-gray-800">{{ $item->jadwal->mataKuliah->nama_mk ?? '-' }}</span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold
                                {{ $item->status_badge_class }}">
                                {{ $item->status }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500">
                            <i class="far fa-calendar mr-1"></i> {{ $item->tanggal->translatedFormat('d M Y') }}
                            @if($item->jam_masuk)
                                &middot; <i class="far fa-clock mr-1"></i> {{ substr($item->jam_masuk, 0, 5) }}
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $riwayat->links() }}
            </div>
        @endif
    </div>

    {{-- Rekap Total --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center justify-between">
        <span class="text-sm font-semibold text-blue-800">
            <i class="fas fa-chart-simple mr-2"></i>REKAP TOTAL KEHADIRAN
        </span>
        <span class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-sm font-semibold">
            {{ $totalHadir }} dari {{ $totalPertemuan }} Pertemuan
        </span>
    </div>
</div>
@endsection
