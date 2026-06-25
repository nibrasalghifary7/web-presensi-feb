<?php $__env->startSection('title', 'Riwayat Pengajuan'); ?>
<?php $__env->startSection('page-title', 'Riwayat Pengajuan'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div>
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Riwayat Pengajuan Izin / Sakit</h3>
        <p class="text-sm text-gray-500 dark:text-slate-400">Daftar pengajuan izin dan sakit yang pernah Anda kirim</p>
    </div>

    
    <?php if($riwayatPengajuan->isEmpty()): ?>
        <div class="bg-white glass rounded-xl p-12 shadow-sm border border-gray-100 dark:border-white/5 text-center">
            <i class="fas fa-file-circle-check text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-600 dark:text-white">Belum ada pengajuan</h3>
            <p class="text-sm text-gray-400 dark:text-slate-500 mt-1">Pengajuan izin/sakit yang Anda kirim akan muncul di sini</p>
        </div>
    <?php else: ?>
        <div class="space-y-3">
            <?php $__currentLoopData = $riwayatPengajuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $izin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($izin->jenis == 'Sakit' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400'); ?>">
                                    <?php echo e($izin->jenis); ?>

                                </span>
                                <span class="text-xs text-gray-500 dark:text-slate-400">
                                    <i class="far fa-calendar mr-1"></i><?php echo e($izin->tanggal_izin->translatedFormat('d M Y')); ?>

                                </span>
                            </div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                <?php echo e($izin->jadwal->mataKuliah->nama_mk ?? '-'); ?>

                                <span class="text-xs font-normal text-gray-500 dark:text-slate-400">(<?php echo e($izin->jadwal->kelas ?? '-'); ?>)</span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-slate-300 mt-1"><?php echo e($izin->alasan); ?></p>
                            <?php if($izin->bukti_surat): ?>
                                <a href="<?php echo e(asset('storage/' . $izin->bukti_surat)); ?>" target="_blank"
                                   class="inline-flex items-center gap-1 mt-2 text-xs text-blue-600 dark:text-blue-400 hover:underline">
                                    <i class="fas fa-file-alt"></i> Lihat Bukti
                                </a>
                            <?php endif; ?>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0
                            <?php echo e($izin->status == 'disetujui' ? 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400' : ($izin->status == 'ditolak' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400')); ?>">
                            <?php if($izin->status == 'disetujui'): ?>
                                <i class="fas fa-check mr-1"></i>Disetujui
                            <?php elseif($izin->status == 'ditolak'): ?>
                                <i class="fas fa-times mr-1"></i>Ditolak
                            <?php else: ?>
                                <i class="fas fa-clock mr-1"></i>Pending
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($riwayatPengajuan->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/mahasiswa/riwayat-pengajuan.blade.php ENDPATH**/ ?>