<?php $__env->startSection('title', 'Riwayat Kehadiran'); ?>
<?php $__env->startSection('page-title', 'Riwayat Kehadiran'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-emerald-600"><?php echo e($totalHadir); ?></p>
            <p class="text-xs text-emerald-700">Hadir</p>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-amber-600"><?php echo e($totalIzinSakit); ?></p>
            <p class="text-xs text-amber-700">Izin/Sakit</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-red-600"><?php echo e($totalAlpha); ?></p>
            <p class="text-xs text-red-700">Alpha</p>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">
                <i class="fas fa-clock-rotate-left text-uin-green mr-2"></i>Data Kehadiran
            </h3>
        </div>

        <?php if($riwayat->isEmpty()): ?>
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p>Belum ada riwayat kehadiran</p>
            </div>
        <?php else: ?>
            
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam Masuk</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Keterangan</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm text-gray-500"><?php echo e($riwayat->firstItem() + $index); ?></td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-800">
                                    <?php echo e($item->jadwal->mataKuliah->nama_mk ?? '-'); ?>

                                </td>
                                <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($item->tanggal->translatedFormat('d M Y')); ?></td>
                                <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($item->jam_masuk ? substr($item->jam_masuk, 0, 5) : '-'); ?></td>
                                <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($item->catatan ?? '-'); ?></td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                        <?php echo e($item->status_badge_class); ?>">
                                        <?php echo e($item->status); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="sm:hidden divide-y divide-gray-100">
                <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-gray-800"><?php echo e($item->jadwal->mataKuliah->nama_mk ?? '-'); ?></span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold
                                <?php echo e($item->status_badge_class); ?>">
                                <?php echo e($item->status); ?>

                            </span>
                        </div>
                        <p class="text-xs text-gray-500">
                            <i class="far fa-calendar mr-1"></i> <?php echo e($item->tanggal->translatedFormat('d M Y')); ?>

                            <?php if($item->jam_masuk): ?>
                                &middot; <i class="far fa-clock mr-1"></i> <?php echo e(substr($item->jam_masuk, 0, 5)); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="px-5 py-3 border-t border-gray-100">
                <?php echo e($riwayat->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center justify-between">
        <span class="text-sm font-semibold text-blue-800">
            <i class="fas fa-chart-simple mr-2"></i>REKAP TOTAL KEHADIRAN
        </span>
        <span class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-sm font-semibold">
            <?php echo e($totalHadir); ?> dari <?php echo e($totalPertemuan); ?> Pertemuan
        </span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/mahasiswa/riwayat.blade.php ENDPATH**/ ?>