{{--
    Kelola Data Mahasiswa (Admin) - Dual Theme
--}}
@extends('layouts.app')

@section('title', __('app.admin.mahasiswa_title'))
@section('page-title', __('app.admin.mahasiswa_title'))

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ __('app.admin.mahasiswa_list') }}</h3>
            <p class="text-sm text-gray-500 dark:text-slate-400">{{ __('app.admin.mahasiswa_subtitle') }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.mahasiswa.import.form') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl font-medium hover:bg-blue-600 transition-colors dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary">
                <i class="fas fa-file-import"></i> {{ __('app.import_csv') }}
            </a>
            <a href="{{ route('admin.mahasiswa.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-dark transition-colors dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary">
                <i class="fas fa-plus"></i> {{ __('app.add') }}
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 glass">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('app.placeholder.search_nim_nama') }}"
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 text-sm text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none">
            <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-200 text-sm text-gray-800 dark:border-white/10 dark:bg-white/5 dark:text-white">
                <option value="">{{ __('app.placeholder.all_classes') }}</option>
                <option value="Manajemen A" {{ request('kelas')=='Manajemen A'?'selected':'' }}>Manajemen A</option>
                <option value="Manajemen B" {{ request('kelas')=='Manajemen B'?'selected':'' }}>Manajemen B</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 dark:bg-white/10 dark:text-white dark:hover:bg-white/15">
                <i class="fas fa-search mr-1"></i> {{ __('app.filter') }}
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 glass overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.nim') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.nama') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.kelas') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.angkatan') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.email') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">{{ __('app.table.aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                    @forelse($mahasiswas as $mhs)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $mhs->nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $mhs->nama }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $mhs->kelas }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $mhs->angkatan }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $mhs->email }}</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->nim) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:hover:bg-blue-500/20">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->nim) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center text-gray-400 dark:text-slate-500"><i class="fas fa-users-slash text-3xl mb-2"></i><p>{{ __('app.message.delete_success') }}</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-white/5">{{ $mahasiswas->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
