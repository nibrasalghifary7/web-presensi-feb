<?php $__env->startSection('title', 'Pengajuan ' . ($prefillJenis ?? 'Izin/Sakit')); ?>
<?php $__env->startSection('page-title', 'Pengajuan ' . ($prefillJenis ?? 'Izin/Sakit')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">

    
    <?php if(!empty($prefillJenis)): ?>
        <div class="mb-4 <?php echo e($prefillJenis == 'Sakit' ? 'bg-red-50 dark:bg-red-500/10 border-red-200 dark:border-red-500/20' : 'bg-blue-50 dark:bg-blue-500/10 border-blue-200 dark:border-blue-500/20'); ?> border rounded-xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0
                <?php echo e($prefillJenis == 'Sakit' ? 'bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400' : 'bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400'); ?>">
                <i class="fas <?php echo e($prefillJenis == 'Sakit' ? 'fa-head-side-virus' : 'fa-file-lines'); ?>"></i>
            </div>
            <div>
                <p class="text-sm font-semibold <?php echo e($prefillJenis == 'Sakit' ? 'text-red-800 dark:text-red-300' : 'text-blue-800 dark:text-blue-300'); ?>">
                    Pengajuan <?php echo e($prefillJenis); ?>

                </p>
                <p class="text-xs <?php echo e($prefillJenis == 'Sakit' ? 'text-red-600 dark:text-red-400' : 'text-blue-600 dark:text-blue-400'); ?>">
                    Silakan lengkapi data dan unggah bukti di bawah ini
                </p>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="bg-white glass rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/5">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5">
            <i class="fas fa-file-medical text-primary dark:text-aurora-glow mr-2"></i><?php echo e(__('app.mahasiswa.form_pengajuan')); ?>

        </h3>

        <form method="POST" action="<?php echo e(route('mahasiswa.dokumen.submit')); ?>" enctype="multipart/form-data" class="space-y-4">
            <?php echo csrf_field(); ?>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                    <i class="fas fa-book-open text-primary dark:text-aurora-glow mr-1"></i> Mata Kuliah / Kelas
                </label>
                <?php if(!empty($prefillJadwalId)): ?>
                    
                    <?php $__currentLoopData = $jadwalList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($prefillJadwalId == $jadwal->id_jadwal): ?>
                            <div class="w-full px-4 py-2.5 rounded-xl bg-primary/5 dark:bg-aurora-glow/10 border border-primary/20 dark:border-aurora-glow/20">
                                <p class="text-sm font-semibold text-primary dark:text-aurora-glow"><?php echo e($jadwal->mataKuliah->nama_mk); ?></p>
                                <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5"><?php echo e($jadwal->kelas); ?> &middot; <?php echo e($jadwal->mataKuliah->sks); ?> SKS</p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="id_jadwal" value="<?php echo e($prefillJadwalId); ?>">
                <?php else: ?>
                    
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
                <?php endif; ?>
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                    <i class="fas fa-triangle-exclamation text-primary dark:text-aurora-glow mr-1"></i> Jenis Halangan
                </label>
                <?php if(!empty($prefillJenis)): ?>
                    
                    <div class="w-full px-4 py-2.5 rounded-xl
                        <?php echo e($prefillJenis == 'Sakit'
                            ? 'bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20'
                            : 'bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20'); ?>">
                        <p class="text-sm font-semibold <?php echo e($prefillJenis == 'Sakit' ? 'text-red-700 dark:text-red-400' : 'text-blue-700 dark:text-blue-400'); ?>">
                            <i class="fas <?php echo e($prefillJenis == 'Sakit' ? 'fa-head-side-virus' : 'fa-file-lines'); ?> mr-1"></i>
                            <?php echo e($prefillJenis == 'Sakit' ? 'Sakit / Medis' : 'Izin Keperluan'); ?>

                        </p>
                    </div>
                    <input type="hidden" name="jenis" value="<?php echo e($prefillJenis); ?>">
                <?php else: ?>
                    
                    <select id="jenis" name="jenis"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                   focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                   outline-none transition-all text-sm
                                   dark:border-white/20 dark:bg-gray-800 dark:text-white dark:focus:border-aurora-glow"
                            required>
                        <option value="Sakit" <?php echo e(old('jenis') == 'Sakit' ? 'selected' : ''); ?> class="bg-white dark:bg-gray-800">Sakit / Medis</option>
                        <option value="Izin" <?php echo e(old('jenis') == 'Izin' ? 'selected' : ''); ?> class="bg-white dark:bg-gray-800">Izin Keperluan</option>
                    </select>
                <?php endif; ?>
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
                          placeholder="<?php echo e($prefillJenis == 'Sakit' ? 'Contoh: Mengalami demam tinggi dan harus rawat jalan.' : 'Contoh: Ada keperluan keluarga mendesak.'); ?>"
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
                    <p class="text-sm text-gray-500 dark:text-slate-400">Pilih file PDF atau Word</p>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mt-1">PDF, DOC, DOCX &middot; Maks 2MB</p>
                    <input type="file" id="bukti_surat" name="bukti_surat"
                           accept=".pdf,.doc,.docx"
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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/mahasiswa/dokumen.blade.php ENDPATH**/ ?>