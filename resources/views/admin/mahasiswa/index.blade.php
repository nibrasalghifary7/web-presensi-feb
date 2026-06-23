{{--
    Halaman Kelola Data Mahasiswa (Admin)
    Tabel CRUD mahasiswa dengan pencarian dan filter.
--}}
@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')
@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="space-y-6">

    {{-- Header & Tombol Tambah --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Mahasiswa</h3>
            <p class="text-sm text-gray-500">Kelola data mahasiswa Program Studi Manajemen</p>
        </div>
        <a href="{{ route('admin.mahasiswa.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Mahasiswa
        </a>
    </div>

    {{-- Filter & Pencarian --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIM atau nama..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
            <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Kelas</option>
                <option value="Manajemen A" {{ request('kelas') == 'Manajemen A' ? 'selected' : '' }}>Manajemen A</option>
                <option value="Manajemen B" {{ request('kelas') == 'Manajemen B' ? 'selected' : '' }}>Manajemen B</option>
                <option value="Manajemen C" {{ request('kelas') == 'Manajemen C' ? 'selected' : '' }}>Manajemen C</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                <i class="fas fa-search mr-1"></i> Filter
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Angkatan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($mahasiswas as $mhs)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $mhs->nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800">{{ $mhs->nama }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $mhs->kelas }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $mhs->angkatan }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $mhs->email }}</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->nim) }}"
                                       class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->nim) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-users-slash text-3xl mb-2"></i>
                                <p>Belum ada data mahasiswa</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100">
            {{ $mahasiswas->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
