{{--
    Halaman Monitoring Presensi Dosen (Admin)
    Menampilkan daftar jadwal dengan statistik kehadiran hari ini.
--}}
@extends('layouts.app')

@section('title', 'Monitoring Presensi')
@section('page-title', 'Monitoring Presensi Dosen')

@section('content')
<div class="space-y-6">

    {{-- Filter --}}
    <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="hari" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm dark:border-slate-600 dark:bg-slate-700 dark:text-white outline-none">
                <option value="">Semua Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
            </select>
            <input type="text" name="kelas" placeholder="Filter Kelas..." value="{{ request('kelas') }}"
                   class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 outline-none">
            <button type="submit" class="px-5 py-2.5 bg-uin-green dark:bg-aurora-glow text-white rounded-xl text-sm font-medium hover:bg-uin-green-dark dark:hover:bg-aurora-glow-secondary transition-colors">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    {{-- Tabel Jadwal --}}
    <div class="bg-white glass rounded-xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Hari</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Jam</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Dosen</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Kelas</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Hadir Hari Ini</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Pending</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                    @forelse($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $jadwal->hari }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $jadwal->jam_formatted }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $jadwal->dosen->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $jadwal->kelas }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                    {{ $jadwal->total_hadir_hari_ini }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                @if($jadwal->total_pending_hari_ini > 0)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                                        {{ $jadwal->total_pending_hari_ini }}
                                    </span>
                                @else
                                    <span class="text-gray-400 dark:text-slate-500 text-xs">0</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex gap-1.5">
                                    <a href="{{ route('admin.presensi.validasi', $jadwal->id_jadwal) }}"
                                       class="px-3 py-1.5 bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 rounded-lg text-xs font-medium hover:bg-blue-200 dark:hover:bg-blue-500/20 transition-colors"
                                       title="Validasi">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.presensi.rekap', $jadwal->id_jadwal) }}"
                                       class="px-3 py-1.5 bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 rounded-lg text-xs font-medium hover:bg-purple-200 dark:hover:bg-purple-500/20 transition-colors"
                                       title="Rekap">
                                        <i class="fas fa-chart-bar"></i>
                                    </a>
                                    <a href="{{ route('admin.presensi.laporan', $jadwal->id_jadwal) }}"
                                       class="px-3 py-1.5 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-lg text-xs font-medium hover:bg-emerald-200 dark:hover:bg-emerald-500/20 transition-colors"
                                       title="Laporan">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-400 dark:text-slate-500">
                                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                                <p>Tidak ada jadwal ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($jadwals->hasPages())
            <div class="px-5 py-3 border-t border-gray-100 dark:border-white/5">
                {{ $jadwals->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
