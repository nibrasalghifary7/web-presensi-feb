


<?php $__env->startSection('title', __('app.dosen.pengajuan_title')); ?>
<?php $__env->startSection('page-title', __('app.dosen.pengajuan_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div>
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Pengajuan Izin / Sakit</h3>
        <p class="text-sm text-gray-500 dark:text-slate-400">Pengajuan izin dan sakit dari mahasiswa di kelas yang Anda ajar</p>
    </div>

    
    <div class="bg-white glass rounded-xl p-4 shadow-sm border border-gray-100 dark:border-white/5">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="status" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-white/10 dark:bg-gray-800 dark:text-white text-sm">
                <option value="">Semua Status</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="disetujui" <?php echo e(request('status') == 'disetujui' ? 'selected' : ''); ?>>Disetujui</option>
                <option value="ditolak" <?php echo e(request('status') == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
            </select>
            <select name="kelas" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-white/10 dark:bg-gray-800 dark:text-white text-sm">
                <option value="">Semua Kelas</option>
                <?php $__currentLoopData = $kelasDosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($kelas); ?>" <?php echo e(request('kelas') == $kelas ? 'selected' : ''); ?>><?php echo e($kelas); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-slate-300 rounded-lg text-sm hover:bg-gray-200 dark:hover:bg-white/15">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    
    <div class="bg-white glass rounded-xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Tanggal</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Jenis</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Alasan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Bukti</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                    <?php $__empty_1 = true; $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3 text-sm text-gray-500 dark:text-slate-400"><?php echo e($pengajuans->firstItem() + $index); ?></td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800 dark:text-white"><?php echo e($p->nim); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-800 dark:text-white"><?php echo e($p->mahasiswa->nama ?? '-'); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300"><?php echo e($p->jadwal->mataKuliah->nama_mk ?? '-'); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300"><?php echo e($p->tanggal_izin->translatedFormat('d M Y')); ?></td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($p->jenis == 'Sakit' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400'); ?>">
                                    <?php echo e($p->jenis); ?>

                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600 dark:text-slate-300 max-w-xs truncate"><?php echo e($p->alasan); ?></td>
                            <td class="px-5 py-3">
                                <?php if($p->bukti_surat): ?>
                                    <a href="<?php echo e(asset('storage/' . $p->bukti_surat)); ?>" target="_blank"
                                       class="text-blue-600 dark:text-blue-400 hover:underline text-xs">
                                        <i class="fas fa-file-image mr-1"></i>Lihat
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400 dark:text-slate-500 text-xs">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-3">
                                <?php if($p->status == 'disetujui'): ?>
                                    <span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check mr-1"></i>Disetujui
                                    </span>
                                <?php elseif($p->status == 'ditolak'): ?>
                                    <span class="px-2 py-0.5 bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="px-5 py-12 text-center text-gray-400 dark:text-slate-500">
                                <i class="fas fa-file-circle-exclamation text-3xl mb-2"></i>
                                <p>Belum ada pengajuan izin/sakit dari mahasiswa</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-white/5">
            <?php echo e($pengajuans->withQueryString()->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/dosen/pengajuan.blade.php ENDPATH**/ ?>