<?php

return [

    // ========================================
    // GENERAL
    // ========================================
    'app_name' => 'M-Presence FEB',
    'app_description' => 'Web-Based Attendance Information System',
    'university' => 'UIN Syarif Hidayatullah Jakarta',
    'faculty' => 'Faculty of Economics and Business',

    // ========================================
    // NAVIGATION & MENU
    // ========================================
    'dashboard' => 'Dashboard',
    'logout' => 'Logout',
    'login' => 'Login',
    'register' => 'Register',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'search' => 'Search',
    'filter' => 'Filter',
    'add' => 'Add',
    'print' => 'Print',
    'export_pdf' => 'Export PDF',
    'export_excel' => 'Export Excel',
    'import_csv' => 'Import CSV',
    'download_template' => 'Download Template',
    'back' => 'Back',
    'close' => 'Close',
    'confirm' => 'Confirm',
    'approve' => 'Approve',
    'reject' => 'Reject',

    // ========================================
    // SIDEBAR MENU
    // ========================================
    'menu' => [
        'dashboard' => 'Dashboard',
        'mahasiswa' => 'Students',
        'dosen' => 'Lecturers',
        'mata_kuliah' => 'Courses',
        'jadwal' => 'Schedule',
        'kelas' => 'Classes',
        'absensi' => 'Attendance',
        'pengajuan' => 'Leave Requests',
        'users' => 'User Management',
        'laporan' => 'Reports',
        'riwayat' => 'Attendance History',
        'dokumen' => 'Leave Request',
        'kehadiran' => 'Attendance Percentage',
        'profil' => 'My Profile',
        'ganti_password' => 'Change Password',
    ],

    // ========================================
    // AUTH
    // ========================================
    'auth' => [
        'login_title' => 'Sign In',
        'login_subtitle' => 'Use your NIM/NIP/Username and password',
        'username' => 'NIM / NIP / Username',
        'username_placeholder' => 'Enter NIM, NIP, or Username',
        'password' => 'Password',
        'password_placeholder' => 'Enter your password',
        'remember_me' => 'Remember me',
        'no_account' => "Don't have an account?",
        'has_account' => 'Already have an account?',
        'register_now' => 'Register Now',
        'login_here' => 'Login here',
        'register_title' => 'Student Registration',
        'register_subtitle' => 'Complete your information to register',
        'nim' => 'Student ID (NIM)',
        'nama' => 'Full Name',
        'email' => 'Email',
        'phone' => 'Phone Number',
        'kelas' => 'Class',
        'angkatan' => 'Year',
        'password_confirm' => 'Confirm Password',
    ],

    // ========================================
    // ADMIN
    // ========================================
    'admin' => [
        'dashboard' => 'Admin Dashboard',
        'total_mahasiswa' => 'Total Students',
        'total_dosen' => 'Total Lecturers',
        'total_matkul' => 'Courses',
        'total_jadwal' => 'Class Schedules',
        'absensi_hari_ini' => "Today's Attendance",
        'pengajuan_pending' => 'Pending Requests',
        'quick_access' => 'Quick Access',
        'kelola_mahasiswa' => 'Manage Students',
        'kelola_dosen' => 'Manage Lecturers',

        // Students
        'mahasiswa_title' => 'Student Data',
        'mahasiswa_subtitle' => 'Manage Management Study Program students',
        'mahasiswa_list' => 'Student List',
        'mahasiswa_add' => 'Add Student',
        'mahasiswa_edit' => 'Edit Student',
        'mahasiswa_import' => 'Import Students',
        'mahasiswa_import_desc' => 'Upload CSV file to import student data in bulk',

        // Lecturers
        'dosen_title' => 'Lecturer Data',
        'dosen_subtitle' => 'Manage lecturer data',
        'dosen_list' => 'Lecturer List',
        'dosen_add' => 'Add Lecturer',
        'dosen_edit' => 'Edit Lecturer',

        // Courses
        'matkul_title' => 'Course Data',
        'matkul_subtitle' => 'Manage Management Study Program courses',
        'matkul_list' => 'Course List',
        'matkul_add' => 'Add Course',

        // Schedule
        'jadwal_title' => 'Class Schedule',
        'jadwal_subtitle' => 'Manage class schedules',
        'jadwal_add' => 'Add Schedule',
        'jadwal_edit' => 'Edit Schedule',

        // Classes
        'kelas_title' => 'Class Data',
        'kelas_subtitle' => 'Manage class/group data',
        'kelas_add' => 'Add Class',

        // Attendance
        'absensi_title' => 'Attendance Data',
        'absensi_subtitle' => 'Monitor and correct student attendance data',
        'absensi_koreksi' => 'Correct Attendance',

        // Requests
        'pengajuan_title' => 'Leave / Sick Requests',
        'pengajuan_subtitle' => 'Manage leave and sick requests from students',

        // Users
        'users_title' => 'User Management',
        'users_subtitle' => 'Manage login accounts for all system users',
        'users_add' => 'Add Account',
        'users_edit' => 'Edit Account',
        'users_reset_password' => 'Reset Password',

        // Reports
        'laporan_title' => 'Attendance Report',
        'laporan_subtitle' => 'Student attendance recapitulation',
    ],

    // ========================================
    // LECTURER
    // ========================================
    'dosen' => [
        'dashboard' => 'Lecturer Dashboard',
        'welcome' => 'Welcome',
        'jadwal_hari_ini' => "Today's Teaching Schedule",
        'no_jadwal' => 'No teaching schedule for today',
        'validasi_pending' => 'Pending Validation',
        'buka_sesi' => 'Open Session',
        'tutup_sesi' => 'Close Session',
        'sesi_aktif' => 'Active Session',
        'validasi' => 'Validate',
        'rekap' => 'Recap',
        'validasi_title' => 'Attendance Validation',
        'rekap_title' => 'Attendance Recap',
        'laporan_title' => 'Attendance Report',
        'pengajuan_title' => 'Student Leave Requests',
        'pengajuan_subtitle' => 'Leave and sick requests from students in your classes',
    ],

    // ========================================
    // STUDENT
    // ========================================
    'mahasiswa' => [
        'dashboard' => 'Dashboard Student',
        'total_pertemuan' => 'Total Sessions',
        'hadir' => 'Present',
        'izin_sakit' => 'Leave / Sick',
        'alpha' => 'Absent',
        'persentase' => 'Attendance Percentage',
        'persentase_desc' => 'Exam requirement: minimum 75% attendance',
        'memenuhi_syarat' => 'Meets Requirement',
        'belum_memenuhi' => 'Not Yet Met',
        'jadwal_hari_ini' => "Today's Schedule",
        'no_jadwal' => 'No class schedule for today',
        'absen' => 'Attend',
        'absensi_title' => "Today's Attendance",
        'sudah_absen' => 'Already Attended',
        'belum_absen' => 'Not Yet Attended',
        'sesi_belum_dibuka' => 'Session Not Opened',
        'menunggu_sesi' => 'Waiting for lecturer to open the session',
        'absen_sekarang' => 'Attend Now',
        'riwayat_title' => 'Attendance History',
        'riwayat_subtitle' => 'Attendance Data',
        'dokumen_title' => 'Leave / Sick Request',
        'form_pengajuan' => 'Leave / Sick Request Form',
        'daftar_pengajuan' => 'Request List',
        'rekap_total' => 'TOTAL ATTENDANCE RECAP',
    ],

    // ========================================
    // TABLE
    // ========================================
    'table' => [
        'no' => 'No',
        'nim' => 'NIM',
        'nidn' => 'NIDN',
        'nama' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'kelas' => 'Class',
        'angkatan' => 'Year',
        'prodi' => 'Program',
        'aksi' => 'Actions',
        'kode_mk' => 'Code',
        'nama_mk' => 'Course Name',
        'sks' => 'Credits',
        'semester' => 'Semester',
        'hari' => 'Day',
        'jam' => 'Time',
        'ruang' => 'Room',
        'mata_kuliah' => 'Course',
        'dosen' => 'Lecturer',
        'tanggal' => 'Date',
        'jam_masuk' => 'Check-in Time',
        'status' => 'Status',
        'validasi' => 'Validation',
        'keterangan' => 'Notes',
        'jenis' => 'Type',
        'alasan' => 'Reason',
        'bukti' => 'Evidence',
        'terdaftar' => 'Registered',
        'jumlah_mhs' => 'Students',
        'persen' => '%',
        'total' => 'Total',
    ],

    // ========================================
    // STATUS
    // ========================================
    'status' => [
        'hadir' => 'Present',
        'izin' => 'Leave',
        'sakit' => 'Sick',
        'alpha' => 'Absent',
        'pending' => 'Pending',
        'divalidasi' => 'Validated',
        'ditolak' => 'Rejected',
        'disetujui' => 'Approved',
        'dibuka' => 'Opened',
        'ditutup' => 'Closed',
    ],

    // ========================================
    // MESSAGES
    // ========================================
    'message' => [
        'login_success' => 'Welcome, :name!',
        'logout_success' => 'You have been logged out successfully.',
        'login_failed' => 'NIM/NIP/Username or password is incorrect.',
        'unauthorized' => 'You do not have access to this page.',
        'create_success' => ':item created successfully.',
        'update_success' => ':item updated successfully.',
        'delete_success' => ':item deleted successfully.',
        'import_success' => 'Import completed: :success succeeded, :failed failed.',
        'absensi_success' => 'Attendance recorded successfully! Waiting for lecturer validation.',
        'absensi_duplicate' => 'You have already attended this course today.',
        'absensi_no_sesi' => 'Session has not been opened by the lecturer. You cannot attend yet.',
        'sesi_opened' => 'Session :pertemuan opened successfully. Students can now attend.',
        'sesi_closed' => 'Session :pertemuan closed successfully.',
        'sesi_exists' => 'There is already an active session for this schedule today.',
        'pengajuan_success' => 'Leave/sick request submitted successfully! Waiting for approval.',
        'approve_success' => 'Leave/sick request approved successfully.',
        'reject_success' => 'Leave/sick request rejected successfully.',
        'reset_password_success' => 'Password has been reset to: :password',
        'cannot_delete_self' => 'You cannot delete your own account.',
    ],

    // ========================================
    // VALIDATION
    // ========================================
    'validation' => [
        'required' => 'The :attribute field is required.',
        'email' => 'The :attribute must be a valid email address.',
        'unique' => 'The :attribute has already been taken.',
        'min' => 'The :attribute must be at least :min characters.',
        'max' => 'The :attribute may not be greater than :max characters.',
        'confirmed' => 'The :attribute confirmation does not match.',
        'exists' => 'The selected :attribute is invalid.',
        'date_format' => 'The :attribute does not match the format :format.',
        'after' => 'The :attribute must be a date after :other.',
        'mimes' => 'The :attribute must be a file of type: :mimes.',
        'file_max' => 'The :attribute may not be greater than :max kilobytes.',
    ],

    // ========================================
    // FOOTER
    // ========================================
    'footer' => 'M-Presence FEB &middot; Attendance Information System &middot; Faculty of Economics and Business UIN Syarif Hidayatullah Jakarta',

    // ========================================
    // PAGINATION
    // ========================================
    'pagination' => [
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
        'data' => 'results',
        'previous' => 'Previous',
        'next' => 'Next',
    ],

    // ========================================
    // PLACEHOLDER
    // ========================================
    'placeholder' => [
        'search_nim_nama' => 'Search by NIM or name...',
        'search_nidn_nama' => 'Search by NIDN or name...',
        'search_username' => 'Search by username, name, or email...',
        'search_kelas' => 'Search class name...',
        'all_classes' => 'All Classes',
        'all_matkul' => 'All Courses',
        'all_dosen' => 'All Lecturers',
        'all_status' => 'All Status',
        'all_role' => 'All Roles',
        'all_days' => 'All Days',
        'select_kelas' => '-- Select Class --',
        'select_role' => '-- Select Role --',
        'select_angkatan' => '-- Select Year --',
        'select_matkul' => '-- Select Course --',
    ],

];
