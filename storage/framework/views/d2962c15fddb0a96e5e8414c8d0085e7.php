


<?php $__env->startSection('title', __('app.mahasiswa.dokumen_title')); ?>
<?php $__env->startSection('page-title', __('app.mahasiswa.dokumen_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        
        <div class="bg-white glass rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5">
                <i class="fas fa-file-medical text-primary dark:text-aurora-glow mr-2"></i><?php echo e(__('app.mahasiswa.form_pengajuan')); ?>

            </h3>

            <form method="POST" action="<?php echo e(route('mahasiswa.dokumen.submit')); ?>" enctype="multipart/form-data" class="space-y-4">
                <?php echo csrf_field(); ?>

                
                <div>
                    <label for="id_jadwal" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                        <i class="fas fa-book-open text-primary dark:text-aurora-glow mr-1"></i> Mata Kuliah / Kelas
                    </label>
                    <select id="id_jadwal" name="id_jadwal"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                   focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                   outline-none transition-all text-sm
                                   dark:border-white/20 dark:bg-gray-800 dark:text-white dark:focus:border-aurora-glow"
                            required>
                        <option value="" class="bg-white dark:bg-gray-800">-- Pilih Mata Kuliah --</option>
                        <?php $__currentLoopData = $jadwalList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jadwal->id_jadwal); ?>" <?php echo e(old('id_jadwal') == $jadwal->id_jadwal ? 'selected' : ''); ?>

                                    class="bg-white dark:bg-gray-800">
                                <?php echo e($jadwal->mataKuliah->nama_mk); ?> (<?php echo e($jadwal->kelas); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="jenis" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                        <i class="fas fa-triangle-exclamation text-primary dark:text-aurora-glow mr-1"></i> Jenis Halangan
                    </label>
                    <select id="jenis" name="jenis"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                   focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                   outline-none transition-all text-sm
                                   dark:border-white/20 dark:bg-gray-800 dark:text-white dark:focus:border-aurora-glow"
                            required>
                        <option value="Sakit" <?php echo e(old('jenis') == 'Sakit' ? 'selected' : ''); ?> class="bg-white dark:bg-gray-800">Sakit / Medis</option>
                        <option value="Izin" <?php echo e(old('jenis') == 'Izin' ? 'selected' : ''); ?> class="bg-white dark:bg-gray-800">Izin Keperluan</option>
                    </select>
                </div>

                
                <div>
                    <label for="tanggal_izin" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                        <i class="fas fa-calendar-day text-primary dark:text-aurora-glow mr-1"></i> Tanggal Berhalangan
                    </label>
                    <input type="date" id="tanggal_izin" name="tanggal_izin" value="<?php echo e(old('tanggal_izin', date('Y-m-d'))); ?>"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                  focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                  outline-none transition-all text-sm
                                  dark:border-white/20 dark:bg-gray-800 dark:text-white dark:focus:border-aurora-glow"
                           required>
                </div>

                
                <div>
                    <label for="alasan" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                        <i class="fas fa-pencil text-primary dark:text-aurora-glow mr-1"></i> Catatan / Alasan Singkat
                    </label>
                    <textarea id="alasan" name="alasan" rows="3"
                              placeholder="Contoh: Mengalami demam tinggi dan harus rawat jalan."
                              class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                     focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                     outline-none transition-all text-sm resize-none
                                     dark:border-white/20 dark:bg-gray-800 dark:text-white dark:focus:border-aurora-glow"
                              required><?php echo e(old('alasan')); ?></textarea>
                </div>

                
                <div>
                    <label for="bukti_surat" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                        <i class="fas fa-paperclip text-primary dark:text-aurora-glow mr-1"></i> Unggah Bukti Surat
                    </label>
                    <div class="border-2 border-dashed border-gray-200 dark:border-white/20 rounded-xl p-4 text-center hover:border-primary dark:hover:border-aurora-glow transition-colors">
                        <i class="fas fa-cloud-arrow-up text-3xl text-gray-300 dark:text-slate-500 mb-2"></i>
                        <p class="text-sm text-gray-500 dark:text-slate-400">Pilih file foto/PDF atau drag and drop</p>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mt-1">PNG, JPG, JPEG, PDF &middot; Maks 2MB</p>
                        <input type="file" id="bukti_surat" name="bukti_surat"
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="mt-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                      file:bg-primary file:text-white hover:file:bg-primary-dark
                                      dark:text-slate-400 dark:file:bg-gray-800 dark:hover:file:bg-aurora-glow-secondary">
                    </div>
                    <?php $__errorArgs = ['bukti_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <button type="submit"
                        class="w-full bg-primary text-white font-bold py-3 px-4
                               rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-dark hover:shadow-xl transition-all
                               dark:bg-gray-800 dark:hover:bg-gray-700 dark:shadow-gray-800/20
                               flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i>
                    <span>Kirim Pengajuan</span>
                </button>
            </form>
        </div>

        
        <div class="bg-white glass rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5">
                <i class="fas fa-list text-primary dark:text-aurora-glow mr-2"></i>Daftar Pengajuan
            </h3>

            <?php if($riwayatIzin->isEmpty()): ?>
                <div class="text-center py-8 text-gray-400 dark:text-slate-500">
                    <i class="fas fa-file-pen text-4xl mb-3"></i>
                    <p>Belum ada pengajuan</p>
                </div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $riwayatIzin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $izin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                        <?php echo e($izin->jadwal->mataKuliah->nama_mk ?? '-'); ?>

                                    </p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                            <?php echo e($izin->jenis == 'Sakit' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400'); ?>">
                                            <?php echo e($izin->jenis); ?>

                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-slate-400">
                                            <i class="far fa-calendar mr-1"></i><?php echo e($izin->tanggal_izin->translatedFormat('d M Y')); ?>

                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-slate-400 mt-1"><?php echo e($izin->alasan); ?></p>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($izin->status == 'disetujui' ? 'bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400' : ($izin->status == 'ditolak' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400' : 'bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-slate-300')); ?>">
                                    <?php echo e(ucfirst($izin->status)); ?>

                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-4">
                    <?php echo e($riwayatIzin->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/mahasiswa/dokumen.blade.php ENDPATH**/ ?>