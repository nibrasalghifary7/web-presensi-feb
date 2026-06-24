


<?php $__env->startSection('title', __('app.mahasiswa.riwayat_title')); ?>
<?php $__env->startSection('page-title', __('app.mahasiswa.riwayat_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center dark:bg-emerald-500/10 dark:border-emerald-500/20">
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400"><?php echo e($totalHadir); ?></p>
            <p class="text-xs text-emerald-700 dark:text-emerald-400"><?php echo e(__('app.mahasiswa.hadir')); ?></p>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center dark:bg-amber-500/10 dark:border-amber-500/20">
            <p class="text-2xl font-bold text-amber-600 dark:text-amber-400"><?php echo e($totalIzinSakit); ?></p>
            <p class="text-xs text-amber-700 dark:text-amber-400"><?php echo e(__('app.mahasiswa.izin_sakit')); ?></p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center dark:bg-red-500/10 dark:border-red-500/20">
            <p class="text-2xl font-bold text-red-600 dark:text-red-400"><?php echo e($totalAlpha); ?></p>
            <p class="text-xs text-red-700 dark:text-red-400"><?php echo e(__('app.mahasiswa.alpha')); ?></p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 glass overflow-hidden">
        <div class="p-5 border-b border-gray-100 dark:border-white/5">
            <h3 class="font-bold text-gray-800 dark:text-white"><i class="fas fa-clock-rotate-left text-primary dark:text-aurora-glow mr-2"></i><?php echo e(__('app.mahasiswa.riwayat_subtitle')); ?></h3>
        </div>
        <?php if($riwayat->isEmpty()): ?>
            <div class="text-center py-12 text-gray-400 dark:text-slate-500">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p><?php echo e(__('app.message.absensi_success')); ?></p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase"><?php echo e(__('app.table.no')); ?></th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase"><?php echo e(__('app.table.mata_kuliah')); ?></th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase"><?php echo e(__('app.table.tanggal')); ?></th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase"><?php echo e(__('app.table.jam_masuk')); ?></th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase"><?php echo e(__('app.table.status')); ?></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                                <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400"><?php echo e($riwayat->firstItem() + $index); ?></td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white"><?php echo e($item->jadwal->mataKuliah->nama_mk ?? '-'); ?></td>
                                <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300"><?php echo e($item->tanggal->translatedFormat('d M Y')); ?></td>
                                <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300"><?php echo e($item->jam_masuk ? substr($item->jam_masuk, 0, 5) : '-'); ?></td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold <?php echo e($item->status_badge_class); ?>"><?php echo e($item->status); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-gray-100 dark:border-white/5"><?php echo e($riwayat->links()); ?></div>
        <?php endif; ?>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center justify-between dark:bg-blue-500/10 dark:border-blue-500/20">
        <span class="text-sm font-semibold text-blue-800 dark:text-blue-300"><i class="fas fa-chart-simple mr-2"></i><?php echo e(__('app.mahasiswa.rekap_total')); ?></span>
        <span class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-sm font-semibold dark:bg-aurora-glow"><?php echo e($totalHadir); ?> <?php echo e(__('app.dosen.welcome')); ?> <?php echo e($totalPertemuan); ?></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views\mahasiswa\riwayat.blade.php ENDPATH**/ ?>