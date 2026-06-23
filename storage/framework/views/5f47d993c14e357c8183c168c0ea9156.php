

<?php $__env->startSection('page-title', 'Persentase Kehadiran'); ?>

<?php $__env->startSection('content'); ?>
<!-- Summary Global -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-chart-pie text-uin-green mr-2"></i>Rata-Rata Kehadiran
            </h3>
            <p class="text-sm text-gray-500 mt-1">Seluruh mata kuliah</p>
        </div>
        <div class="text-right">
            <span class="text-4xl font-bold <?php echo e($rataRataGlobal >= 75 ? 'text-green-600' : ($rataRataGlobal >= 60 ? 'text-yellow-500' : 'text-red-600')); ?>">
                <?php echo e($rataRataGlobal); ?>%
            </span>
            <?php if($rataRataGlobal >= 75): ?>
                <p class="text-xs text-green-600 font-semibold mt-1">✅ Aman</p>
            <?php elseif($rataRataGlobal >= 60): ?>
                <p class="text-xs text-yellow-600 font-semibold mt-1">⚠️ Peringatan</p>
            <?php else: ?>
                <p class="text-xs text-red-600 font-semibold mt-1">🚫 Bahaya</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Progress bar global -->
    <div class="mt-4 w-full bg-gray-200 rounded-full h-3">
        <div class="h-3 rounded-full transition-all duration-500
            <?php echo e($rataRataGlobal >= 75 ? 'bg-green-500' : ($rataRataGlobal >= 60 ? 'bg-yellow-400' : 'bg-red-500')); ?>"
            style="width: <?php echo e(min($rataRataGlobal, 100)); ?>%"></div>
    </div>
</div>

<!-- Daftar per Mata Kuliah -->
<?php if(count($rekapMK) > 0): ?>
    <div class="grid gap-4">
        <?php $__currentLoopData = $rekapMK; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-2xl shadow-lg p-5 border-l-4
            <?php echo e($mk['status'] === 'aman' ? 'border-green-500' : ($mk['status'] === 'peringatan' ? 'border-yellow-400' : 'border-red-500')); ?>">

            <div class="flex items-start justify-between mb-3">
                <div>
                    <h4 class="font-bold text-gray-800 text-base"><?php echo e($mk['nama_mk']); ?></h4>
                    <p class="text-xs text-gray-500"><?php echo e($mk['kode_mk']); ?> • <?php echo e($mk['nama_dosen']); ?></p>
                </div>
                <span class="text-xs font-bold px-3 py-1 rounded-full
                    <?php echo e($mk['status'] === 'aman' ? 'bg-green-100 text-green-700' : ($mk['status'] === 'peringatan' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')); ?>">
                    <?php echo e($mk['status_label']); ?>

                </span>
            </div>

            <!-- Progress bar -->
            <div class="mb-3">
                <div class="flex justify-between text-xs mb-1">
                    <span class="font-semibold text-gray-600">Kehadiran</span>
                    <span class="font-bold <?php echo e($mk['persen'] >= 75 ? 'text-green-600' : ($mk['persen'] >= 60 ? 'text-yellow-600' : 'text-red-600')); ?>">
                        <?php echo e($mk['persen']); ?>%
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="h-2.5 rounded-full transition-all duration-500
                        <?php echo e($mk['persen'] >= 75 ? 'bg-green-500' : ($mk['persen'] >= 60 ? 'bg-yellow-400' : 'bg-red-500')); ?>"
                        style="width: <?php echo e(min($mk['persen'], 100)); ?>%"></div>
                </div>
            </div>

            <!-- Breakdown -->
            <div class="grid grid-cols-5 gap-2 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-lg font-bold text-blue-700"><?php echo e($mk['hadir']); ?></p>
                    <p class="text-xs text-blue-600">Hadir</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-lg font-bold text-blue-700"><?php echo e($mk['izin']); ?></p>
                    <p class="text-xs text-blue-600">Izin</p>
                </div>
                <div class="bg-yellow-50 rounded-lg p-2">
                    <p class="text-lg font-bold text-yellow-700"><?php echo e($mk['sakit']); ?></p>
                    <p class="text-xs text-yellow-600">Sakit</p>
                </div>
                <div class="bg-red-50 rounded-lg p-2">
                    <p class="text-lg font-bold text-red-700"><?php echo e($mk['alpha']); ?></p>
                    <p class="text-xs text-red-600">Alpha</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-2">
                    <p class="text-lg font-bold text-gray-700"><?php echo e($mk['total_pertemuan']); ?></p>
                    <p class="text-xs text-gray-600">Total</p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500">Belum ada data kehadiran</p>
    </div>
<?php endif; ?>

<!-- Legend -->
<div class="mt-4 bg-gray-50 rounded-xl p-4 text-xs text-gray-600">
    <p class="font-semibold mb-2">Keterangan Status:</p>
    <div class="flex flex-wrap gap-4">
        <span><span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-1"></span> ✅ Aman (≥75%)</span>
        <span><span class="inline-block w-3 h-3 bg-yellow-400 rounded-full mr-1"></span> ⚠️ Peringatan (60–74%)</span>
        <span><span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-1"></span> 🚫 Bahaya (&lt;60%)</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\mahasiswa\kehadiran.blade.php ENDPATH**/ ?>