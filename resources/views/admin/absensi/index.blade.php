{{--
    Halaman Kelola Data Absensi (Admin)
    Menampilkan semua data absensi dengan filter dan koreksi manual.
--}}
@extends('layouts.app')

@section('title', __('app.admin.absensi_title'))
@section('page-title', __('app.admin.absensi_title'))

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Data Absensi</h3>
        <p class="text-sm text-gray-500 dark:text-slate-400">Pantau dan koreksi data kehadiran mahasiswa</p>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIM atau nama..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green outline-none dark:bg-slate-700 dark:text-white">
            <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm outline-none">
                <option value="">Semua Kelas</option>
                @foreach($kelasList as $k)
                    <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
            <select name="id_mk" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm outline-none">
                <option value="">Semua Mata Kuliah</option>
                @foreach($mataKuliahs as $mk)
                    <option value="{{ $mk->id_mk }}" {{ request('id_mk') == $mk->id_mk ? 'selected' : '' }}>{{ $mk->nama_mk }}</option>
                @endforeach
            </select>
            <select name="status" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm outline-none">
                <option value="">Semua Status</option>
                <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                <option value="Sakit" {{ request('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="Alpha" {{ request('status') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                   class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green outline-none dark:bg-slate-700 dark:text-white">
            <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-lg text-sm hover:bg-gray-200 dark:hover:bg-slate-600">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Kelas</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Tanggal</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Jam Masuk</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Validasi</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($absensis as $index => $a)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                            <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400">{{ $absensis->firstItem() + $index }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $a->nim }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $a->mahasiswa->nama ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $a->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $a->jadwal->kelas ?? '-' }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $a->tanggal->translatedFormat('d M Y') }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $a->jam_masuk ? substr($a->jam_masuk, 0, 5) : '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $a->status_badge_class }}">
                                    {{ $a->status }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                @if($a->validasi === 'divalidasi')
                                    <span class="text-emerald-600 text-xs font-semibold"><i class="fas fa-check-circle mr-1"></i>Divalidasi</span>
                                @elseif($a->validasi === 'ditolak')
                                    <span class="text-red-600 text-xs font-semibold"><i class="fas fa-times-circle mr-1"></i>Ditolak</span>
                                @else
                                    <span class="text-amber-600 text-xs font-semibold"><i class="fas fa-clock mr-1"></i>Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <button onclick="editAbsensi({{ $a->id_absensi }}, '{{ $a->status }}', '{{ $a->catatan ?? '' }}')"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.absensi.destroy', $a->id_absensi) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus data absensi ini?')">
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
                            <td colspan="10" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-calendar-check text-3xl mb-2"></i>
                                <p>Belum ada data absensi</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-slate-700">{{ $absensis->withQueryString()->links() }}</div>
    </div>

    {{-- Modal Edit Absensi --}}
    <div id="modalEdit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Koreksi Absensi</h3>
            <form id="formEdit" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Status Kehadiran</label>
                    <select id="edit_status" name="status" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green outline-none dark:bg-slate-700 dark:text-white">
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Catatan</label>
                    <textarea id="edit_catatan" name="catatan" rows="3"
                              placeholder="Catatan koreksi (opsional)"
                              class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green outline-none resize-none dark:bg-slate-700 dark:text-white"></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function editAbsensi(id, status, catatan) {
        document.getElementById('formEdit').action = '/admin/absensi/' + id;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_catatan').value = catatan;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endpush
@endsection
