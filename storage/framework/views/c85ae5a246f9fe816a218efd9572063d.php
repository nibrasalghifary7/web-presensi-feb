
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Registrasi Mahasiswa - M-Presence FEB UIN Jakarta</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uin-green': '#006633',
                        'uin-green-dark': '#004d26',
                        'uin-green-light': '#008844',
                        'uin-gold': '#c8a951',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-gradient {
            background: linear-gradient(135deg, #006633 0%, #004d26 25%, #008844 50%, #004d26 75%, #006633 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        .pattern-overlay {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="h-full animated-gradient pattern-overlay flex items-center justify-center p-4 py-8">

    
    <div class="w-full max-w-md">

        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-lg mb-3">
                <i class="fas fa-user-plus text-uin-green text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-1">Daftar Akun Mahasiswa</h1>
            <p class="text-white/70 text-sm">M-Presence FEB &middot; UIN Syarif Hidayatullah Jakarta</p>
        </div>

        
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
            <div class="text-center mb-5">
                <h2 class="text-lg font-bold text-gray-800">Buat Akun Baru</h2>
                <p class="text-xs text-gray-500 mt-1">Lengkapi data diri Anda untuk mendaftar</p>
            </div>

            
            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="text-sm space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-exclamation-circle mt-0.5"></i>
                                <span><?php echo e($error); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('register.post')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>

                
                <div>
                    <label for="nim" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-id-card text-uin-green mr-1"></i> NIM
                    </label>
                    <input type="text" id="nim" name="nim" value="<?php echo e(old('nim')); ?>"
                           placeholder="Contoh: 12408011010024"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                  focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                  outline-none transition-all text-sm"
                           required>
                </div>

                
                <div>
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-user text-uin-green mr-1"></i> Nama Lengkap
                    </label>
                    <input type="text" id="nama" name="nama" value="<?php echo e(old('nama')); ?>"
                           placeholder="Masukkan nama lengkap"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                  focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                  outline-none transition-all text-sm"
                           required>
                </div>

                
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-envelope text-uin-green mr-1"></i> Email
                    </label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>"
                           placeholder="contoh@email.com"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                  focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                  outline-none transition-all text-sm"
                           required>
                </div>

                
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-phone text-uin-green mr-1"></i> Nomor HP
                    </label>
                    <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>"
                           placeholder="08xxxxxxxxxx"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                  focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                  outline-none transition-all text-sm"
                           required>
                </div>

                
                <div>
                    <label for="kelas" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-users text-uin-green mr-1"></i> Kelas
                    </label>
                    <select id="kelas" name="kelas"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                   focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                   outline-none transition-all text-sm appearance-none"
                            required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="Manajemen A" <?php echo e(old('kelas') == 'Manajemen A' ? 'selected' : ''); ?>>Manajemen A</option>
                        <option value="Manajemen B" <?php echo e(old('kelas') == 'Manajemen B' ? 'selected' : ''); ?>>Manajemen B</option>
                        <option value="Manajemen C" <?php echo e(old('kelas') == 'Manajemen C' ? 'selected' : ''); ?>>Manajemen C</option>
                        <option value="Akuntansi A" <?php echo e(old('kelas') == 'Akuntansi A' ? 'selected' : ''); ?>>Akuntansi A</option>
                        <option value="Akuntansi B" <?php echo e(old('kelas') == 'Akuntansi B' ? 'selected' : ''); ?>>Akuntansi B</option>
                    </select>
                </div>

                
                <div>
                    <label for="angkatan" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-calendar text-uin-green mr-1"></i> Angkatan
                    </label>
                    <select id="angkatan" name="angkatan"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                   focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                   outline-none transition-all text-sm appearance-none"
                            required>
                        <option value="">-- Pilih Angkatan --</option>
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?php echo e($y); ?>" <?php echo e(old('angkatan') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-lock text-uin-green mr-1"></i> Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               placeholder="Minimal 6 karakter"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                      focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                      outline-none transition-all text-sm pr-12"
                               required>
                        <button type="button" onclick="togglePassword('password', 'eye-icon-1')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eye-icon-1" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-lock text-uin-green mr-1"></i> Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Ulangi password"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                      focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                      outline-none transition-all text-sm pr-12"
                               required>
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eye-icon-2" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                
                <button type="submit"
                        class="w-full bg-uin-green hover:bg-uin-green-dark text-white font-bold py-3 px-4
                               rounded-xl shadow-lg hover:shadow-xl transition-all duration-300
                               flex items-center justify-center gap-2 mt-2">
                    <i class="fas fa-user-plus"></i>
                    <span>Daftar Sekarang</span>
                </button>
            </form>

            
            <div class="mt-5 text-center">
                <p class="text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="<?php echo e(route('login')); ?>" class="text-uin-green font-semibold hover:underline">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        
        <p class="text-center text-white/50 text-xs mt-5">
            &copy; <?php echo e(date('Y')); ?> M-Presence FEB &middot; UIN Syarif Hidayatullah Jakarta
        </p>
    </div>

    
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

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
<?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/auth/register.blade.php ENDPATH**/ ?>