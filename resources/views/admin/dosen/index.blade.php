{{--
    Halaman Kelola Data Dosen (Admin)
--}}
@extends('layouts.app')

@section('title', __('app.admin.dosen_title'))
@section('page-title', __('app.admin.dosen_title'))

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ __('app.admin.dosen_list') }}</h3>
            <p class="text-sm text-gray-500 dark:text-slate-400">{{ __('app.admin.dosen_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.dosen.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> {{ __('app.admin.dosen_add') }}
        </a>
    </div>

    {{-- Pencarian --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIDN atau nama..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none dark:bg-slate-700 dark:text-white dark:placeholder-slate-400">
            <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-lg text-sm hover:bg-gray-200 dark:hover:bg-slate-600">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">NIDN</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Bidang Keahlian</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Email</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-700">
                    @forelse($dosens as $dosen)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $dosen->nidn }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $dosen->nama }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $dosen->bidang_keahlian }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $dosen->email }}</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.dosen.edit', $dosen->nidn) }}"
                                       class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.dosen.destroy', $dosen->nidn) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-gray-400 dark:text-slate-500">Belum ada data dosen</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-slate-700">{{ $dosens->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
