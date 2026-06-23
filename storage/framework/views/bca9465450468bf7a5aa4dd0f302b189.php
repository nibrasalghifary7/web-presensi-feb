
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('app.register')); ?> - <?php echo e(__('app.app_name')); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: { 'aurora': { 'bg': '#020817', 'glow': '#5B7FFF', 'glow-tertiary': '#8A7DFF' }, 'primary': '#2563EB', 'primary-dark': '#1D4ED8', 'primary-light': '#3B82F6' } } }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        (function() { const t = localStorage.getItem('theme') || 'light'; document.documentElement.classList.add(t); })();
    </script>
    <style>
        @keyframes gradientShift { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }
        .animated-gradient { background:linear-gradient(135deg,#2563EB 0%,#1D4ED8 25%,#3B82F6 50%,#1D4ED8 75%,#2563EB 100%); background-size:400% 400%; animation:gradientShift 15s ease infinite; }
        html.dark .animated-gradient { background:linear-gradient(135deg,#020817 0%,#0A1733 25%,#132A5A 50%,#0A1733 75%,#020817 100%); background-size:400% 400%; }
        html.dark .login-card { background:rgba(10,18,40,0.65); backdrop-filter:blur(24px); border:1px solid rgba(255,255,255,0.08); }
    </style>
</head>
<body class="h-full animated-gradient flex items-center justify-center p-4 py-8 bg-gray-50 dark:bg-aurora-bg">

    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-lg mb-3 dark:bg-aurora-bg/80 dark:border dark:border-white/10">
                <i class="fas fa-user-plus text-primary text-2xl dark:text-aurora-glow"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-1"><?php echo e(__('app.auth.register_title')); ?></h1>
            <p class="text-white/70 text-sm"><?php echo e(__('app.app_name')); ?> &middot; <?php echo e(__('app.university')); ?></p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 login-card">
            <div class="text-center mb-5">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white"><?php echo e(__('app.auth.register_subtitle')); ?></h2>
            </div>

            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl dark:bg-red-500/10 dark:border-red-500/20 dark:text-red-300">
                    <ul class="text-sm space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start gap-2"><i class="fas fa-exclamation-circle mt-0.5"></i><span><?php echo e($error); ?></span></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('register.post')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-id-card text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.nim')); ?></label>
                    <input type="text" name="nim" value="<?php echo e(old('nim')); ?>" placeholder="12408011010024" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-user text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.nama')); ?></label>
                    <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-envelope text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.email')); ?></label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="contoh@email.com" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-phone text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.phone')); ?></label>
                    <input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="08xxxxxxxxxx" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-users text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.kelas')); ?></label>
                    <select name="kelas" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                        <option value=""><?php echo e(__('app.placeholder.select_kelas')); ?></option>
                        <option value="Manajemen A" <?php echo e(old('kelas')=='Manajemen A'?'selected':''); ?>>Manajemen A</option>
                        <option value="Manajemen B" <?php echo e(old('kelas')=='Manajemen B'?'selected':''); ?>>Manajemen B</option>
                        <option value="Manajemen C" <?php echo e(old('kelas')=='Manajemen C'?'selected':''); ?>>Manajemen C</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-calendar text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.angkatan')); ?></label>
                    <select name="angkatan" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                        <option value=""><?php echo e(__('app.placeholder.select_angkatan')); ?></option>
                        <?php for($y=date('Y');$y>=2020;$y--): ?> <option value="<?php echo e($y); ?>" <?php echo e(old('angkatan')==$y?'selected':''); ?>><?php echo e($y); ?></option> <?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-lock text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.password')); ?></label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1"><i class="fas fa-lock text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.password_confirm')); ?></label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:border-primary focus:ring-1 focus:ring-primary/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow outline-none transition-all text-sm">
                </div>
                <button type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-primary/20 hover:shadow-xl transition-all duration-300 dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary dark:shadow-aurora-glow/20 flex items-center justify-center gap-2 mt-2">
                    <i class="fas fa-user-plus"></i> <span><?php echo e(__('app.register')); ?></span>
                </button>
            </form>

            <div class="mt-5 text-center">
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    <?php echo e(__('app.auth.has_account')); ?>

                    <a href="<?php echo e(route('login')); ?>" class="text-primary font-semibold hover:underline dark:text-aurora-glow"><?php echo e(__('app.auth.login_here')); ?></a>
                </p>
            </div>
        </div>

        <p class="text-center text-white/50 text-xs mt-5">&copy; <?php echo e(date('Y')); ?> <?php echo e(__('app.app_name')); ?> &middot; <?php echo e(__('app.university')); ?></p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\auth\register.blade.php ENDPATH**/ ?>