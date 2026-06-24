{{--
    Halaman Kelola Akun Pengguna (Admin)
    Tabel CRUD akun dengan filter role dan reset password.
--}}
@extends('layouts.app')

@section('title', __('app.admin.users_title'))
@section('page-title', __('app.admin.users_title'))

@section('content')
<div class="space-y-6">

    {{-- Header & Tombol Tambah --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Akun Pengguna</h3>
            <p class="text-sm text-gray-500 dark:text-slate-400">Kelola akun login semua pengguna sistem</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Akun
        </button>
    </div>

    {{-- Filter & Pencarian --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari username, nama, atau email..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
            <select name="role" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm outline-none">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ request('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
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
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Username</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Email</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Role</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Terdaftar</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $index => $u)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                            <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400">{{ $users->firstItem() + $index }}</td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white">{{ $u->username }}</td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white">{{ $u->name }}</td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $u->email ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @if($u->role === 'admin')
                                    <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Admin</span>
                                @elseif($u->role === 'dosen')
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Dosen</span>
                                @else
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Mahasiswa</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300">{{ $u->created_at ? $u->created_at->translatedFormat('d M Y') : '-' }}</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <button onclick="editUser({{ $u->id }}, '{{ $u->name }}', '{{ $u->email ?? '' }}', '{{ $u->phone ?? '' }}', '{{ $u->role }}')"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.users.reset-password', $u->id) }}" method="POST"
                                          onsubmit="return confirm('Reset password user ini ke default (password123)?')">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-medium hover:bg-amber-200">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </form>
                                    @if($u->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus akun ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-users-slash text-3xl mb-2"></i>
                                <p>Belum ada akun pengguna</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-slate-700">{{ $users->withQueryString()->links() }}</div>
    </div>

    {{-- Modal Tambah --}}
    <div id="modalTambah" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Tambah Akun</h3>
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Username</label>
                    <input type="text" name="username" required placeholder="NIM/NIP/Username"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Email</label>
                    <input type="email" name="email"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Role</label>
                    <select name="role" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Password</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600">Batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="modalEdit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Edit Akun</h3>
            <form id="formEdit" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Nama Lengkap</label>
                    <input type="text" id="edit_name" name="name" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Email</label>
                    <input type="email" id="edit_email" name="email"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">No. HP</label>
                    <input type="text" id="edit_phone" name="phone"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Role</label>
                    <select id="edit_role" name="role" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Update</button>
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function editUser(id, name, email, phone, role) {
        document.getElementById('formEdit').action = '/admin/users/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_role').value = role;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endpush
@endsection
