


<?php $__env->startSection('title', __('app.mahasiswa.dashboard')); ?>
<?php $__env->startSection('page-title', __('app.mahasiswa.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="bg-gradient-to-r from-uin-green to-uin-green-light rounded-2xl p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold"><?php echo e(__('app.dosen.welcome')); ?>, <?php echo e($mahasiswa->nama); ?>! 👋</h2>
                <p class="text-white/80 text-sm mt-1">
                    <i class="fas fa-id-card mr-1"></i> <?php echo e($mahasiswa->nim); ?> &middot; <?php echo e($mahasiswa->kelas); ?> &middot; <?php echo e(__('app.table.angkatan')); ?> <?php echo e($mahasiswa->angkatan); ?>

                </p>
            </div>
            <div class="bg-white/20 px-4 py-2 rounded-xl text-sm">
                <i class="fas fa-calendar mr-1"></i> <?php echo e(now()->translatedFormat('l, d F Y')); ?>

            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-days text-blue-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalPertemuan); ?></p>
                    <p class="text-xs text-gray-500"><?php echo e(__('app.mahasiswa.total_pertemuan')); ?></p>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-600"><?php echo e($totalHadir); ?></p>
                    <p class="text-xs text-gray-500"><?php echo e(__('app.mahasiswa.hadir')); ?></p>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-medical text-amber-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-600"><?php echo e($totalIzinSakit); ?></p>
                    <p class="text-xs text-gray-500"><?php echo e(__('app.mahasiswa.izin_sakit')); ?></p>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600"><?php echo e($totalAlpha); ?></p>
                    <p class="text-xs text-gray-500"><?php echo e(__('app.mahasiswa.alpha')); ?></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-800"><?php echo e(__('app.mahasiswa.persentase')); ?></h3>
                <p class="text-sm text-gray-500 mt-1"><?php echo e(__('app.mahasiswa.persentase_desc')); ?></p>
            </div>
            <div class="flex items-center gap-4">
                
                <div class="relative w-20 h-20">
                    <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none" stroke="#e5e7eb" stroke-width="3"/>
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none"
                              stroke="<?php echo e($persentase >= 75 ? '#10b981' : ($persentase >= 50 ? '#f59e0b' : '#ef4444')); ?>"
                              stroke-width="3"
                              stroke-dasharray="<?php echo e($persentase); ?>, 100"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800"><?php echo e($persentase); ?>%</span>
                    </div>
                </div>
                <div>
                    <?php if($persentase >= 75): ?>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle"></i> <?php echo e(__('app.mahasiswa.memenuhi_syarat')); ?>

                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                            <i class="fas fa-exclamation-triangle"></i> <?php echo e(__('app.mahasiswa.belum_memenuhi')); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-calendar-day text-uin-green mr-2"></i><?php echo e(__('app.mahasiswa.jadwal_hari_ini')); ?>

        </h3>

        <?php if($jadwalHariIni->isEmpty()): ?>
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                <p><?php echo e(__('app.mahasiswa.no_jadwal')); ?></p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $jadwalHariIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-uin-green/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-uin-green"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo e($jadwal->mataKuliah->nama_mk); ?></p>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i> <?php echo e($jadwal->jam_formatted); ?> &middot;
                                    <i class="fas fa-location-dot mr-1"></i> <?php echo e($jadwal->ruang); ?>

                                </p>
                                <p class="text-xs text-gray-400"><?php echo e($jadwal->dosen->nama); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('mahasiswa.absensi')); ?>"
                           class="px-4 py-2 bg-uin-green text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark transition-colors">
                            <i class="fas fa-check mr-1"></i> <?php echo e(__('app.mahasiswa.absen')); ?>

                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\mahasiswa\dashboard.blade.php ENDPATH**/ ?>