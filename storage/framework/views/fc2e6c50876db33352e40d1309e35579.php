


<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-graduate text-blue-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalMahasiswa); ?></p>
                    <p class="text-xs text-gray-500">Total Mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-purple-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalDosen); ?></p>
                    <p class="text-xs text-gray-500">Total Dosen</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-book text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalMataKuliah); ?></p>
                    <p class="text-xs text-gray-500">Mata Kuliah</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-amber-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalJadwal); ?></p>
                    <p class="text-xs text-gray-500">Jadwal Kuliah</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-cyan-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-double text-cyan-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalAbsensiHariIni); ?></p>
                    <p class="text-xs text-gray-500">Absensi Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-circle-exclamation text-red-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600"><?php echo e($totalPengajuanPending); ?></p>
                    <p class="text-xs text-gray-500">Pengajuan Pending</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Akses Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
                <span class="text-xs font-medium text-blue-800">Kelola Mahasiswa</span>
            </a>
            <a href="<?php echo e(route('admin.dosen.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors">
                <i class="fas fa-chalkboard-teacher text-purple-600 text-xl"></i>
                <span class="text-xs font-medium text-purple-800">Kelola Dosen</span>
            </a>
            <a href="<?php echo e(route('admin.mata-kuliah.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition-colors">
                <i class="fas fa-book text-emerald-600 text-xl"></i>
                <span class="text-xs font-medium text-emerald-800">Mata Kuliah</span>
            </a>
            <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                <i class="fas fa-calendar-alt text-amber-600 text-xl"></i>
                <span class="text-xs font-medium text-amber-800">Jadwal Kuliah</span>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>