


<?php $__env->startSection('title', __('app.admin.jadwal_title')); ?>
<?php $__env->startSection('page-title', __('app.admin.jadwal_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Jadwal Kuliah</h3>
            <p class="text-sm text-gray-500">Kelola jadwal perkuliahan</p>
        </div>
        <button onclick="document.getElementById('modalJadwal').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </button>
    </div>

    
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="hari" class="px-4 py-2 rounded-lg border border-gray-200 text-sm">
                <option value="">Semua Hari</option>
                <?php $__currentLoopData = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($hari); ?>" <?php echo e(request('hari') == $hari ? 'selected' : ''); ?>><?php echo e($hari); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="text" name="kelas" value="<?php echo e(request('kelas')); ?>" placeholder="Filter kelas..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-200 text-sm focus:border-uin-green outline-none">
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
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Mata Kuliah</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Dosen</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Hari</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Ruang</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm font-medium text-gray-800"><?php echo e($j->mataKuliah->nama_mk); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($j->dosen->nama); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($j->hari); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($j->jam_formatted); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($j->ruang); ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?php echo e($j->kelas); ?></td>
                            <td class="px-5 py-3">
                                <div class="flex gap-2">
                                    <button onclick="editJadwal(<?php echo e($j->id_jadwal); ?>, <?php echo e($j->id_mk); ?>, '<?php echo e($j->nidn); ?>', '<?php echo e($j->hari); ?>', '<?php echo e(substr($j->jam_mulai, 0, 5)); ?>', '<?php echo e(substr($j->jam_selesai, 0, 5)); ?>', '<?php echo e($j->ruang); ?>', '<?php echo e($j->kelas); ?>', '<?php echo e($j->semester_aktif); ?>')"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?php echo e(route('admin.jadwal.destroy', $j->id_jadwal)); ?>" method="POST"
                                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="px-5 py-12 text-center text-gray-400">Belum ada jadwal</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-gray-100"><?php echo e($jadwals->withQueryString()->links()); ?></div>
    </div>

    
    <div id="modalJadwal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Jadwal Kuliah</h3>
            <form method="POST" action="<?php echo e(route('admin.jadwal.store')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mata Kuliah</label>
                        <select name="id_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <?php $__currentLoopData = $mataKuliahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mk->id_mk); ?>"><?php echo e($mk->nama_mk); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dosen</label>
                        <select name="nidn" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($d->nidn); ?>"><?php echo e($d->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                        <select name="hari" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <?php $__currentLoopData = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($hari); ?>"><?php echo e($hari); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                        <input type="text" name="kelas" required placeholder="Manajemen A"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                        <input type="text" name="ruang" placeholder="Teater FEB Lt.2"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                        <input type="text" name="semester_aktif" required placeholder="2024/2025 Ganjil"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Simpan</button>
                    <button type="button" onclick="document.getElementById('modalJadwal').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="modalEditJadwal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Jadwal Kuliah</h3>
            <form id="formEditJadwal" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mata Kuliah</label>
                        <select name="id_mk" id="edit_mk" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <?php $__currentLoopData = $mataKuliahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mk->id_mk); ?>"><?php echo e($mk->nama_mk); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dosen</label>
                        <select name="nidn" id="edit_nidn" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($d->nidn); ?>"><?php echo e($d->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                        <select name="hari" id="edit_hari" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                            <?php $__currentLoopData = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($hari); ?>"><?php echo e($hari); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                        <input type="text" name="kelas" id="edit_kelas" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="edit_jam_mulai" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="edit_jam_selesai" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                        <input type="text" name="ruang" id="edit_ruang"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                        <input type="text" name="semester_aktif" id="edit_semester" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-uin-green outline-none">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark">Update</button>
                    <button type="button" onclick="document.getElementById('modalEditJadwal').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function editJadwal(id, id_mk, nidn, hari, jam_mulai, jam_selesai, ruang, kelas, semester) {
        document.getElementById('formEditJadwal').action = '/admin/jadwal/' + id;
        document.getElementById('edit_mk').value = id_mk;
        document.getElementById('edit_nidn').value = nidn;
        document.getElementById('edit_hari').value = hari;
        document.getElementById('edit_jam_mulai').value = jam_mulai;
        document.getElementById('edit_jam_selesai').value = jam_selesai;
        document.getElementById('edit_ruang').value = ruang;
        document.getElementById('edit_kelas').value = kelas;
        document.getElementById('edit_semester').value = semester;
        document.getElementById('modalEditJadwal').classList.remove('hidden');
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/admin/jadwal/index.blade.php ENDPATH**/ ?>