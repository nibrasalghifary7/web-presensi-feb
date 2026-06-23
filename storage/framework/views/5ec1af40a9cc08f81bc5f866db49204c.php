


<?php $__env->startSection('title', __('app.dosen.validasi_title')); ?>
<?php $__env->startSection('page-title', __('app.dosen.validasi_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold text-gray-800"><?php echo e($jadwal->mataKuliah->nama_mk); ?></h3>
                <p class="text-sm text-gray-500">
                    <?php echo e($jadwal->kelas); ?> &middot; <?php echo e($jadwal->jam_formatted); ?> &middot; <?php echo e($jadwal->ruang); ?>

                </p>
            </div>
            <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                <i class="fas fa-calendar mr-1"></i> <?php echo e(now()->translatedFormat('d F Y')); ?>

            </span>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Daftar Kehadiran Mahasiswa</h3>
        </div>

        <?php if($absensis->isEmpty()): ?>
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-users-slash text-4xl mb-3"></i>
                <p>Belum ada mahasiswa yang melakukan absensi</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIM</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam Masuk</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Validasi</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php $__currentLoopData = $absensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $absen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm text-gray-500"><?php echo e($index + 1); ?></td>
                                <td class="px-5 py-3 text-sm font-medium text-gray-800"><?php echo e($absen->nim); ?></td>
                                <td class="px-5 py-3 text-sm text-gray-800"><?php echo e($absen->mahasiswa->nama); ?></td>
                                <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($absen->jam_masuk ? substr($absen->jam_masuk, 0, 5) : '-'); ?></td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                        <?php echo e($absen->status_badge_class); ?>">
                                        <?php echo e($absen->status); ?>

                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <?php if($absen->validasi === 'divalidasi'): ?>
                                        <span class="text-emerald-600 text-xs font-semibold"><i class="fas fa-check-circle mr-1"></i>Divalidasi</span>
                                    <?php elseif($absen->validasi === 'ditolak'): ?>
                                        <span class="text-red-600 text-xs font-semibold"><i class="fas fa-times-circle mr-1"></i>Ditolak</span>
                                    <?php else: ?>
                                        <span class="text-amber-600 text-xs font-semibold"><i class="fas fa-clock mr-1"></i>Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3">
                                    <?php if($absen->status === 'Menunggu'): ?>
                                        <div class="flex gap-1.5">
                                            
                                            <form action="<?php echo e(route('dosen.validasi.proses', $absen->id_absensi)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="Hadir">
                                                <input type="hidden" name="validasi" value="divalidasi">
                                                <button type="submit" class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg text-xs font-medium hover:bg-emerald-600" title="Setujui Hadir">
                                                    <i class="fas fa-check mr-1"></i> Hadir
                                                </button>
                                            </form>
                                            
                                            <form action="<?php echo e(route('dosen.validasi.proses', $absen->id_absensi)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="Alpha">
                                                <input type="hidden" name="validasi" value="ditolak">
                                                <button type="submit" class="px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-medium hover:bg-red-600" title="Tolak (Alpha)">
                                                    <i class="fas fa-times mr-1"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('dosen.validasi.proses', $absen->id_absensi)); ?>" method="POST" class="flex gap-2">
                                            <?php echo csrf_field(); ?>
                                            <select name="status" class="text-xs border rounded-lg px-2 py-1">
                                                <option value="Hadir" <?php echo e($absen->status == 'Hadir' ? 'selected' : ''); ?>>Hadir</option>
                                                <option value="Izin" <?php echo e($absen->status == 'Izin' ? 'selected' : ''); ?>>Izin</option>
                                                <option value="Sakit" <?php echo e($absen->status == 'Sakit' ? 'selected' : ''); ?>>Sakit</option>
                                                <option value="Alpha" <?php echo e($absen->status == 'Alpha' ? 'selected' : ''); ?>>Alpha</option>
                                            </select>
                                            <input type="hidden" name="validasi" value="divalidasi">
                                            <button type="submit" class="px-3 py-1 bg-uin-green text-white rounded-lg text-xs font-medium hover:bg-uin-green-dark">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/dosen/validasi.blade.php ENDPATH**/ ?>