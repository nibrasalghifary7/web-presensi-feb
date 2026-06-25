
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
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'aurora': {
                            'bg': '#020817',
                            'surface': '#07111F',
                            'deep': '#0A1733',
                            'panel': '#10204D',
                            'elevated': '#132A5A',
                            'glow': '#5B7FFF',
                            'glow-tertiary': '#8A7DFF',
                            'accent': '#4AA8FF',
                        },
                        'uin-green': '#2563EB',
                        'uin-green-dark': '#1D4ED8',
                        'uin-green-light': '#3B82F6',
                        'uin-gold': '#c8a951',
                        'uin-gold-light': '#e8d48b',
                        'primary': '#2563EB',
                        'primary-dark': '#1D4ED8',
                        'primary-light': '#3B82F6',
                    },
                    fontFamily: { 'sans': ['Inter', 'system-ui', 'sans-serif'] },
                }
            }
        }
    </script>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.add(theme);
        })();
    </script>

    <style>
        [x-cloak] { display: none !important; }

        /* ===== DARK THEME GLASS EFFECTS ===== */
        html.dark .glass {
            background: rgba(10, 18, 40, 0.65) !important;
            backdrop-filter: blur(24px) !important;
            -webkit-backdrop-filter: blur(24px) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        html.dark .glass-light {
            background: rgba(14, 24, 48, 0.75) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.06) !important;
        }
        html.dark .glass-elevated {
            background: rgba(16, 32, 77, 0.7) !important;
            backdrop-filter: blur(28px) !important;
            -webkit-backdrop-filter: blur(28px) !important;
            border: 1px solid rgba(120, 140, 255, 0.12) !important;
            box-shadow: 0 8px 32px rgba(91, 127, 255, 0.08) !important;
        }
        html.dark .stat-glow-blue { box-shadow: 0 4px 24px rgba(91, 127, 255, 0.12) !important; }
        html.dark .stat-glow-purple { box-shadow: 0 4px 24px rgba(138, 125, 255, 0.12) !important; }
        html.dark .stat-glow-emerald { box-shadow: 0 4px 24px rgba(16, 185, 129, 0.12) !important; }
        html.dark .stat-glow-amber { box-shadow: 0 4px 24px rgba(245, 158, 11, 0.12) !important; }
        html.dark .stat-glow-cyan { box-shadow: 0 4px 24px rgba(74, 168, 255, 0.12) !important; }
        html.dark .stat-glow-red { box-shadow: 0 4px 24px rgba(239, 68, 68, 0.12) !important; }

        /* Aurora orbs - only visible in dark */
        .aurora-orbs { display: none; }
        html.dark .aurora-orbs { display: block; }

        /* Nav active states */
        html:not(.dark) .nav-active {
            background: rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(37, 99, 235, 0.2);
            color: #2563EB;
        }
        html.dark .nav-active {
            background: rgba(91, 127, 255, 0.12) !important;
            border: 1px solid rgba(91, 127, 255, 0.2) !important;
            color: white !important;
        }

        /* Sidebar tooltip (only when collapsed) */
        .sidebar-tooltip {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            left: calc(100% + 8px);
            top: 50%;
            transform: translateY(-50%);
            padding: 6px 12px;
            background: #1f2937;
            color: white;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            z-index: 100;
            pointer-events: none;
            transition: opacity 0.15s ease, visibility 0.15s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .sidebar-link:hover .sidebar-tooltip {
            visibility: visible;
            opacity: 1;
        }
        html.dark .sidebar-tooltip {
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
        }
        @media (max-width: 1023px) {
            .sidebar-tooltip { display: none !important; }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="h-full font-sans antialiased bg-gray-50 dark:bg-aurora-bg text-gray-800 dark:text-white">

    
    <div class="aurora-orbs fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-aurora-glow/5 rounded-full blur-[200px]"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-aurora-glow-tertiary/5 rounded-full blur-[180px]"></div>
    </div>

    <div class="h-screen flex overflow-hidden relative z-10"
         x-data="{
             sidebarOpen: false,
             sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
             isDesktop: window.innerWidth >= 1024,
             get sidebarWidth() {
                 if (!this.isDesktop) return '256px';
                 return this.sidebarCollapsed ? '80px' : '256px';
             },
             toggleSidebar() {
                 this.sidebarCollapsed = !this.sidebarCollapsed;
                 localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
             },
             init() {
                 window.addEventListener('resize', () => { this.isDesktop = window.innerWidth >= 1024; });
             }
         }">

        
        <div x-show="sidebarOpen" x-transition
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden" @click="sidebarOpen = false"></div>

        
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               :style="{ width: sidebarWidth }"
               class="fixed inset-y-0 left-0 z-50 w-64 transform transition-all duration-300 lg:translate-x-0 lg:static lg:z-auto flex flex-col h-screen
                      bg-white border-r border-gray-200 glass-light">

            
            <div class="flex items-center gap-2.5 px-4 py-4 border-b border-gray-100 dark:border-white/5"
                 :class="sidebarCollapsed ? 'lg:justify-center lg:px-2 lg:gap-0' : ''">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-primary shadow-lg shadow-primary/20 dark:bg-gradient-to-br dark:from-aurora-glow dark:to-aurora-glow-tertiary flex-shrink-0">
                    <i class="fas fa-graduation-cap text-white text-base"></i>
                </div>
                <div x-show="!sidebarCollapsed" x-transition class="hidden lg:block overflow-hidden whitespace-nowrap flex-1 min-w-0">
                    <h1 class="text-sm font-bold leading-tight text-gray-800 dark:text-white"><?php echo e(__('app.app_name')); ?></h1>
                    <p class="text-[10px] text-gray-500 dark:text-slate-400 leading-tight"><?php echo e(__('app.faculty')); ?></p>
                </div>
                <div class="lg:hidden overflow-hidden flex-1 min-w-0">
                    <h1 class="text-sm font-bold leading-tight text-gray-800 dark:text-white"><?php echo e(__('app.app_name')); ?></h1>
                    <p class="text-[10px] text-gray-500 dark:text-slate-400 leading-tight"><?php echo e(__('app.faculty')); ?></p>
                </div>
                
                <button @click="toggleSidebar()"
                        class="hidden lg:flex w-7 h-7 flex-shrink-0 items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:text-slate-500 dark:hover:text-white dark:hover:bg-white/10 transition-all"
                        x-show="!sidebarCollapsed" x-transition>
                    <i class="fas fa-angles-left text-xs"></i>
                </button>
                <button @click="toggleSidebar()"
                        class="hidden lg:flex w-7 h-7 flex-shrink-0 items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:text-slate-500 dark:hover:text-white dark:hover:bg-white/10 transition-all"
                        x-show="sidebarCollapsed" x-cloak x-transition>
                    <i class="fas fa-angles-right text-xs"></i>
                </button>
            </div>

            
            <nav class="flex-1 px-2 py-3 space-y-0.5">
                <?php
                    if(auth()->user()->isMahasiswa()) {
                        $menuItems = [
                            ['route' => 'mahasiswa.dashboard', 'icon' => 'fa-home', 'label' => 'app.menu.dashboard'],
                            ['route' => 'mahasiswa.absensi', 'icon' => 'fa-calendar-check', 'label' => 'app.menu.absensi'],
                            ['route' => 'mahasiswa.riwayat', 'icon' => 'fa-clock-rotate-left', 'label' => 'app.menu.riwayat'],
                            ['route' => 'mahasiswa.riwayat-pengajuan', 'icon' => 'fa-file-circle-check', 'label' => 'Riwayat Pengajuan'],
                        ];
                    } elseif(auth()->user()->isDosen()) {
                        $menuItems = [
                            ['route' => 'dosen.dashboard', 'icon' => 'fa-home', 'label' => 'app.menu.dashboard'],
                            ['route' => 'dosen.pengajuan.index', 'icon' => 'fa-file-medical', 'label' => 'app.menu.pengajuan'],
                        ];
                    } elseif(auth()->user()->isAdmin()) {
                        $menuItems = [
                            ['route' => 'admin.dashboard', 'icon' => 'fa-chart-pie', 'label' => 'app.menu.dashboard'],
                            ['route' => 'admin.mahasiswa.index', 'icon' => 'fa-user-graduate', 'label' => 'app.menu.mahasiswa'],
                            ['route' => 'admin.dosen.index', 'icon' => 'fa-chalkboard-teacher', 'label' => 'app.menu.dosen'],
                            ['route' => 'admin.mata-kuliah.index', 'icon' => 'fa-book', 'label' => 'app.menu.mata_kuliah'],
                            ['route' => 'admin.jadwal.index', 'icon' => 'fa-calendar-alt', 'label' => 'app.menu.jadwal'],
                            ['route' => 'admin.kelas.index', 'icon' => 'fa-users', 'label' => 'app.menu.kelas'],
                            ['route' => 'admin.absensi.index', 'icon' => 'fa-clipboard-check', 'label' => 'app.menu.absensi'],
                            ['route' => 'admin.pengajuan.index', 'icon' => 'fa-file-circle-exclamation', 'label' => 'app.menu.pengajuan'],
                            ['route' => 'admin.users.index', 'icon' => 'fa-user-gear', 'label' => 'app.menu.users'],
                            ['route' => 'admin.presensi.index', 'icon' => 'fa-clipboard-check', 'label' => 'Monitoring Presensi'],
                            ['route' => 'admin.laporan.index', 'icon' => 'fa-chart-bar', 'label' => 'app.menu.laporan'],
                        ];
                    }
                ?>

                <?php $__currentLoopData = $menuItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isActive = request()->routeIs($item['route']); ?>
                    <a href="<?php echo e(route($item['route'])); ?>"
                       class="sidebar-link flex items-center gap-3 px-2.5 py-2 rounded-lg transition-all relative
                              <?php echo e($isActive
                                  ? 'nav-active font-medium'
                                  : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/5'); ?>"
                       :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                        <i class="fas <?php echo e($item['icon']); ?> w-4 text-center flex-shrink-0 text-[13px]"></i>
                        <span class="text-[13px] font-medium whitespace-nowrap" x-show="!sidebarCollapsed" x-transition><?php echo e(__($item['label'])); ?></span>
                        <?php if(!empty($item['badge']) && $item['badge'] > 0): ?>
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center flex-shrink-0"
                                  x-show="!sidebarCollapsed" x-transition>
                                <?php echo e($item['badge'] > 9 ? '9+' : $item['badge']); ?>

                            </span>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center"
                                  x-show="sidebarCollapsed" x-cloak>
                                <?php echo e($item['badge'] > 9 ? '9+' : $item['badge']); ?>

                            </span>
                        <?php endif; ?>
                        <span class="sidebar-tooltip" x-show="sidebarCollapsed" x-cloak><?php echo e(__($item['label'])); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        </aside>

        
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto relative z-10">

            
            <header class="sticky top-0 z-30 bg-white shadow-sm border-b border-gray-100 glass">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5">
                        <i class="fas fa-bars text-gray-600 dark:text-slate-400"></i>
                    </button>

                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>

                    <div class="flex items-center gap-3">
                        
                        <button onclick="toggleTheme()"
                                class="w-9 h-9 rounded-lg flex items-center justify-center transition-all
                                       bg-gray-100 text-gray-600 hover:bg-gray-200
                                       dark:bg-white/10 dark:text-yellow-400 dark:hover:bg-white/15">
                            <i class="fas fa-moon text-sm dark:hidden"></i>
                            <i class="fas fa-sun text-sm hidden dark:inline"></i>
                        </button>

                        
                        <div class="relative" x-data="{ langOpen: false }">
                            <button @click="langOpen = !langOpen"
                                    class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 text-sm hover:bg-gray-50 transition-colors dark:border-white/10 dark:hover:bg-white/5">
                                <i class="fas fa-globe text-gray-500 dark:text-aurora-glow"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-white"><?php echo e(app()->getLocale() === 'id' ? 'ID' : 'EN'); ?></span>
                            </button>
                            <div x-show="langOpen" @click.away="langOpen = false" x-transition
                                 class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-100 z-50 dark:bg-aurora-elevated dark:border-white/10">
                                <a href="<?php echo e(route('language.switch', 'id')); ?>"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-t-xl transition-colors
                                          <?php echo e(app()->getLocale() === 'id' ? 'bg-primary/10 text-primary font-semibold dark:bg-aurora-glow/10 dark:text-aurora-glow' : 'text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-white/5'); ?>">
                                    <span class="text-sm">ID</span> Indonesia
                                    <?php if(app()->getLocale() === 'id'): ?><i class="fas fa-check ml-auto text-primary dark:text-aurora-glow"></i><?php endif; ?>
                                </a>
                                <a href="<?php echo e(route('language.switch', 'en')); ?>"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-b-xl transition-colors
                                          <?php echo e(app()->getLocale() === 'en' ? 'bg-primary/10 text-primary font-semibold dark:bg-aurora-glow/10 dark:text-aurora-glow' : 'text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-white/5'); ?>">
                                    <span class="text-sm">EN</span> English
                                    <?php if(app()->getLocale() === 'en'): ?><i class="fas fa-check ml-auto text-primary dark:text-aurora-glow"></i><?php endif; ?>
                                </a>
                            </div>
                        </div>

                        
                        <div class="relative" x-data="{ userOpen: false }">
                            <button @click="userOpen = !userOpen" class="flex items-center gap-2.5 p-1.5 pr-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-sm bg-primary shadow-lg shadow-primary/20 dark:bg-gradient-to-br dark:from-aurora-glow dark:to-aurora-glow-tertiary">
                                    <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-sm font-medium text-gray-700 dark:text-white leading-tight"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-gray-500 dark:text-slate-400 capitalize"><?php echo e(auth()->user()->role); ?></p>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400 dark:text-slate-500 hidden sm:block"></i>
                            </button>
                            <div x-show="userOpen" @click.away="userOpen = false" x-transition
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 z-50 dark:bg-aurora-elevated dark:border-white/10">
                                <div class="px-4 py-3 border-b border-gray-100 dark:border-white/5">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-gray-500 dark:text-slate-400"><?php echo e(auth()->user()->email); ?></p>
                                </div>
                                <?php if(auth()->user()->isMahasiswa()): ?>
                                    <a href="<?php echo e(route('mahasiswa.profil')); ?>"
                                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-white/5 transition-colors">
                                        <i class="fas fa-user w-4"></i>
                                        <span>Profil Saya</span>
                                    </a>
                                <?php elseif(auth()->user()->isDosen()): ?>
                                    <a href="<?php echo e(route('dosen.profil')); ?>"
                                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-white/5 transition-colors">
                                        <i class="fas fa-user w-4"></i>
                                        <span>Profil Saya</span>
                                    </a>
                                <?php endif; ?>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10 transition-colors rounded-b-xl">
                                        <i class="fas fa-right-from-bracket w-4"></i>
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
                         class="mb-4 rounded-xl px-4 py-3 flex items-center justify-between
                                bg-emerald-50 border border-emerald-200 text-emerald-700
                                dark:bg-emerald-500/15 dark:border-emerald-500/30 dark:text-emerald-300">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500 dark:text-emerald-400"></i>
                            <span class="text-sm font-medium"><?php echo e(session('success')); ?></span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 dark:text-emerald-400 hover:opacity-70"><i class="fas fa-times"></i></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div x-data="{ show: true }" x-show="show" x-transition
                         class="mb-4 rounded-xl px-4 py-3 flex items-center justify-between
                                bg-red-50 border border-red-200 text-red-700
                                dark:bg-red-500/15 dark:border-red-500/30 dark:text-red-300">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                            <span class="text-sm font-medium"><?php echo e(session('error')); ?></span>
                        </div>
                        <button @click="show = false" class="text-red-500 dark:text-red-400 hover:opacity-70"><i class="fas fa-times"></i></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            
            <footer class="px-6 py-4 text-center text-xs text-gray-400 border-t border-gray-100 dark:text-slate-500 dark:border-white/5 flex-shrink-0">
                <i class="fas fa-graduation-cap mr-1"></i>
                <?php echo __('app.footer'); ?>

            </footer>
        </div>
    </div>

    
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                html.classList.add('light');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.remove('light');
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views/layouts/app.blade.php ENDPATH**/ ?>