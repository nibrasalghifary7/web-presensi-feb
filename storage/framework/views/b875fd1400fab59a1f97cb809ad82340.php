<?php $__env->startSection('title', 'Profil Saya'); ?>
<?php $__env->startSection('page-title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden glass">
        
        <div class="bg-gradient-to-r from-primary to-primary-light px-6 py-8 text-center dark:from-aurora-glow dark:to-aurora-glow-tertiary">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-3">
                <span class="text-3xl font-bold text-primary dark:text-aurora-glow"><?php echo e(strtoupper(substr($dosen->nama ?? $user->name, 0, 1))); ?></span>
            </div>
            <h2 class="text-2xl font-bold text-white"><?php echo e($dosen->nama ?? $user->name); ?></h2>
            <p class="text-white/80 text-sm mt-1"><?php echo e($dosen->nidn ?? '-'); ?></p>
            <span class="inline-block mt-2 bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                Dosen
            </span>
        </div>

        
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
                <i class="fas fa-id-card text-primary dark:text-aurora-glow mr-2"></i>Data Diri
            </h3>

            <div class="space-y-4">
                <?php
                    $profileData = [
                        ['icon' => 'fa-id-badge', 'color' => 'blue', 'label' => 'NIDN', 'value' => $dosen->nidn ?? '-'],
                        ['icon' => 'fa-user', 'color' => 'blue', 'label' => 'Nama Lengkap', 'value' => $dosen->nama ?? $user->name],
                        ['icon' => 'fa-envelope', 'color' => 'purple', 'label' => 'Email', 'value' => $dosen->email ?? $user->email ?? '-'],
                        ['icon' => 'fa-phone', 'color' => 'green', 'label' => 'No. HP', 'value' => $dosen->phone ?? $user->phone ?? '-'],
                        ['icon' => 'fa-book', 'color' => 'amber', 'label' => 'Bidang Keahlian', 'value' => $dosen->bidang_keahlian ?? '-'],
                        ['icon' => 'fa-at', 'color' => 'gray', 'label' => 'Username', 'value' => $user->username],
                    ];
                ?>

                <?php $__currentLoopData = $profileData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl dark:bg-white/5">
                        <div class="w-10 h-10 bg-<?php echo e($item['color']); ?>-100 rounded-lg flex items-center justify-center flex-shrink-0
                                    dark:bg-<?php echo e($item['color']); ?>-500/10 dark:border dark:border-<?php echo e($item['color']); ?>-500/20">
                            <i class="fas <?php echo e($item['icon']); ?> text-<?php echo e($item['color']); ?>-600 dark:text-<?php echo e($item['color']); ?>-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase"><?php echo e($item['label']); ?></p>
                            <p class="text-sm font-bold text-gray-800 dark:text-white"><?php echo e($item['value']); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-6">
                <a href="#"
                   class="w-full flex items-center justify-center gap-2 bg-primary text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all
                          dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary dark:shadow-aurora-glow/20">
                    <i class="fas fa-key"></i> Ganti Password
                </a>
            </div>

            <p class="text-xs text-gray-400 dark:text-slate-500 text-center mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                Data profil dikelola oleh administrator. Hubungi admin untuk perubahan data.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/dosen/profil.blade.php ENDPATH**/ ?>