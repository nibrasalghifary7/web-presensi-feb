{{--
    Profil Mahasiswa - Dual Theme
--}}
@extends('layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto">
<<<<<<< HEAD
    <!-- Card Profil -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden">
        <!-- Header biru -->
        <div class="bg-gradient-to-r from-uin-green to-uin-green-light px-6 py-8 text-center">
=======
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden glass">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary to-primary-light px-6 py-8 text-center dark:from-aurora-glow dark:to-aurora-glow-tertiary">
>>>>>>> 60bdeacb79efd4564e6b7d186ebd20de95b30e4d
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-3">
                <span class="text-3xl font-bold text-primary dark:text-aurora-glow">{{ strtoupper(substr($mahasiswa->nama ?? $user->name, 0, 1)) }}</span>
            </div>
            <h2 class="text-2xl font-bold text-white">{{ $mahasiswa->nama ?? $user->name }}</h2>
            <p class="text-white/80 text-sm mt-1">{{ $mahasiswa->nim ?? '-' }}</p>
            <span class="inline-block mt-2 bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                Mahasiswa
            </span>
        </div>

        {{-- Data Profil --}}
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
<<<<<<< HEAD
                <i class="fas fa-id-card text-uin-green mr-2"></i>Data Diri
            </h3>

            <div class="space-y-4">
                <div class="flex items-start gap-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-xl">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-500/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-hashtag text-uin-green"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">NIM</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $mahasiswa->nim ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-xl">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-500/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">Nama Lengkap</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $mahasiswa->nama ?? $user->name }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-xl">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">Email</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $mahasiswa->email ?? $user->email ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-xl">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">Kelas</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $mahasiswa->kelas ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-xl">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-calendar text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">Angkatan</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $mahasiswa->angkatan ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-xl">
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-at text-gray-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">Username</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $user->username }}</p>
                    </div>
                </div>
=======
                <i class="fas fa-id-card text-primary dark:text-aurora-glow mr-2"></i>Data Diri
            </h3>

            <div class="space-y-4">
                @php
                    $profileData = [
                        ['icon' => 'fa-hashtag', 'color' => 'blue', 'label' => 'NIM', 'value' => $mahasiswa->nim ?? '-'],
                        ['icon' => 'fa-user', 'color' => 'blue', 'label' => 'Nama Lengkap', 'value' => $mahasiswa->nama ?? $user->name],
                        ['icon' => 'fa-envelope', 'color' => 'purple', 'label' => 'Email', 'value' => $mahasiswa->email ?? $user->email ?? '-'],
                        ['icon' => 'fa-users', 'color' => 'amber', 'label' => 'Kelas', 'value' => $mahasiswa->kelas ?? '-'],
                        ['icon' => 'fa-calendar', 'color' => 'red', 'label' => 'Angkatan', 'value' => $mahasiswa->angkatan ?? '-'],
                        ['icon' => 'fa-at', 'color' => 'gray', 'label' => 'Username', 'value' => $user->username],
                    ];
                @endphp

                @foreach($profileData as $item)
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl dark:bg-white/5">
                        <div class="w-10 h-10 bg-{{ $item['color'] }}-100 rounded-lg flex items-center justify-center flex-shrink-0
                                    dark:bg-{{ $item['color'] }}-500/10 dark:border dark:border-{{ $item['color'] }}-500/20">
                            <i class="fas {{ $item['icon'] }} text-{{ $item['color'] }}-600 dark:text-{{ $item['color'] }}-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-slate-400 font-semibold uppercase">{{ $item['label'] }}</p>
                            <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $item['value'] }}</p>
                        </div>
                    </div>
                @endforeach
>>>>>>> 60bdeacb79efd4564e6b7d186ebd20de95b30e4d
            </div>

            <div class="mt-6">
                <a href="#"
                   class="w-full flex items-center justify-center gap-2 bg-primary text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all
                          dark:bg-aurora-glow dark:hover:bg-aurora-glow-secondary dark:shadow-aurora-glow/20">
                    <i class="fas fa-key"></i> Ganti Password
                </a>
            </div>

            <p class="text-xs text-gray-400 dark:text-slate-500 text-center mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                Data profil dikelola oleh administrator. Hubungi admin untuk perubahan data.
            </p>
        </div>
    </div>
</div>
@endsection
