


<?php $__env->startSection('title', __('app.admin.kelas_title')); ?>
<?php $__env->startSection('page-title', __('app.admin.kelas_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Kelas</h3>
            <p class="text-sm text-gray-500">Kelola data kelas/rombongan belajar</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Kelas
        </button>
    </div>

    
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama kelas..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Kelas</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Angkatan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Prodi</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah Mhs</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm text-gray-500"><?php echo e($kelas->firstItem() + $index); ?></td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800"><?php echo e($k->nama_kelas); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($k->angkatan); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($k->prodi); ?></td>
                            <td class="px-5 py-3 text-sm text-center text-gray-600"><?php echo e($k->mahasiswas_count); ?></td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <button onclick="editKelas(<?php echo e($k->id_kelas); ?>, '<?php echo e($k->nama_kelas); ?>', '<?php echo e($k->angkatan); ?>')"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?php echo e(route('admin.kelas.destroy', $k->id_kelas)); ?>" method="POST"
                                          onsubmit="return confirm('Yakin hapus kelas ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-users-slash text-3xl mb-2"></i>
                                <p>Belum ada data kelas</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100"><?php echo e($kelas->withQueryString()->links()); ?></div>
    </div>

    
    <div id="modalTambah" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Kelas</h3>
            <form method="POST" action="<?php echo e(route('admin.kelas.store')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kelas</label>
                    <input type="text" name="nama_kelas" required placeholder="Contoh: Manajemen A"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Angkatan</label>
                    <select name="angkatan" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="modalEdit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Kelas</h3>
            <form id="formEdit" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kelas</label>
                    <input type="text" id="edit_nama" name="nama_kelas" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Angkatan</label>
                    <select id="edit_angkatan" name="angkatan" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Update</button>
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function editKelas(id, nama, angkatan) {
        document.getElementById('formEdit').action = '/admin/kelas/' + id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_angkatan').value = angkatan;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/admin/kelas/index.blade.php ENDPATH**/ ?>