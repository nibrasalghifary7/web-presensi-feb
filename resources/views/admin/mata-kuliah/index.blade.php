{{--
    Halaman Kelola Mata Kuliah (Admin)
--}}
@extends('layouts.app')

@section('title', 'Kelola Mata Kuliah')
@section('page-title', 'Data Mata Kuliah')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Mata Kuliah</h3>
            <p class="text-sm text-gray-500 dark:text-slate-400">Kelola data mata kuliah Program Studi Manajemen</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Mata Kuliah
        </button>
    </div>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Kode</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama Mata Kuliah</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">SKS</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Semester</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($mataKuliahs as $mk)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $mk->kode_mk }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $mk->nama_mk }}</td>
                            <td class="px-5 py-3 text-sm text-center text-gray-600 dark:text-slate-300">{{ $mk->sks }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $mk->semester }}</td>
                            <td class="px-5 py-3">
                                <form action="{{ route('admin.mata-kuliah.destroy', $mk->id_mk) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-gray-400">Belum ada data mata kuliah</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-slate-700">{{ $mataKuliahs->links() }}</div>
    </div>

    {{-- Modal Tambah --}}
    <div id="modalTambah" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Tambah Mata Kuliah</h3>
            <form method="POST" action="{{ route('admin.mata-kuliah.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Kode MK</label>
                    <input type="text" name="kode_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">SKS</label>
                        <input type="number" name="sks" min="1" max="6" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Semester</label>
                        <select name="semester" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
