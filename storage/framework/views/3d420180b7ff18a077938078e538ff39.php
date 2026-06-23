


<?php $__env->startSection('title', __('app.dosen.laporan_title')); ?>
<?php $__env->startSection('page-title', __('app.dosen.laporan_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Laporan Kehadiran</h2>
                <p class="text-sm text-gray-500"><?php echo e($jadwal->mataKuliah->nama_mk); ?> - <?php echo e($jadwal->kelas); ?></p>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo e(route('dosen.laporan.pdf', $jadwal->id_jadwal)); ?>"
                   class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
                <a href="<?php echo e(route('dosen.laporan.excel', $jadwal->id_jadwal)); ?>"
                   class="px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition-colors">
                    <i class="fas fa-file-excel mr-1"></i> Excel
                </a>
                <button onclick="window.print()" class="px-4 py-2 bg-uin-green text-white rounded-lg text-sm font-medium hover:bg-uin-green-dark transition-colors">
                    <i class="fas fa-print mr-1"></i> Cetak
                </button>
            </div>
        </div>

        
        <div class="text-center mb-6 pb-4 border-b border-gray-200">
            <p class="font-bold text-gray-800">FAKULTAS EKONOMI DAN BISNIS</p>
            <p class="font-bold text-gray-800">UIN SYARIF HIDAYATULLAH JAKARTA</p>
            <p class="text-sm text-gray-500 mt-2">LAPORAN KEHADIRAN MAHASISWA</p>
            <p class="text-sm text-gray-500"><?php echo e($jadwal->mataKuliah->nama_mk); ?> (<?php echo e($jadwal->mataKuliah->sks); ?> SKS)</p>
            <p class="text-sm text-gray-500">Dosen: <?php echo e($jadwal->dosen->nama); ?></p>
            <p class="text-sm text-gray-500">Kelas: <?php echo e($jadwal->kelas); ?> &middot; Semester: <?php echo e($jadwal->semester_aktif); ?></p>
        </div>

        
        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2 text-xs">No</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">NIM</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Nama</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Hadir</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Izin</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Sakit</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">Alpha</th>
                    <th class="border border-gray-300 px-3 py-2 text-xs">%</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nim => $absensis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $mhs = $absensis->first()->mahasiswa;
                        $h = $absensis->where('status', 'Hadir')->count();
                        $i = $absensis->where('status', 'Izin')->count();
                        $s = $absensis->where('status', 'Sakit')->count();
                        $a = $absensis->where('status', 'Alpha')->count();
                        $t = $absensis->count();
                        $p = $t > 0 ? round(($h / $t) * 100, 1) : 0;
                    ?>
                    <tr>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center"><?php echo e($loop->iteration); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm"><?php echo e($nim); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm"><?php echo e($mhs->nama ?? '-'); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center"><?php echo e($h); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center"><?php echo e($i); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center"><?php echo e($s); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center"><?php echo e($a); ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-sm text-center font-semibold"><?php echo e($p); ?>%</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="border border-gray-300 px-3 py-8 text-center text-gray-400">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        
        <div class="mt-12 flex justify-end">
            <div class="text-center">
                <p class="text-sm text-gray-600">Tangerang Selatan, <?php echo e(now()->translatedFormat('d F Y')); ?></p>
                <p class="text-sm text-gray-600 mt-1">Dosen Pengampu,</p>
                <div class="h-16"></div>
                <p class="text-sm font-semibold text-gray-800"><?php echo e($jadwal->dosen->nama); ?></p>
                <p class="text-xs text-gray-500">NIDN: <?php echo e($jadwal->dosen->nidn); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/dosen/laporan.blade.php ENDPATH**/ ?>