<?php $__env->startSection('title', __('app.admin.pengajuan_title')); ?>
<?php $__env->startSection('page-title', __('app.admin.pengajuan_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div>
        <h3 class="text-lg font-bold text-gray-800">Daftar Pengajuan Izin / Sakit</h3>
        <p class="text-sm text-gray-500">Kelola pengajuan izin dan sakit dari mahasiswa</p>
    </div>

    
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari NIM atau nama..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green focus:ring-1 focus:ring-uin-green/20 outline-none">
            <select name="status" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Status</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="disetujui" <?php echo e(request('status') == 'disetujui' ? 'selected' : ''); ?>>Disetujui</option>
                <option value="ditolak" <?php echo e(request('status') == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jenis</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Alasan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Bukti</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm text-gray-500"><?php echo e($pengajuans->firstItem() + $index); ?></td>
                            <td class="px-5 py-3 text-sm font-medium text-gray-800"><?php echo e($p->nim); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-800"><?php echo e($p->mahasiswa->nama ?? '-'); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($p->jadwal->mataKuliah->nama_mk ?? '-'); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($p->tanggal_izin->translatedFormat('d M Y')); ?></td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($p->jenis == 'Sakit' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700'); ?>">
                                    <?php echo e($p->jenis); ?>

                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-600 max-w-xs truncate"><?php echo e($p->alasan); ?></td>
                            <td class="px-5 py-3">
                                <?php if($p->bukti_surat): ?>
                                    <a href="<?php echo e(asset('storage/' . $p->bukti_surat)); ?>" target="_blank"
                                       class="text-blue-600 hover:underline text-xs">
                                        <i class="fas fa-file-image mr-1"></i>Lihat
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400 text-xs">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-3">
                                <?php if($p->status == 'disetujui'): ?>
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check mr-1"></i>Disetujui
                                    </span>
                                <?php elseif($p->status == 'ditolak'): ?>
                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-3">
                                <?php if($p->status == 'pending'): ?>
                                    <div class="flex gap-2">
                                        <form action="<?php echo e(route('admin.pengajuan.approve', $p->id_pengajuan)); ?>" method="POST"
                                              onsubmit="return confirm('Setujui pengajuan ini?')">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-medium hover:bg-emerald-200">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('admin.pengajuan.reject', $p->id_pengajuan)); ?>" method="POST"
                                              onsubmit="return confirm('Tolak pengajuan ini?')">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400 text-xs">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="10" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-file-circle-exclamation text-3xl mb-2"></i>
                                <p>Belum ada pengajuan izin/sakit</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100">
            <?php echo e($pengajuans->withQueryString()->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\admin\pengajuan\index.blade.php ENDPATH**/ ?>