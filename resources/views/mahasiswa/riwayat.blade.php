{{--
    Riwayat Kehadiran Mahasiswa - Dual Theme
--}}
@extends('layouts.app')

@section('title', __('app.mahasiswa.riwayat_title'))
@section('page-title', __('app.mahasiswa.riwayat_title'))

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center dark:bg-emerald-500/10 dark:border-emerald-500/20">
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $totalHadir }}</p>
            <p class="text-xs text-emerald-700 dark:text-emerald-400">{{ __('app.mahasiswa.hadir') }}</p>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center dark:bg-amber-500/10 dark:border-amber-500/20">
            <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $totalIzinSakit }}</p>
            <p class="text-xs text-amber-700 dark:text-amber-400">{{ __('app.mahasiswa.izin_sakit') }}</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center dark:bg-red-500/10 dark:border-red-500/20">
            <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $totalAlpha }}</p>
            <p class="text-xs text-red-700 dark:text-red-400">{{ __('app.mahasiswa.alpha') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 glass overflow-hidden">
        <div class="p-5 border-b border-gray-100 dark:border-white/5">
            <h3 class="font-bold text-gray-800 dark:text-white"><i class="fas fa-clock-rotate-left text-primary dark:text-aurora-glow mr-2"></i>{{ __('app.mahasiswa.riwayat_subtitle') }}</h3>
        </div>
        @if($riwayat->isEmpty())
            <div class="text-center py-12 text-gray-400 dark:text-slate-500">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p>{{ __('app.message.absensi_success') }}</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.no') }}</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.mata_kuliah') }}</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.tanggal') }}</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.jam_masuk') }}</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @foreach($riwayat as $index => $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                                <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400">{{ $riwayat->firstItem() + $index }}</td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $item->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $item->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $item->jam_masuk ? substr($item->jam_masuk, 0, 5) : '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $item->status_badge_class }}">{{ $item->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-gray-100 dark:border-white/5">{{ $riwayat->links() }}</div>
        @endif
    </div>
</div>
@endsection
