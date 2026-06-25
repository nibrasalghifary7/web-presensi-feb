{{--
    Halaman Riwayat Pengajuan Izin/Sakit Mahasiswa
    Menampilkan daftar pengajuan yang pernah dikirim.
--}}
@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')
@section('page-title', 'Riwayat Pengajuan')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Riwayat Pengajuan Izin / Sakit</h3>
        <p class="text-sm text-gray-500 dark:text-slate-400">Daftar pengajuan izin dan sakit yang pernah Anda kirim</p>
    </div>

    {{-- Daftar Pengajuan --}}
    @if($riwayatPengajuan->isEmpty())
        <div class="bg-white glass rounded-xl p-12 shadow-sm border border-gray-100 dark:border-white/5 text-center">
            <i class="fas fa-file-circle-check text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-600 dark:text-white">Belum ada pengajuan</h3>
            <p class="text-sm text-gray-400 dark:text-slate-500 mt-1">Pengajuan izin/sakit yang Anda kirim akan muncul di sini</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($riwayatPengajuan as $izin)
                <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $izin->jenis == 'Sakit' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400' }}">
                                    {{ $izin->jenis }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-slate-400">
                                    <i class="far fa-calendar mr-1"></i>{{ $izin->tanggal_izin->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                {{ $izin->jadwal->mataKuliah->nama_mk ?? '-' }}
                                <span class="text-xs font-normal text-gray-500 dark:text-slate-400">({{ $izin->jadwal->kelas ?? '-' }})</span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-slate-300 mt-1">{{ $izin->alasan }}</p>
                            @if($izin->bukti_surat)
                                <a href="{{ str_starts_with($izin->bukti_surat, 'http') ? $izin->bukti_surat : asset('storage/' . $izin->bukti_surat) }}" target="_blank"
                                   class="inline-flex items-center gap-1 mt-2 text-xs text-blue-600 dark:text-blue-400 hover:underline">
                                    <i class="fas fa-file-alt"></i> Lihat Bukti
                                </a>
                            @endif
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0
                            {{ $izin->status == 'disetujui' ? 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400' : ($izin->status == 'ditolak' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400') }}">
                            @if($izin->status == 'disetujui')
                                <i class="fas fa-check mr-1"></i>Disetujui
                            @elseif($izin->status == 'ditolak')
                                <i class="fas fa-times mr-1"></i>Ditolak
                            @else
                                <i class="fas fa-clock mr-1"></i>Pending
                            @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $riwayatPengajuan->links() }}
        </div>
    @endif
</div>
@endsection
