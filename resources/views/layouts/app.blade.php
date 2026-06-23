{{--
    Layout Utama Aplikasi M-Presence FEB
    Template induk yang di-extend oleh semua halaman dashboard.
    Menggunakan Tailwind CSS dengan tema hijau UIN Syarif Hidayatullah.
--}}
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - M-Presence FEB</title>

    {{-- Tailwind CSS CDN --}}
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
                        'uin-gold-light': '#e8d48b',
                    }
                }
            }
        }
    </script>

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="h-full bg-gray-50 font-sans antialiased">

    {{-- Wrapper utama dengan sidebar --}}
    <div class="h-screen flex overflow-hidden" x-data="{ sidebarOpen: false }">

        {{-- ========================================
             SIDEBAR NAVIGASI (FIXED)
             Responsive: hidden di mobile, muncul di desktop
             ======================================== --}}
        {{-- Overlay untuk mobile --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-uin-green to-uin-green-dark text-white transform transition-transform duration-300 lg:translate-x-0 lg:static lg:z-auto flex flex-col h-screen">

            {{-- Logo & Brand --}}
            <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10 flex-shrink-0">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-uin-green text-xl"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-tight">M-Presence</h1>
                    <p class="text-xs text-white/70">FEB UIN Jakarta</p>
                </div>
            </div>

            {{-- Navigasi (Scrollable) --}}
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                {{-- Menu berdasarkan role --}}
                @if(auth()->user()->isMahasiswa())
                    {{-- Menu Mahasiswa --}}
                    <a href="{{ route('mahasiswa.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('mahasiswa.absensi') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('mahasiswa.absensi') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-calendar-check w-5 text-center"></i>
                        <span class="text-sm font-medium">Absensi</span>
                    </a>
                    <a href="{{ route('mahasiswa.riwayat') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('mahasiswa.riwayat') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-clock-rotate-left w-5 text-center"></i>
                        <span class="text-sm font-medium">Riwayat Kehadiran</span>
                    </a>
                    <a href="{{ route('mahasiswa.dokumen') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('mahasiswa.dokumen') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-file-pen w-5 text-center"></i>
                        <span class="text-sm font-medium">Pengajuan Izin</span>
                    </a>

                @elseif(auth()->user()->isDosen())
                    {{-- Menu Dosen --}}
                    <a href="{{ route('dosen.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('dosen.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('dosen.pengajuan.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('dosen.pengajuan.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-file-medical w-5 text-center"></i>
                        <span class="text-sm font-medium">Pengajuan Izin</span>
                    </a>

                @elseif(auth()->user()->isAdmin())
                    {{-- Menu Admin --}}
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-chart-pie w-5 text-center"></i>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.mahasiswa.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-user-graduate w-5 text-center"></i>
                        <span class="text-sm font-medium">Data Mahasiswa</span>
                    </a>
                    <a href="{{ route('admin.dosen.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.dosen.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                        <span class="text-sm font-medium">Data Dosen</span>
                    </a>
                    <a href="{{ route('admin.mata-kuliah.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.mata-kuliah.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-book w-5 text-center"></i>
                        <span class="text-sm font-medium">Mata Kuliah</span>
                    </a>
                    <a href="{{ route('admin.jadwal.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.jadwal.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                        <span class="text-sm font-medium">Jadwal Kuliah</span>
                    </a>
                    <a href="{{ route('admin.kelas.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.kelas.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="text-sm font-medium">Data Kelas</span>
                    </a>
                    <a href="{{ route('admin.absensi.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.absensi.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-clipboard-check w-5 text-center"></i>
                        <span class="text-sm font-medium">Data Absensi</span>
                    </a>
                    <a href="{{ route('admin.pengajuan.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.pengajuan.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-file-circle-exclamation w-5 text-center"></i>
                        <span class="text-sm font-medium">Pengajuan Izin</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.users.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-user-gear w-5 text-center"></i>
                        <span class="text-sm font-medium">Kelola Akun</span>
                    </a>
                    <a href="{{ route('admin.laporan.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all
                              {{ request()->routeIs('admin.laporan.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-chart-bar w-5 text-center"></i>
                        <span class="text-sm font-medium">Laporan</span>
                    </a>
                @endif
            </nav>

            {{-- Tombol Logout di bagian bawah sidebar (Fixed) --}}
            <div class="px-3 py-4 border-t border-white/10 flex-shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-white/80 hover:bg-red-500/20 hover:text-white transition-all">
                        <i class="fas fa-right-from-bracket w-5 text-center"></i>
                        <span class="text-sm font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ========================================
             KONTEN UTAMA (SCROLLABLE)
             ======================================== --}}
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">

            {{-- Header / Topbar --}}
            <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 sm:px-6 py-3">
                    {{-- Tombol hamburger untuk mobile --}}
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-bars text-gray-600"></i>
                    </button>

                    {{-- Judul halaman --}}
                    <h2 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>

                    {{-- Info user di header --}}
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="w-9 h-9 bg-uin-green rounded-full flex items-center justify-center text-white font-bold text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Konten halaman --}}
            <main class="flex-1 p-4 sm:p-6">
                {{-- Notifikasi sukses --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition
                         class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="text-sm">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                {{-- Notifikasi error --}}
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition
                         class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="text-sm">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="px-6 py-4 text-center text-xs text-gray-400 border-t border-gray-100 flex-shrink-0">
                <i class="fas fa-graduation-cap mr-1"></i>
                M-Presence FEB &middot; Sistem Informasi Absensi &middot; Fakultas Ekonomi dan Bisnis UIN Syarif Hidayatullah Jakarta
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
