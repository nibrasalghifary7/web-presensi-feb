
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(__('app.login')); ?> - <?php echo e(__('app.app_name')); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'aurora': { 'bg': '#020817', 'glow': '#5B7FFF', 'glow-tertiary': '#8A7DFF' },
                        'primary': '#2563EB', 'primary-dark': '#1D4ED8', 'primary-light': '#3B82F6',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.add(theme);
        })();
    </script>
    <style>
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-gradient {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 25%, #3B82F6 50%, #1D4ED8 75%, #2563EB 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        html.dark .animated-gradient {
            background: linear-gradient(135deg, #020817 0%, #0A1733 25%, #132A5A 50%, #0A1733 75%, #020817 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        html.dark .login-card {
            background: rgba(10, 18, 40, 0.65);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="h-full animated-gradient pattern-overlay flex items-center justify-center p-4 bg-gray-50 dark:bg-aurora-bg">

    <div class="w-full max-w-md">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-4 dark:bg-aurora-bg/80 dark:border dark:border-white/10">
                <i class="fas fa-graduation-cap text-primary text-4xl dark:text-aurora-glow"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-1"><?php echo e(__('app.app_name')); ?></h1>
            <p class="text-white/80 text-sm"><?php echo e(__('app.app_description')); ?></p>
            <p class="text-white/60 text-xs mt-1"><?php echo e(__('app.faculty')); ?></p>
            <p class="text-white/60 text-xs"><?php echo e(__('app.university')); ?></p>
        </div>

        
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 login-card">
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white"><?php echo e(__('app.auth.login_title')); ?></h2>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1"><?php echo e(__('app.auth.login_subtitle')); ?></p>
            </div>

            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl dark:bg-red-500/10 dark:border-red-500/20 dark:text-red-300">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="text-sm"><?php echo e($errors->first()); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl dark:bg-emerald-500/10 dark:border-emerald-500/20 dark:text-emerald-300">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span class="text-sm"><?php echo e(session('success')); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.post')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">
                        <i class="fas fa-id-card text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.username')); ?>

                    </label>
                    <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>"
                           placeholder="<?php echo e(__('app.auth.username_placeholder')); ?>"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                  focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                  dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow dark:focus:ring-aurora-glow/20
                                  outline-none transition-all text-sm"
                           required autofocus>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1.5">
                        <i class="fas fa-lock text-primary dark:text-aurora-glow mr-1"></i> <?php echo e(__('app.auth.password')); ?>

                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               placeholder="<?php echo e(__('app.auth.password_placeholder')); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800
                                      focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white
                                      dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-aurora-glow dark:focus:ring-aurora-glow/20
                                      outline-none transition-all text-sm pr-12"
                               required>
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-white">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/20 dark:border-white/10 dark:focus:ring-aurora-glow/20">
                        <span class="text-sm text-gray-600 dark:text-slate-400"><?php echo e(__('app.auth.remember_me')); ?></span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-4
                               rounded-xl shadow-lg shadow-primary/20 hover:shadow-xl transition-all duration-300
                               dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary dark:shadow-aurora-glow/20
                               flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span><?php echo e(__('app.login')); ?></span>
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    <?php echo e(__('app.auth.no_account')); ?>

                    <a href="<?php echo e(route('register')); ?>" class="text-primary font-semibold hover:underline dark:text-aurora-glow">
                        <?php echo e(__('app.auth.register_now')); ?>

                    </a>
                </p>
            </div>
        </div>

        <p class="text-center text-white/50 text-xs mt-6">
            &copy; <?php echo e(date('Y')); ?> <?php echo e(__('app.app_name')); ?> &middot; <?php echo e(__('app.university')); ?>

        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\web-presensi-feb\resources\views\auth\login.blade.php ENDPATH**/ ?>