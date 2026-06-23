{{--
    Halaman Manajemen Jadwal Kuliah (Admin)
--}}
@extends('layouts.app')

@section('title', __('app.admin.jadwal_title'))
@section('page-title', __('app.admin.jadwal_title'))

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Jadwal Kuliah</h3>
            <p class="text-sm text-gray-500">Kelola jadwal perkuliahan</p>
        </div>
        <button onclick="document.getElementById('modalJadwal').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </button>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="hari" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
            </select>
            <select name="kelas" class="flex-1 px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green outline-none">
                <option value="">Semua Kelas</option>
                @foreach($kelasList as $k)
                    <option value="{{ $k->nama_kelas }}" {{ request('kelas') == $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Dosen</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Hari</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Ruang</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($jadwals as $j)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $j->mataKuliah->nama_mk }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $j->dosen->nama }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $j->hari }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $j->jam_formatted }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $j->ruang }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600">{{ $j->kelas }}</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <button onclick="editJadwal({{ $j->id_jadwal }}, {{ $j->id_mk }}, '{{ $j->nidn }}', '{{ $j->hari }}', '{{ $j->jam_mulai instanceof \Carbon\Carbon ? $j->jam_mulai->format('H:i') : $j->jam_mulai }}', '{{ $j->jam_selesai instanceof \Carbon\Carbon ? $j->jam_selesai->format('H:i') : $j->jam_selesai }}', '{{ $j->ruang }}', '{{ $j->kelas }}', '{{ $j->semester_aktif }}')"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.jadwal.destroy', $j->id_jadwal) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-12 text-center text-gray-400">Belum ada jadwal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100">{{ $jadwals->withQueryString()->links() }}</div>
    </div>

    {{-- Modal Tambah Jadwal --}}
    <div id="modalJadwal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Jadwal Kuliah</h3>
            <form method="POST" action="{{ route('admin.jadwal.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mata Kuliah</label>
                        <select name="id_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            @foreach($mataKuliahs as $mk)
                                <option value="{{ $mk->id_mk }}">{{ $mk->nama_mk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dosen</label>
                        <select name="nidn" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            @foreach($dosens as $d)
                                <option value="{{ $d->nidn }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                        <select name="hari" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                        <select name="kelas" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $k)
                                <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                        <input type="text" name="ruang" placeholder="Teater FEB Lt.2"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                        <input type="text" name="semester_aktif" required placeholder="2024/2025 Ganjil"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalJadwal').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Jadwal --}}
    <div id="modalEditJadwal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Jadwal Kuliah</h3>
            <form id="formEditJadwal" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mata Kuliah</label>
                        <select name="id_mk" id="edit_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            @foreach($mataKuliahs as $mk)
                                <option value="{{ $mk->id_mk }}">{{ $mk->nama_mk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dosen</label>
                        <select name="nidn" id="edit_nidn" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            @foreach($dosens as $d)
                                <option value="{{ $d->nidn }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                        <select name="hari" id="edit_hari" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                        <select name="kelas" id="edit_kelas" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $k)
                                <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="edit_jam_mulai" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="edit_jam_selesai" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                        <input type="text" name="ruang" id="edit_ruang"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                        <input type="text" name="semester_aktif" id="edit_semester" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Update</button>
                    <button type="button" onclick="document.getElementById('modalEditJadwal').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function editJadwal(id, id_mk, nidn, hari, jam_mulai, jam_selesai, ruang, kelas, semester) {
        document.getElementById('formEditJadwal').action = '/admin/jadwal/' + id;
        document.getElementById('edit_mk').value = id_mk;
        document.getElementById('edit_nidn').value = nidn;
        document.getElementById('edit_hari').value = hari;
        document.getElementById('edit_jam_mulai').value = jam_mulai;
        document.getElementById('edit_jam_selesai').value = jam_selesai;
        document.getElementById('edit_ruang').value = ruang;
        document.getElementById('edit_kelas').value = kelas;
        document.getElementById('edit_semester').value = semester;
        document.getElementById('modalEditJadwal').classList.remove('hidden');
    }
</script>
@endpush
@endsection
