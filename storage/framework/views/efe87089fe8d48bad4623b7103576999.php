<?php $__env->startSection('page-title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <!-- Card Profil -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Header biru -->
        <div class="bg-gradient-to-r from-uin-green to-uin-green-light px-6 py-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-3">
                <span class="text-3xl font-bold text-uin-green"><?php echo e(strtoupper(substr($mahasiswa->nama ?? $user->name, 0, 1))); ?></span>
            </div>
            <h2 class="text-2xl font-bold text-white"><?php echo e($mahasiswa->nama ?? $user->name); ?></h2>
            <p class="text-blue-100 text-sm mt-1"><?php echo e($mahasiswa->nim ?? '-'); ?></p>
            <span class="inline-block mt-2 bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                Mahasiswa
            </span>
        </div>

        <!-- Data Profil -->
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-id-card text-uin-green mr-2"></i>Data Diri
            </h3>

            <div class="space-y-4">
                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-hashtag text-uin-green"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">NIM</p>
                        <p class="text-sm font-bold text-gray-800"><?php echo e($mahasiswa->nim ?? '-'); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Nama Lengkap</p>
                        <p class="text-sm font-bold text-gray-800"><?php echo e($mahasiswa->nama ?? $user->name); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Email</p>
                        <p class="text-sm font-bold text-gray-800"><?php echo e($mahasiswa->email ?? $user->email ?? '-'); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Kelas</p>
                        <p class="text-sm font-bold text-gray-800"><?php echo e($mahasiswa->kelas ?? '-'); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-calendar text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Angkatan</p>
                        <p class="text-sm font-bold text-gray-800"><?php echo e($mahasiswa->angkatan ?? '-'); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-at text-gray-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Username</p>
                        <p class="text-sm font-bold text-gray-800"><?php echo e($user->username); ?></p>
                    </div>
                </div>
            </div>

            <!-- Tombol Ganti Password -->
            <div class="mt-6">
                <a href="<?php echo e(route('password.change.form')); ?>"
                   class="w-full flex items-center justify-center gap-2 bg-uin-green hover:bg-uin-green-dark text-white font-bold py-3 px-4 rounded-xl shadow transition-all">
                    <i class="fas fa-key"></i> Ganti Password
                </a>
            </div>

            <p class="text-xs text-gray-400 text-center mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                Data profil dikelola oleh administrator. Hubungi admin untuk perubahan data.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/mahasiswa/profil.blade.php ENDPATH**/ ?>