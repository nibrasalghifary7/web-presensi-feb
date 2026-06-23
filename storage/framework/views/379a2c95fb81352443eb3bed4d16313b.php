


<?php $__env->startSection('title', 'Tambah Dosen'); ?>
<?php $__env->startSection('page-title', 'Tambah Dosen'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-5">
            <i class="fas fa-chalkboard-teacher text-uin-green mr-2"></i>Form Tambah Dosen
        </h3>

        <form method="POST" action="<?php echo e(route('admin.dosen.store')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">NIDN</label>
                    <input type="text" name="nidn" value="<?php echo e(old('nidn')); ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                    <?php $__errorArgs = ['nidn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No. HP</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Bidang Keahlian</label>
                    <input type="text" name="bidang_keahlian" value="<?php echo e(old('bidang_keahlian')); ?>"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="<?php echo e(route('admin.dosen.index')); ?>" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\admin\dosen\create.blade.php ENDPATH**/ ?>