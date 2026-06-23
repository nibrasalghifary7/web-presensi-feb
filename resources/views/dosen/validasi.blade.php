{{--
    Halaman Validasi Absensi Dosen
    Menampilkan daftar mahasiswa yang sudah klik absen.
    Dosen bisa memvalidasi atau mengubah status kehadiran.
--}}
@extends('layouts.app')

@section('title', 'Validasi Absensi')
@section('page-title', 'Validasi Absensi')

@section('content')
<div class="space-y-6">

    {{-- Info Jadwal --}}
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold text-gray-800">{{ $jadwal->mataKuliah->nama_mk }}</h3>
                <p class="text-sm text-gray-500">
                    {{ $jadwal->kelas }} &middot; {{ $jadwal->jam_formatted }} &middot; {{ $jadwal->ruang }}
                </p>
            </div>
            <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                <i class="fas fa-calendar mr-1"></i> {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    {{-- Tabel Mahasiswa --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Daftar Kehadiran Mahasiswa</h3>
        </div>

        @if($absensis->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-users-slash text-4xl mb-3"></i>
                <p>Belum ada mahasiswa yang melakukan absensi</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam Masuk</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Validasi</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($absensis as $index => $absen)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $absen->nim }}</td>
                                <td class="px-5 py-3 text-sm text-gray-800">{{ $absen->mahasiswa->nama }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600">{{ $absen->jam_masuk ? substr($absen->jam_masuk, 0, 5) : '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $absen->status_badge_class }}">
                                        {{ $absen->status }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    @if($absen->validasi === 'divalidasi')
                                        <span class="text-emerald-600 text-xs font-semibold"><i class="fas fa-check-circle mr-1"></i>Divalidasi</span>
                                    @elseif($absen->validasi === 'ditolak')
                                        <span class="text-red-600 text-xs font-semibold"><i class="fas fa-times-circle mr-1"></i>Ditolak</span>
                                    @else
                                        <span class="text-amber-600 text-xs font-semibold"><i class="fas fa-clock mr-1"></i>Pending</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <form action="{{ route('dosen.validasi.proses', $absen->id_absensi) }}" method="POST" class="flex gap-2">
                                        @csrf
                                        <select name="status" class="text-xs border rounded-lg px-2 py-1">
                                            <option value="Hadir" {{ $absen->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Izin" {{ $absen->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                                            <option value="Sakit" {{ $absen->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                            <option value="Alpha" {{ $absen->status == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                        </select>
                                        <input type="hidden" name="validasi" value="divalidasi">
                                        <button type="submit" class="px-3 py-1 bg-uin-green text-white rounded-lg text-xs font-medium hover:bg-uin-green-dark">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
