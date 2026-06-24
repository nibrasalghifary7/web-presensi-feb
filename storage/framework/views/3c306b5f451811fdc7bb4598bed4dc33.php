


<?php $__env->startSection('title', __('app.admin.users_title')); ?>
<?php $__env->startSection('page-title', __('app.admin.users_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
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

    
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari username, nama, atau email..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 text-sm focus:border-uin-green dark:bg-slate-700 dark:text-white outline-none">
            <select name="role" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm outline-none">
                <option value="">Semua Role</option>
                <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="dosen" <?php echo e(request('role') == 'dosen' ? 'selected' : ''); ?>>Dosen</option>
                <option value="mahasiswa" <?php echo e(request('role') == 'mahasiswa' ? 'selected' : ''); ?>>Mahasiswa</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-lg text-sm hover:bg-gray-200 dark:hover:bg-slate-600">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    
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
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                            <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400"><?php echo e($users->firstItem() + $index); ?></td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white"><?php echo e($u->username); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white"><?php echo e($u->name); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300"><?php echo e($u->email ?? '-'); ?></td>
                            <td class="px-5 py-3">
                                <?php if($u->role === 'admin'): ?>
                                    <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Admin</span>
                                <?php elseif($u->role === 'dosen'): ?>
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Dosen</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Mahasiswa</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300"><?php echo e($u->created_at ? $u->created_at->translatedFormat('d M Y') : '-'); ?></td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <button onclick="editUser(<?php echo e($u->id); ?>, '<?php echo e($u->name); ?>', '<?php echo e($u->email ?? ''); ?>', '<?php echo e($u->phone ?? ''); ?>', '<?php echo e($u->role); ?>')"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?php echo e(route('admin.users.reset-password', $u->id)); ?>" method="POST"
                                          onsubmit="return confirm('Reset password user ini ke default (password123)?')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit"
                                                class="px-3 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-medium hover:bg-amber-200">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </form>
                                    <?php if($u->id !== auth()->id()): ?>
                                        <form action="<?php echo e(route('admin.users.destroy', $u->id)); ?>" method="POST"
                                              onsubmit="return confirm('Yakin hapus akun ini?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-users-slash text-3xl mb-2"></i>
                                <p>Belum ada akun pengguna</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-slate-700"><?php echo e($users->withQueryString()->links()); ?></div>
    </div>

    
    <div id="modalTambah" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Tambah Akun</h3>
            <form method="POST" action="<?php echo e(route('admin.users.store')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
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

    
    <div id="modalEdit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Edit Akun</h3>
            <form id="formEdit" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/admin/users/index.blade.php ENDPATH**/ ?>