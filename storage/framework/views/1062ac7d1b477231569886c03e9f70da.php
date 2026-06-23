


<?php $__env->startSection('title', 'Rekap Kehadiran'); ?>
<?php $__env->startSection('page-title', 'Rekap Kehadiran'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold text-gray-800"><?php echo e($jadwal->mataKuliah->nama_mk); ?></h3>
                <p class="text-sm text-gray-500"><?php echo e($jadwal->kelas); ?> &middot; <?php echo e($jadwal->jam_formatted); ?></p>
            </div>
            <a href="<?php echo e(route('dosen.laporan', $jadwal->id_jadwal)); ?>"
               class="px-4 py-2 bg-uin-green text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark transition-colors">
                <i class="fas fa-print mr-1"></i> Cetak Laporan
            </a>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Hadir</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Izin</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Sakit</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Alpha</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">%</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nim => $absensis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $mahasiswa = $absensis->first()->mahasiswa;
                            $hadir = $absensis->where('status', 'Hadir')->count();
                            $izin = $absensis->where('status', 'Izin')->count();
                            $sakit = $absensis->where('status', 'Sakit')->count();
                            $alpha = $absensis->where('status', 'Alpha')->count();
                            $total = $absensis->count();
                            $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;
                        ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm text-gray-500"><?php echo e($loop->iteration); ?></td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800"><?php echo e($nim); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-800"><?php echo e($mahasiswa->nama ?? '-'); ?></td>
                            <td class="px-5 py-3 text-center text-sm font-semibold text-emerald-600"><?php echo e($hadir); ?></td>
                            <td class="px-5 py-3 text-center text-sm text-amber-600"><?php echo e($izin); ?></td>
                            <td class="px-5 py-3 text-center text-sm text-yellow-600"><?php echo e($sakit); ?></td>
                            <td class="px-5 py-3 text-center text-sm text-red-600"><?php echo e($alpha); ?></td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($persen >= 75 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'); ?>">
                                    <?php echo e($persen); ?>%
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-400">
                                Belum ada data kehadiran
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\dosen\rekap.blade.php ENDPATH**/ ?>