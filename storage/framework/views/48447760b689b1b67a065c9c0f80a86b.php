


<?php $__env->startSection('title', __('app.mahasiswa.absensi_title')); ?>
<?php $__env->startSection('page-title', __('app.mahasiswa.absensi_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm border border-blue-200">
        <i class="fas fa-location-dot"></i>
        <span>GPS LOKASI: Dalam Kampus (FEB)</span>
    </div>

    
    <?php if($jadwalHariIni->isEmpty()): ?>
        <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-100 text-center">
            <i class="fas fa-calendar-xmark text-5xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-600"><?php echo e(__('app.mahasiswa.no_jadwal')); ?></h3>
        </div>
    <?php else: ?>
        <?php $__currentLoopData = $jadwalHariIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $sudahAbsen = isset($absensiHariIni[$jadwal->id_jadwal]);
            ?>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                        
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-lg font-bold text-gray-800"><?php echo e($jadwal->mataKuliah->nama_mk); ?></h3>
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                <?php echo e($jadwal->kelas); ?>

                            </span>
                        </div>

                        
                        <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500">
                            <span><i class="far fa-clock text-gray-400 mr-1"></i> <?php echo e(now()->translatedFormat('l')); ?>, <?php echo e($jadwal->jam_formatted); ?> WIB</span>
                            <span><i class="fas fa-location-dot text-gray-400 mr-1"></i> <?php echo e($jadwal->ruang); ?></span>
                            <span><i class="fas fa-layer-group text-gray-400 mr-1"></i> <?php echo e($jadwal->mataKuliah->sks); ?> SKS</span>
                        </div>

                        
                        <p class="text-sm text-gray-400 mt-2">
                            <i class="fas fa-chalkboard-teacher mr-1"></i> <?php echo e($jadwal->dosen->nama); ?>

                        </p>
                    </div>

                    
                    <div class="flex flex-col items-end gap-2">
                        <?php if($sudahAbsen): ?>
                            <?php if($absensiHariIni[$jadwal->id_jadwal] === 'Menunggu'): ?>
                                <span class="inline-flex items-center gap-1 px-4 py-2 bg-blue-100 text-blue-700 rounded-xl text-sm font-medium">
                                    <i class="fas fa-clock"></i> Menunggu Validasi
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl text-sm font-medium">
                                    <i class="fas fa-check-circle"></i> <?php echo e($absensiHariIni[$jadwal->id_jadwal]); ?>

                                </span>
                            <?php endif; ?>
                        <?php elseif(isset($sesiAktif[$jadwal->id_jadwal])): ?>
                            <form action="<?php echo e(route('mahasiswa.absensi.proses', $jadwal->id_jadwal)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-semibold
                                               hover:bg-uin-green-dark shadow-md hover:shadow-lg transition-all">
                                    <i class="fas fa-check mr-1"></i> <?php echo e(__('app.mahasiswa.absen_sekarang')); ?>

                                </button>
                            </form>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-sm font-medium">
                                <i class="fas fa-lock"></i> <?php echo e(__('app.mahasiswa.sesi_belum_dibuka')); ?>

                            </span>
                            <span class="text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i> <?php echo e(__('app.mahasiswa.menunggu_sesi')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
        <div class="flex items-start gap-3">
            <i class="fas fa-lightbulb text-amber-500 mt-0.5"></i>
            <div>
                <p class="text-sm font-semibold text-amber-800">Fitur Pengembangan</p>
                <p class="text-xs text-amber-600 mt-1">
                    Pengembangan selanjutnya akan menambahkan:
                </p>
                <ul class="text-xs text-amber-600 mt-2 space-y-1 list-disc list-inside">
                    <li>Absensi menggunakan QR Code yang di-generate dosen</li>
                    <li>Verifikasi lokasi GPS dalam radius kampus</li>
                    <li>Notifikasi pengingat jadwal kuliah</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/mahasiswa/absensi.blade.php ENDPATH**/ ?>