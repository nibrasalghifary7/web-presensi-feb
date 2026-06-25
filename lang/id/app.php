<?php

return [

    // ========================================
    // UMUM
    // ========================================
    'app_name' => 'M-Presence FEB',
    'app_description' => 'Sistem Informasi Absensi Berbasis Web',
    'university' => 'UIN Syarif Hidayatullah Jakarta',
    'faculty' => 'Fakultas Ekonomi dan Bisnis',

    // ========================================
    // NAVIGASI & MENU
    // ========================================
    'dashboard' => 'Dashboard',
    'logout' => 'Keluar',
    'login' => 'Masuk',
    'register' => 'Daftar',
    'save' => 'Simpan',
    'cancel' => 'Batal',
    'edit' => 'Edit',
    'delete' => 'Hapus',
    'search' => 'Cari',
    'filter' => 'Filter',
    'add' => 'Tambah',
    'print' => 'Cetak',
    'export_pdf' => 'Export PDF',
    'export_excel' => 'Export Excel',
    'import_csv' => 'Import CSV',
    'download_template' => 'Download Template',
    'back' => 'Kembali',
    'close' => 'Tutup',
    'confirm' => 'Konfirmasi',
    'approve' => 'Setujui',
    'reject' => 'Tolak',

    // ========================================
    // MENU SIDEBAR
    // ========================================
    'menu' => [
        'dashboard' => 'Beranda',
        'mahasiswa' => 'Data Mahasiswa',
        'dosen' => 'Data Dosen',
        'mata_kuliah' => 'Mata Kuliah',
        'jadwal' => 'Jadwal Kuliah',
        'kelas' => 'Data Kelas',
        'absensi' => 'Data Absensi',
        'pengajuan' => 'Pengajuan Izin',
        'users' => 'Kelola Akun',
        'laporan' => 'Laporan',
        'riwayat' => 'Riwayat Kehadiran',
        'dokumen' => 'Pengajuan Izin',
        'kehadiran' => 'Persentase Kehadiran',
        'profil' => 'Profil Saya',
        'ganti_password' => 'Ganti Password',
    ],

    // ========================================
    // AUTH
    // ========================================
    'auth' => [
        'login_title' => 'Masuk ke Akun',
        'login_subtitle' => 'Gunakan NIM/NIDN/Username dan password Anda',
        'username' => 'NIM / NIDN / Username',
        'username_placeholder' => 'Masukkan NIM, NIDN, atau Username',
        'password' => 'Password',
        'password_placeholder' => 'Masukkan password Anda',
        'remember_me' => 'Ingat saya',
        'no_account' => 'Belum punya akun?',
        'has_account' => 'Sudah punya akun?',
        'register_now' => 'Daftar Sekarang',
        'login_here' => 'Masuk di sini',
        'register_title' => 'Daftar Akun Mahasiswa',
        'register_subtitle' => 'Lengkapi data diri Anda untuk mendaftar',
        'nim' => 'NIM',
        'nama' => 'Nama Lengkap',
        'email' => 'Email',
        'phone' => 'Nomor HP',
        'kelas' => 'Kelas',
        'angkatan' => 'Angkatan',
        'password_confirm' => 'Konfirmasi Password',
    ],

    // ========================================
    // ADMIN
    // ========================================
    'admin' => [
        'dashboard' => 'Beranda Admin',
        'total_mahasiswa' => 'Total Mahasiswa',
        'total_dosen' => 'Total Dosen',
        'total_matkul' => 'Mata Kuliah',
        'total_jadwal' => 'Jadwal Kuliah',
        'absensi_hari_ini' => 'Absensi Hari Ini',
        'pengajuan_pending' => 'Pengajuan Pending',
        'quick_access' => 'Akses Cepat',
        'kelola_mahasiswa' => 'Kelola Mahasiswa',
        'kelola_dosen' => 'Kelola Dosen',

        // Mahasiswa
        'mahasiswa_title' => 'Data Mahasiswa',
        'mahasiswa_subtitle' => 'Kelola data mahasiswa Program Studi Manajemen',
        'mahasiswa_list' => 'Daftar Mahasiswa',
        'mahasiswa_add' => 'Tambah Mahasiswa',
        'mahasiswa_edit' => 'Edit Data Mahasiswa',
        'mahasiswa_import' => 'Import Data Mahasiswa',
        'mahasiswa_import_desc' => 'Upload file CSV untuk import data mahasiswa secara bulk',

        // Dosen
        'dosen_title' => 'Data Dosen',
        'dosen_subtitle' => 'Kelola data dosen pengajar',
        'dosen_list' => 'Daftar Dosen',
        'dosen_add' => 'Tambah Dosen',
        'dosen_edit' => 'Edit Data Dosen',

        // Mata Kuliah
        'matkul_title' => 'Data Mata Kuliah',
        'matkul_subtitle' => 'Kelola data mata kuliah Program Studi Manajemen',
        'matkul_list' => 'Daftar Mata Kuliah',
        'matkul_add' => 'Tambah Mata Kuliah',

        // Jadwal
        'jadwal_title' => 'Jadwal Kuliah',
        'jadwal_subtitle' => 'Kelola jadwal perkuliahan',
        'jadwal_add' => 'Tambah Jadwal',
        'jadwal_edit' => 'Edit Jadwal Kuliah',

        // Kelas
        'kelas_title' => 'Data Kelas',
        'kelas_subtitle' => 'Kelola data kelas/rombongan belajar',
        'kelas_add' => 'Tambah Kelas',

        // Absensi
        'absensi_title' => 'Data Absensi',
        'absensi_subtitle' => 'Pantau dan koreksi data kehadiran mahasiswa',
        'absensi_koreksi' => 'Koreksi Absensi',

        // Pengajuan
        'pengajuan_title' => 'Pengajuan Izin / Sakit',
        'pengajuan_subtitle' => 'Kelola pengajuan izin dan sakit dari mahasiswa',

        // Users
        'users_title' => 'Kelola Akun Pengguna',
        'users_subtitle' => 'Kelola akun login semua pengguna sistem',
        'users_add' => 'Tambah Akun',
        'users_edit' => 'Edit Akun',
        'users_reset_password' => 'Reset Password',

        // Laporan
        'laporan_title' => 'Laporan Absensi',
        'laporan_subtitle' => 'Rekapitulasi kehadiran mahasiswa',
    ],

    // ========================================
    // DOSEN
    // ========================================
    'dosen' => [
        'dashboard' => 'Beranda Dosen',
        'welcome' => 'Selamat Datang',
        'jadwal_hari_ini' => 'Jadwal Mengajar Hari Ini',
        'no_jadwal' => 'Tidak ada jadwal mengajar hari ini',
        'validasi_pending' => 'Menunggu Validasi',
        'buka_sesi' => 'Buka Sesi',
        'tutup_sesi' => 'Tutup Sesi',
        'sesi_aktif' => 'Sesi Aktif',
        'validasi' => 'Validasi',
        'rekap' => 'Rekap',
        'validasi_title' => 'Validasi Absensi',
        'rekap_title' => 'Rekap Kehadiran',
        'laporan_title' => 'Laporan Kehadiran',
        'pengajuan_title' => 'Pengajuan Izin Mahasiswa',
        'pengajuan_subtitle' => 'Pengajuan izin dan sakit dari mahasiswa di kelas yang Anda ajar',
    ],

    // ========================================
    // MAHASISWA
    // ========================================
    'mahasiswa' => [
        'dashboard' => 'Beranda Mahasiswa',
        'total_pertemuan' => 'Total Pertemuan',
        'hadir' => 'Hadir',
        'izin_sakit' => 'Izin / Sakit',
        'alpha' => 'Alpha',
        'persentase' => 'Persentase Kehadiran',
        'persentase_desc' => 'Syarat mengikuti ujian: minimal 75% kehadiran',
        'memenuhi_syarat' => 'Memenuhi Syarat',
        'belum_memenuhi' => 'Belum Memenuhi',
        'jadwal_hari_ini' => 'Jadwal Hari Ini',
        'no_jadwal' => 'Tidak ada jadwal kuliah hari ini',
        'absen' => 'Absen',
        'absensi_title' => 'Absensi Hari Ini',
        'sudah_absen' => 'Sudah Absen',
        'belum_absen' => 'Belum Absen',
        'sesi_belum_dibuka' => 'Sesi Belum Dibuka',
        'menunggu_sesi' => 'Menunggu dosen membuka sesi pertemuan',
        'absen_sekarang' => 'Absen Sekarang',
        'riwayat_title' => 'Riwayat Kehadiran',
        'riwayat_subtitle' => 'Data Kehadiran',
        'dokumen_title' => 'Pengajuan Izin / Sakit',
        'form_pengajuan' => 'Form Pengajuan Izin / Sakit',
        'daftar_pengajuan' => 'Daftar Pengajuan',
        'rekap_total' => 'REKAP TOTAL KEHADIRAN',
    ],

    // ========================================
    // TABEL
    // ========================================
    'table' => [
        'no' => 'No',
        'nim' => 'NIM',
        'nidn' => 'NIDN',
        'nama' => 'Nama',
        'email' => 'Email',
        'phone' => 'No. HP',
        'kelas' => 'Kelas',
        'angkatan' => 'Angkatan',
        'prodi' => 'Prodi',
        'aksi' => 'Aksi',
        'kode_mk' => 'Kode',
        'nama_mk' => 'Nama Mata Kuliah',
        'sks' => 'SKS',
        'semester' => 'Semester',
        'hari' => 'Hari',
        'jam' => 'Jam',
        'ruang' => 'Ruang',
        'mata_kuliah' => 'Mata Kuliah',
        'dosen' => 'Dosen',
        'tanggal' => 'Tanggal',
        'jam_masuk' => 'Jam Masuk',
        'status' => 'Status',
        'validasi' => 'Validasi',
        'keterangan' => 'Keterangan',
        'jenis' => 'Jenis',
        'alasan' => 'Alasan',
        'bukti' => 'Bukti',
        'terdaftar' => 'Terdaftar',
        'jumlah_mhs' => 'Jumlah Mhs',
        'persen' => '%',
        'total' => 'Total',
    ],

    // ========================================
    // STATUS
    // ========================================
    'status' => [
        'hadir' => 'Hadir',
        'izin' => 'Izin',
        'sakit' => 'Sakit',
        'alpha' => 'Alpha',
        'pending' => 'Pending',
        'divalidasi' => 'Divalidasi',
        'ditolak' => 'Ditolak',
        'disetujui' => 'Disetujui',
        'dibuka' => 'Dibuka',
        'ditutup' => 'Ditutup',
    ],

    // ========================================
    // PESAN
    // ========================================
    'message' => [
        'login_success' => 'Selamat datang, :name!',
        'logout_success' => 'Anda telah berhasil logout.',
        'login_failed' => 'NIM/NIDN/Username atau password salah.',
        'unauthorized' => 'Anda tidak memiliki akses ke halaman ini.',
        'create_success' => ':item berhasil ditambahkan.',
        'update_success' => ':item berhasil diupdate.',
        'delete_success' => ':item berhasil dihapus.',
        'import_success' => 'Import selesai: :success berhasil, :failed gagal.',
        'absensi_success' => 'Absensi berhasil dicatat! Menunggu validasi dari dosen.',
        'absensi_duplicate' => 'Anda sudah melakukan absensi untuk mata kuliah ini hari ini.',
        'absensi_no_sesi' => 'Sesi pertemuan belum dibuka oleh dosen. Anda belum bisa melakukan absensi.',
        'sesi_opened' => 'Sesi pertemuan ke-:pertemuan berhasil dibuka. Mahasiswa sudah bisa melakukan absensi.',
        'sesi_closed' => 'Sesi pertemuan ke-:pertemuan berhasil ditutup.',
        'sesi_exists' => 'Sudah ada sesi aktif untuk jadwal ini hari ini.',
        'pengajuan_success' => 'Pengajuan izin/sakit berhasil dikirim! Menunggu persetujuan.',
        'approve_success' => 'Pengajuan izin/sakit berhasil disetujui.',
        'reject_success' => 'Pengajuan izin/sakit berhasil ditolak.',
        'reset_password_success' => 'Password berhasil direset ke: :password',
        'cannot_delete_self' => 'Tidak bisa menghapus akun sendiri.',
    ],

    // ========================================
    // VALIDASI
    // ========================================
    'validation' => [
        'required' => ':attribute wajib diisi.',
        'email' => 'Format email tidak valid.',
        'unique' => ':attribute sudah terdaftar.',
        'min' => ':attribute minimal :min karakter.',
        'max' => ':attribute maksimal :max karakter.',
        'confirmed' => 'Konfirmasi :attribute tidak cocok.',
        'exists' => ':attribute tidak valid.',
        'date_format' => 'Format :attribute tidak valid.',
        'after' => ':attribute harus setelah :other.',
        'mimes' => 'Format file harus :mimes.',
        'file_max' => 'Ukuran file maksimal :max KB.',
    ],

    // ========================================
    // FOOTER
    // ========================================
    'footer' => 'M-Presence FEB &middot; Sistem Informasi Absensi &middot; Fakultas Ekonomi dan Bisnis UIN Syarif Hidayatullah Jakarta',

    // ========================================
    // PAGINATION
    // ========================================
    'pagination' => [
        'showing' => 'Menampilkan',
        'to' => 'sampai',
        'of' => 'dari',
        'data' => 'data',
        'previous' => 'Sebelumnya',
        'next' => 'Selanjutnya',
    ],

    // ========================================
    // PLACEHOLDER
    // ========================================
    'placeholder' => [
        'search_nim_nama' => 'Cari NIM atau nama...',
        'search_nidn_nama' => 'Cari NIDN atau nama...',
        'search_username' => 'Cari username, nama, atau email...',
        'search_kelas' => 'Cari nama kelas...',
        'all_classes' => 'Semua Kelas',
        'all_matkul' => 'Semua Mata Kuliah',
        'all_dosen' => 'Semua Dosen',
        'all_status' => 'Semua Status',
        'all_role' => 'Semua Role',
        'all_days' => 'Semua Hari',
        'select_kelas' => '-- Pilih Kelas --',
        'select_role' => '-- Pilih Role --',
        'select_angkatan' => '-- Pilih Angkatan --',
        'select_matkul' => '-- Pilih Mata Kuliah --',
    ],

];
