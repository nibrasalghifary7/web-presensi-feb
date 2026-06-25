

<?php $__env->startSection('page-title', 'Ganti Password'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-full mb-3">
                <i class="fas fa-key text-blue-600 text-xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-400 dark:text-white">Ganti Password</h2>
            <p class="text-sm text-gray-500 mt-1">Ubah password akun Anda</p>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                <i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.change')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-lock text-uin-green mr-1"></i> Password Lama
                </label>
                <input type="password" name="current_password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 outline-none transition-all text-sm"
                       placeholder="Masukkan password lama" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-key text-uin-green mr-1"></i> Password Baru
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 outline-none transition-all text-sm"
                       placeholder="Minimal 6 karakter" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-check-double text-uin-green mr-1"></i> Konfirmasi Password Baru
                </label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 outline-none transition-all text-sm"
                       placeholder="Ulangi password baru" required>
            </div>

            <button type="submit"
                    class="w-full bg-uin-green hover:bg-uin-green-dark text-white font-bold py-3 px-4 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Simpan Password Baru
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="javascript:history.back()" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-all inline-flex items-center gap-1">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/auth/change-password.blade.php ENDPATH**/ ?>