
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - M-Presence FEB UIN Jakarta</title>

    
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
        /* Animasi gradient bergerak untuk background */
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
        /* Pattern overlay untuk background */
        .pattern-overlay {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="h-full animated-gradient pattern-overlay flex items-center justify-center p-4">

    
    <div class="w-full max-w-md">

        
        <div class="text-center mb-8">
            
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-4">
                <i class="fas fa-graduation-cap text-uin-green text-4xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-1">M-Presence FEB</h1>
            <p class="text-white/80 text-sm">Sistem Informasi Absensi Berbasis Web</p>
            <p class="text-white/60 text-xs mt-1">Fakultas Ekonomi dan Bisnis</p>
            <p class="text-white/60 text-xs">UIN Syarif Hidayatullah Jakarta</p>
        </div>

        
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Masuk ke Akun</h2>
                <p class="text-sm text-gray-500 mt-1">Gunakan NIM/NIP dan password Anda</p>
            </div>

            
            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="text-sm"><?php echo e($errors->first()); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if(session('success')): ?>
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span class="text-sm"><?php echo e(session('success')); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.post')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>

                
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-id-card text-uin-green mr-1"></i> NIM / NIP
                    </label>
                    <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>"
                           placeholder="Masukkan NIM atau NIP Anda"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                                  focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                  outline-none transition-all text-sm"
                           required autofocus>
                </div>

                
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-lock text-uin-green mr-1"></i> Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               placeholder="Masukkan password Anda"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                                      focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                      outline-none transition-all text-sm pr-12"
                               required>
                        
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                
                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-user-tag text-uin-green mr-1"></i> Masuk Sebagai
                    </label>
                    <select id="role" name="role"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                                   focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                   outline-none transition-all text-sm appearance-none cursor-pointer"
                            required>
                        <option value="">-- Pilih Role --</option>
                        <option value="mahasiswa" <?php echo e(old('role') == 'mahasiswa' ? 'selected' : ''); ?>>
                            Mahasiswa
                        </option>
                        <option value="dosen" <?php echo e(old('role') == 'dosen' ? 'selected' : ''); ?>>
                            Dosen
                        </option>
                        <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>
                            Admin
                        </option>
                    </select>
                </div>

                
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-uin-green focus:ring-uin-green/20">
                        <span class="text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                
                <button type="submit"
                        class="w-full bg-uin-green hover:bg-uin-green-dark text-white font-bold py-3 px-4
                               rounded-xl shadow-lg hover:shadow-xl transition-all duration-300
                               flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk</span>
                </button>
            </form>

            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    Belum punya akun?
                    <a href="<?php echo e(route('register')); ?>" class="text-uin-green font-semibold hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>

        
        <p class="text-center text-white/50 text-xs mt-6">
            &copy; <?php echo e(date('Y')); ?> M-Presence FEB &middot; UIN Syarif Hidayatullah Jakarta
        </p>
    </div>

    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
<?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/auth/login.blade.php ENDPATH**/ ?>