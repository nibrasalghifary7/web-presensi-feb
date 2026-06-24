


<?php $__env->startSection('title', __('app.dosen.dashboard')); ?>
<?php $__env->startSection('page-title', __('app.dosen.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="bg-gradient-to-r from-uin-green to-uin-green-light rounded-2xl p-6 text-white">
        <h2 class="text-2xl font-bold"><?php echo e(__('app.dosen.welcome')); ?>, <?php echo e($dosen->nama); ?></h2>
        <p class="text-white/80 text-sm mt-1">
            <i class="fas fa-id-badge mr-1"></i> <?php echo e(__('app.table.nidn')); ?>: <?php echo e($dosen->nidn); ?> &middot; <?php echo e($dosen->bidang_keahlian); ?>

        </p>
    </div>

    
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 dark:bg-blue-500/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-day text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($jadwalHariIni->count()); ?></p>
                    <p class="text-xs text-gray-500 dark:text-slate-400"><?php echo e(__('app.dosen.jadwal_hari_ini')); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white glass rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 dark:bg-amber-500/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-amber-600 dark:text-amber-400"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400"><?php echo e($totalValidasiPending); ?></p>
                    <p class="text-xs text-gray-500 dark:text-slate-400"><?php echo e(__('app.dosen.validasi_pending')); ?></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="bg-white glass rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/5">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
            <i class="fas fa-calendar-days text-uin-green dark:text-aurora-glow mr-2"></i><?php echo e(__('app.dosen.jadwal_hari_ini')); ?>

        </h3>

        <?php if($jadwalHariIni->isEmpty()): ?>
            <div class="text-center py-8 text-gray-400 dark:text-slate-500">
                <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                <p>Tidak ada jadwal mengajar hari ini</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $jadwalHariIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $sesiAktif = $jadwal->sesis()->whereDate('tanggal', today())->where('status', 'dibuka')->first();
                    ?>
                    <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-gray-800 dark:text-white"><?php echo e($jadwal->mataKuliah->nama_mk); ?></p>
                                    <?php if($sesiAktif): ?>
                                        <span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-full text-xs font-semibold animate-pulse">
                                            <i class="fas fa-circle text-[6px] mr-1"></i>Sesi Aktif
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                                    <i class="fas fa-clock mr-1"></i> <?php echo e($jadwal->jam_formatted); ?> &middot;
                                    <i class="fas fa-users mr-1"></i> <?php echo e($jadwal->kelas); ?> &middot;
                                    <i class="fas fa-location-dot mr-1"></i> <?php echo e($jadwal->ruang); ?>

                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                
                                <?php if($sesiAktif): ?>
                                    <form action="<?php echo e(route('dosen.sesi.tutup', $sesiAktif->id_sesi)); ?>" method="POST"
                                          onsubmit="return confirm('Tutup sesi pertemuan ini? Mahasiswa tidak bisa absen lagi.')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">
                                            <i class="fas fa-stop-circle mr-1"></i> Tutup Sesi
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form action="<?php echo e(route('dosen.sesi.buka', $jadwal->id_jadwal)); ?>" method="POST"
                                          onsubmit="return confirm('Buka sesi pertemuan? Mahasiswa akan bisa melakukan absensi.')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit"
                                                class="px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition-colors">
                                            <i class="fas fa-play-circle mr-1"></i> Buka Sesi
                                        </button>
                                    </form>
                                <?php endif; ?>

                                <a href="<?php echo e(route('dosen.validasi', $jadwal->id_jadwal)); ?>"
                                   class="px-4 py-2 bg-uin-green dark:bg-aurora-glow text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark dark:hover:bg-aurora-glow-secondary transition-colors">
                                    <i class="fas fa-check-double mr-1"></i> Validasi
                                </a>
                                <a href="<?php echo e(route('dosen.rekap', $jadwal->id_jadwal)); ?>"
                                   class="px-4 py-2 bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-white/15 transition-colors">
                                    <i class="fas fa-chart-bar mr-1"></i> Rekap
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views\dosen\dashboard.blade.php ENDPATH**/ ?>