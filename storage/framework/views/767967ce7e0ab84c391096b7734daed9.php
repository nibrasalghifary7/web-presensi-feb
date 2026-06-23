
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - M-Presence FEB</title>

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uin-green': '#25429f',
                        'uin-green-dark': '#1a2f7a',
                        'uin-green-light': '#3d8ade',
                        'uin-gold': '#c8a951',
                        'uin-gold-light': '#e8d48b',
                    }
                }
            }
        }
    </script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="h-full bg-gray-50 font-sans antialiased">

    
    <div class="h-screen flex overflow-hidden" x-data="{ sidebarOpen: false }">

        
        
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden" @click="sidebarOpen = false"></div>

        
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-uin-green to-uin-green-dark text-white transform transition-transform duration-300 lg:translate-x-0 lg:static lg:z-auto flex flex-col h-screen">

            
            <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10 flex-shrink-0">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-uin-green text-xl"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-tight">M-Presence</h1>
                    <p class="text-xs text-white/70">FEB UIN Jakarta</p>
                </div>
            </div>

            
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                
                <?php if(auth()->user()->isMahasiswa()): ?>
                    
                    <a href="<?php echo e(route('mahasiswa.dashboard')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('mahasiswa.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.dashboard')); ?></span>
                    </a>
                    <a href="<?php echo e(route('mahasiswa.absensi')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('mahasiswa.absensi') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-calendar-check w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.absensi')); ?></span>
                    </a>
                    <a href="<?php echo e(route('mahasiswa.riwayat')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('mahasiswa.riwayat') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-clock-rotate-left w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.riwayat')); ?></span>
                    </a>
                    <a href="<?php echo e(route('mahasiswa.dokumen')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('mahasiswa.dokumen') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-file-pen w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.dokumen')); ?></span>
                    </a>
                    <a href="<?php echo e(route('mahasiswa.kehadiran')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('mahasiswa.kehadiran') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-chart-pie w-5 text-center"></i>
                        <span class="text-sm font-medium">Persentase Kehadiran</span>
                    </a>

                <?php elseif(auth()->user()->isDosen()): ?>
                    
                    <a href="<?php echo e(route('dosen.dashboard')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('dosen.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.dashboard')); ?></span>
                    </a>
                    <a href="<?php echo e(route('dosen.pengajuan.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('dosen.pengajuan.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-file-medical w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.pengajuan')); ?></span>
                    </a>

                <?php elseif(auth()->user()->isAdmin()): ?>
                    
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-chart-pie w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.dashboard')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.mahasiswa.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.mahasiswa.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-user-graduate w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.mahasiswa')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.dosen.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.dosen.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.dosen')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.kelas.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.kelas.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.kelas')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.mata-kuliah.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.mata-kuliah.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-book w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.mata_kuliah')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.jadwal.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.jadwal.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.jadwal')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.absensi.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.absensi.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-clipboard-check w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.absensi')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.pengajuan.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.pengajuan.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-file-circle-exclamation w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.pengajuan')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.users.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-user-gear w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.users')); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.laporan.index')); ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.laporan.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white'); ?>">
                        <i class="fas fa-chart-bar w-5 text-center"></i>
                        <span class="text-sm font-medium"><?php echo e(__('app.menu.laporan')); ?></span>
                    </a>
                <?php endif; ?>
            </nav>

            
            <div class="px-3 py-4 border-t border-white/10 flex-shrink-0">
                <p class="text-xs text-white/40 text-center">M-Presence FEB v1.0</p>
            </div>
        </aside>

        
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">

            
            <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3">
                    
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-bars text-gray-600"></i>
                    </button>

                    
                    <h2 class="text-lg font-semibold text-gray-800"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>

                    
                    <div class="flex items-center gap-3">
                        
                        <div class="relative" x-data="{ langOpen: false }">
                            <button @click="langOpen = !langOpen" class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 text-sm hover:bg-gray-50 transition-colors">
                                <i class="fas fa-globe text-gray-500"></i>
                                <span class="text-sm font-medium text-gray-700"><?php echo e(app()->getLocale() === 'id' ? 'ID' : 'EN'); ?></span>
                                <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                            </button>
                            <div x-show="langOpen" @click.away="langOpen = false" x-transition
                                 class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-100 z-50">
                                <a href="<?php echo e(route('language.switch', 'id')); ?>"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-t-xl transition-colors
                                          <?php echo e(app()->getLocale() === 'id' ? 'bg-uin-green/10 text-uin-green font-semibold' : 'text-gray-700 hover:bg-gray-50'); ?>">
                                    <span class="text-lg">🇮🇩</span>
                                    <span>Indonesia</span>
                                    <?php if(app()->getLocale() === 'id'): ?>
                                        <i class="fas fa-check text-uin-green ml-auto"></i>
                                    <?php endif; ?>
                                </a>
                                <a href="<?php echo e(route('language.switch', 'en')); ?>"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-b-xl transition-colors
                                          <?php echo e(app()->getLocale() === 'en' ? 'bg-uin-green/10 text-uin-green font-semibold' : 'text-gray-700 hover:bg-gray-50'); ?>">
                                    <span class="text-lg">🇬🇧</span>
                                    <span>English</span>
                                    <?php if(app()->getLocale() === 'en'): ?>
                                        <i class="fas fa-check text-uin-green ml-auto"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>

                        
                        <div class="relative" x-data="{ userOpen: false }">
                            <button @click="userOpen = !userOpen" class="flex items-center gap-2.5 p-1.5 pr-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="w-9 h-9 bg-uin-green rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-sm font-medium text-gray-700 leading-tight"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-gray-500 capitalize"><?php echo e(auth()->user()->role); ?></p>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 hidden sm:block"></i>
                            </button>
                            <div x-show="userOpen" @click.away="userOpen = false" x-transition
                                 class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 z-50 overflow-hidden">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-800"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e(auth()->user()->email ?? auth()->user()->username); ?></p>
                                </div>
                                <?php if(auth()->user()->isMahasiswa()): ?>
                                <a href="<?php echo e(route('mahasiswa.profil')); ?>"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-user w-4 text-center text-gray-400"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <?php endif; ?>
                                <div class="border-t border-gray-100"></div>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <i class="fas fa-right-from-bracket w-4 text-center"></i>
                                        <span><?php echo e(__('app.logout')); ?></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            
            <main class="flex-1 p-4 sm:p-6">
                
                <?php if(session('success')): ?>
                    <div x-data="{ show: true }" x-show="show" x-transition
                         class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="text-sm"><?php echo e(session('success')); ?></span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>

                
                <?php if(session('error')): ?>
                    <div x-data="{ show: true }" x-show="show" x-transition
                         class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="text-sm"><?php echo e(session('error')); ?></span>
                        </div>
                        <button @click="show = false" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            
            <footer class="px-6 py-4 text-center text-xs text-gray-400 border-t border-gray-100 flex-shrink-0">
                <i class="fas fa-graduation-cap mr-1"></i>
                <?php echo __('app.footer'); ?>

            </footer>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/layouts/app.blade.php ENDPATH**/ ?>