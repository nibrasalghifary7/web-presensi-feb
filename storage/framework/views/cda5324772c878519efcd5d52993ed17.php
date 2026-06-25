<?php $__env->startSection('title', 'Notifikasi'); ?>
<?php $__env->startSection('page-title', 'Notifikasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Notifikasi Perizinan</h3>
            <p class="text-sm text-gray-500 dark:text-slate-400">Informasi persetujuan/penolakan pengajuan izin/sakit mahasiswa dari admin</p>
        </div>
        <?php if($unreadCount > 0): ?>
            <form action="<?php echo e(route('dosen.notifikasi.read-all')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-dark transition-all dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary">
                    <i class="fas fa-check-double mr-1"></i> Tandai Semua Dibaca
                </button>
            </form>
        <?php endif; ?>
    </div>

    
    <?php if($notifikasis->isEmpty()): ?>
        <div class="bg-white glass rounded-xl p-12 shadow-sm border border-gray-100 dark:border-white/5 text-center">
            <i class="fas fa-bell-slash text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-600 dark:text-white">Belum ada notifikasi</h3>
            <p class="text-sm text-gray-400 dark:text-slate-500 mt-1">Notifikasi akan muncul saat admin memproses pengajuan izin/sakit mahasiswa</p>
        </div>
    <?php else: ?>
        <div class="space-y-3">
            <?php $__currentLoopData = $notifikasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white glass rounded-xl p-5 shadow-sm border transition-all
                    <?php echo e($notif->is_read
                        ? 'border-gray-100 dark:border-white/5'
                        : 'border-blue-200 dark:border-blue-500/30 bg-blue-50/50 dark:bg-blue-500/5'); ?>">
                    <div class="flex items-start gap-4">
                        
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0
                            <?php echo e($notif->tipe === 'pengajuan_disetujui'
                                ? 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400'
                                : 'bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400'); ?>">
                            <i class="fas <?php echo e($notif->tipe === 'pengajuan_disetujui' ? 'fa-check' : 'fa-times'); ?>"></i>
                        </div>

                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <?php if(!$notif->is_read): ?>
                                    <span class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></span>
                                <?php endif; ?>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($notif->tipe === 'pengajuan_disetujui'
                                        ? 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400'
                                        : 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400'); ?>">
                                    <?php echo e($notif->tipe === 'pengajuan_disetujui' ? 'Disetujui' : 'Ditolak'); ?>

                                </span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($notif->jenis === 'Sakit' ? 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400' : 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400'); ?>">
                                    <?php echo e($notif->jenis); ?>

                                </span>
                                <span class="text-xs text-gray-400 dark:text-slate-500">
                                    <?php echo e($notif->created_at->diffForHumans()); ?>

                                </span>
                            </div>
                            <p class="text-sm text-gray-800 dark:text-white font-medium">
                                <?php echo e($notif->nama_mahasiswa); ?>

                                <span class="text-gray-500 dark:text-slate-400 font-normal">— <?php echo e($notif->nama_matakuliah); ?></span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-slate-300 mt-1"><?php echo e($notif->pesan); ?></p>
                            <p class="text-xs text-gray-400 dark:text-slate-500 mt-1">
                                <i class="fas fa-calendar mr-1"></i> Tanggal izin: <?php echo e($notif->tanggal_izin->translatedFormat('d M Y')); ?>

                            </p>
                        </div>

                        
                        <?php if(!$notif->is_read): ?>
                            <form action="<?php echo e(route('dosen.notifikasi.read', $notif->id_notifikasi)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors"
                                        title="Tandai sudah dibaca">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($notifikasis->withQueryString()->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/dosen/notifikasi.blade.php ENDPATH**/ ?>