


<?php $__env->startSection('title', 'Kelola Mata Kuliah'); ?>
<?php $__env->startSection('page-title', 'Data Mata Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Mata Kuliah</h3>
            <p class="text-sm text-gray-500">Kelola data mata kuliah Program Studi Manajemen</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Mata Kuliah
        </button>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Mata Kuliah</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">SKS</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Semester</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $mataKuliahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800"><?php echo e($mk->kode_mk); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-800"><?php echo e($mk->nama_mk); ?></td>
                            <td class="px-5 py-3 text-sm text-center text-gray-600"><?php echo e($mk->sks); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($mk->semester); ?></td>
                            <td class="px-5 py-3">
                                <form action="<?php echo e(route('admin.mata-kuliah.destroy', $mk->id_mk)); ?>" method="POST"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="px-5 py-12 text-center text-gray-400">Belum ada data mata kuliah</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100"><?php echo e($mataKuliahs->links()); ?></div>
    </div>

    
    <div id="modalTambah" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Mata Kuliah</h3>
            <form method="POST" action="<?php echo e(route('admin.mata-kuliah.store')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kode MK</label>
                    <input type="text" name="kode_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">SKS</label>
                        <input type="number" name="sks" min="1" max="6" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                        <select name="semester" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\admin\mata-kuliah\index.blade.php ENDPATH**/ ?>