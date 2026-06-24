


<?php $__env->startSection('title', __('app.admin.mahasiswa_add')); ?>
<?php $__env->startSection('page-title', __('app.admin.mahasiswa_add')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm dark:shadow-slate-900/50 border border-gray-100 dark:border-slate-700">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5">
            <i class="fas fa-user-plus text-uin-green mr-2"></i><?php echo e(__('app.admin.mahasiswa_add')); ?>

        </h3>

        <form method="POST" action="<?php echo e(route('admin.mahasiswa.store')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">NIM</label>
                    <input type="text" name="nim" value="<?php echo e(old('nim')); ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                    <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">No. HP</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Kelas</label>
                    <select name="kelas" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                        <option value="">-- Pilih Kelas --</option>
                        <?php $__currentLoopData = $kelasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->nama_kelas); ?>" <?php echo e(old('kelas') == $k->nama_kelas ? 'selected' : ''); ?>><?php echo e($k->nama_kelas); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-200 mb-1">Angkatan</label>
                    <select name="angkatan" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit"
                        class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="<?php echo e(route('admin.mahasiswa.index')); ?>"
                   class="px-6 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-200 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views\admin\mahasiswa\create.blade.php ENDPATH**/ ?>