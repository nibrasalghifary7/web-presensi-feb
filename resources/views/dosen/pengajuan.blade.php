{{--
    Halaman Daftar Pengajuan Izin/Sakit (Dosen)
    Menampilkan pengajuan izin/sakit dari mahasiswa di kelas yang diajar.
    Dosen bisa approve/reject pengajuan.
--}}
@extends('layouts.app')

@section('title', __('app.dosen.pengajuan_title'))
@section('page-title', __('app.dosen.pengajuan_title'))

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Pengajuan Izin / Sakit</h3>
        <p class="text-sm text-gray-500 dark:text-slate-400">Pengajuan izin dan sakit dari mahasiswa di kelas yang Anda ajar</p>
    </div>

    {{-- Reminder Pending --}}
    @php
        $pendingCount = $pengajuans->where('status', 'pending')->count();
    @endphp
    @if($pendingCount > 0)
        <div class="bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 rounded-xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-bell text-amber-600 dark:text-amber-400"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">{{ $pendingCount }} pengajuan menunggu persetujuan Anda</p>
                <p class="text-xs text-amber-600 dark:text-amber-400">Segera review pengajuan izin/sakit dari mahasiswa</p>
            </div>
        </div>
    @endif

    {{-- Filter --}}
    <div class="bg-white glass rounded-xl p-4 shadow-sm border border-gray-100 dark:border-white/5">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="status" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-white/10 dark:bg-gray-800 dark:text-white text-sm">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-white/10 dark:bg-gray-800 dark:text-white text-sm">
                <option value="">Semua Kelas</option>
                @foreach($kelasDosen as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-slate-300 rounded-lg text-sm hover:bg-gray-200 dark:hover:bg-white/15">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white glass rounded-xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Tanggal</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Jenis</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Alasan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Bukti</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                    @forelse($pengajuans as $index => $p)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 {{ $p->status == 'pending' ? 'bg-amber-50/30 dark:bg-amber-500/5' : '' }}">
                            <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400">{{ $pengajuans->firstItem() + $index }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $p->nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $p->mahasiswa->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $p->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $p->tanggal_izin->translatedFormat('d M Y') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $p->jenis == 'Sakit' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400' }}">
                                    {{ $p->jenis }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300 max-w-xs truncate">{{ $p->alasan }}</td>
                            <td class="px-5 py-3">
                                @if($p->bukti_surat)
                                    <a href="{{ str_starts_with($p->bukti_surat, 'http') ? $p->bukti_surat : asset('storage/' . $p->bukti_surat) }}" target="_blank"
                                       class="text-blue-600 dark:text-blue-400 hover:underline text-xs">
                                        <i class="fas fa-file-image mr-1"></i>Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 dark:text-slate-500 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if($p->status == 'disetujui')
                                    <span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check mr-1"></i>Disetujui
                                    </span>
                                @elseif($p->status == 'ditolak')
                                    <span class="px-2 py-0.5 bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if($p->status == 'pending')
                                    <div class="flex gap-2">
                                        {{-- Approve --}}
                                        <form action="{{ route('dosen.pengajuan.approve', $p->id_pengajuan) }}" method="POST"
                                              onsubmit="return confirm('Setujui pengajuan {{ $p->jenis }} dari {{ $p->mahasiswa->nama ?? $p->nim }}?')">
                                            @csrf
                                            <button type="submit"
                                                    class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg text-xs font-medium hover:bg-emerald-600 transition-colors"
                                                    title="Setujui">
                                                <i class="fas fa-check mr-1"></i> Setujui
                                            </button>
                                        </form>
                                        {{-- Reject --}}
                                        <form action="{{ route('dosen.pengajuan.reject', $p->id_pengajuan) }}" method="POST"
                                              onsubmit="return confirm('Tolak pengajuan {{ $p->jenis }} dari {{ $p->mahasiswa->nama ?? $p->nim }}?')">
                                            @csrf
                                            <input type="hidden" name="catatan" value="">
                                            <button type="submit"
                                                    class="px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-medium hover:bg-red-600 transition-colors"
                                                    title="Tolak">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 dark:text-slate-500 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-5 py-12 text-center text-gray-400 dark:text-slate-500">
                                <i class="fas fa-file-circle-exclamation text-3xl mb-2"></i>
                                <p>Belum ada pengajuan izin/sakit dari mahasiswa</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-white/5">
            {{ $pengajuans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
