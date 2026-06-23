# M-Presence FEB - Sistem Informasi Absensi Berbasis Web

**Fakultas Ekonomi dan Bisnis - UIN Syarif Hidayatullah Jakarta**

Sistem informasi absensi berbasis web untuk Program Studi Manajemen yang memungkinkan pencatatan kehadiran mahasiswa secara digital dengan tiga role pengguna: Admin, Dosen, dan Mahasiswa.

---

## Struktur Folder Proyek

```
web-presensi-feb/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Controller.php            # Controller base
│   │   │   ├── AuthController.php        # Login, Registrasi, Logout
│   │   │   ├── MahasiswaController.php   # Dashboard, Absensi, Riwayat, Izin
│   │   │   ├── DosenController.php       # Dashboard, Validasi, Rekap, Laporan
│   │   │   └── AdminController.php       # Dashboard, CRUD semua master data
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php          # Redirect jika belum login
│   │   │   ├── CheckRole.php             # Middleware multi-role (admin/dosen/mahasiswa)
│   │   │   ├── RedirectIfAuthenticated.php # Redirect jika sudah login
│   │   │   └── Kernel.php                # Registrasi semua middleware
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── User.php                      # Model autentikasi multi-role
│   │   ├── Mahasiswa.php                 # Profil mahasiswa + statistik kehadiran
│   │   ├── Dosen.php                     # Profil dosen pengajar
│   │   ├── MataKuliah.php                # Data mata kuliah
│   │   ├── Jadwal.php                    # Jadwal perkuliahan
│   │   ├── Absensi.php                   # Data kehadiran mahasiswa
│   │   ├── PengajuanIzin.php             # Pengajuan izin/sakit
│   │   └── Sesi.php                      # Sesi pertemuan (placeholder QR)
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/
│   └── app.php
├── config/
│   ├── app.php                           # Konfigurasi utama (timezone: Asia/Jakarta)
│   ├── auth.php                          # Konfigurasi autentikasi
│   └── database.php                      # Konfigurasi database MySQL
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_mahasiswas_table.php
│   │   ├── 2024_01_01_000002_create_dosens_table.php
│   │   ├── 2024_01_01_000003_create_mata_kuliahs_table.php
│   │   ├── 2024_01_01_000004_create_jadwals_table.php
│   │   ├── 2024_01_01_000005_create_absensis_table.php
│   │   ├── 2024_01_01_000006_create_pengajuan_izins_table.php
│   │   └── 2024_01_01_000007_create_sesis_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php                # Data dummy: 1 admin, 3 dosen, 10 mahasiswa
│       ├── MataKuliahSeeder.php          # 10 mata kuliah
│       ├── JadwalSeeder.php              # 8 jadwal kuliah
│       └── AbsensiSeeder.php             # Data absensi dummy
├── public/
│   ├── index.php                         # Entry point aplikasi
│   ├── css/
│   ├── js/
│   ├── images/
│   └── uploads/izin/                     # Upload bukti surat izin/sakit
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php                 # Layout utama (sidebar + header + content)
│   ├── auth/
│   │   ├── login.blade.php               # Halaman Login (center card, hijau UIN)
│   │   └── register.blade.php            # Halaman Registrasi mahasiswa
│   ├── mahasiswa/
│   │   ├── dashboard.blade.php           # Dashboard: statistik + jadwal hari ini
│   │   ├── absensi.blade.php             # Absensi: klik kehadiran per jadwal
│   │   ├── riwayat.blade.php             # Tabel riwayat kehadiran
│   │   └── dokumen.blade.php             # Form pengajuan izin/sakit
│   ├── dosen/
│   │   ├── dashboard.blade.php           # Dashboard: jadwal mengajar hari ini
│   │   ├── validasi.blade.php            # Validasi absensi mahasiswa
│   │   ├── rekap.blade.php               # Rekap kehadiran per mata kuliah
│   │   └── laporan.blade.php             # Cetak laporan kehadiran
│   └── admin/
│       ├── dashboard.blade.php           # Statistik global
│       ├── mahasiswa/
│       │   ├── index.blade.php           # Tabel CRUD mahasiswa
│       │   ├── create.blade.php          # Form tambah mahasiswa
│       │   └── edit.blade.php            # Form edit mahasiswa
│       ├── dosen/
│       │   ├── index.blade.php           # Tabel CRUD dosen
│       │   ├── create.blade.php          # Form tambah dosen
│       │   └── edit.blade.php            # Form edit dosen
│       ├── mata-kuliah/
│       │   └── index.blade.php           # CRUD mata kuliah + modal tambah
│       └── jadwal/
│           └── index.blade.php           # Manajemen jadwal + modal tambah
├── routes/
│   ├── web.php                           # Routing utama (publik + 3 role)
│   ├── api.php                           # API routes (placeholder)
│   └── console.php
├── .env                                  # Environment variables
├── composer.json                         # Dependencies Laravel 10
├── artisan                               # CLI Laravel
└── README.md                             # Dokumentasi ini
```

---

## Desain Database (ERD)

```
┌─────────────┐     ┌──────────────┐     ┌──────────────┐
│    users     │     │  mahasiswas  │     │    dosens     │
├─────────────┤     ├──────────────┤     ├──────────────┤
│ id (PK)     │◄───┤ user_id (FK) │     │ nidn (PK)    │
│ username    │     │ nim (PK)     │     │ user_id (FK) │◄──┐
│ password    │     │ nama         │     │ nama         │   │
│ role        │     │ email        │     │ email        │   │
│ name        │     │ phone        │     │ phone        │   │
│ email       │     │ kelas        │     │ bidang       │   │
│ phone       │     │ angkatan     │     └──────┬───────┘   │
└─────────────┘     │ prodi        │            │           │
                    └──────┬───────┘            │           │
                           │                    │           │
                           │    ┌───────────────┴───┐       │
                           │    │   mata_kuliahs    │       │
                           │    ├───────────────────┤       │
                           │    │ id_mk (PK)        │       │
                           │    │ kode_mk           │       │
                           │    │ nama_mk           │       │
                           │    │ sks               │       │
                           │    │ semester          │       │
                           │    └────────┬──────────┘       │
                           │             │                  │
                           │    ┌────────┴──────────┐       │
                           │    │     jadwals        │       │
                           │    ├───────────────────┤       │
                           │    │ id_jadwal (PK)    │       │
                           │    │ id_mk (FK) ───────┤       │
                           │    │ nidn (FK) ────────┼───────┘
                           │    │ hari              │
                           │    │ jam_mulai         │
                           │    │ jam_selesai       │
                           │    │ ruang             │
                           │    │ kelas             │
                           │    └────────┬──────────┘
                           │             │
                    ┌──────┴─────────────┴──────────┐
                    │         absensis               │
                    ├────────────────────────────────┤
                    │ id_absensi (PK)                │
                    │ nim (FK) ──────────────────────┤
                    │ id_jadwal (FK) ────────────────┤
                    │ tanggal                        │
                    │ jam_masuk                      │
                    │ status (Hadir/Izin/Sakit/Alpha)│
                    │ validasi (pending/divalidasi)  │
                    └────────────────────────────────┘
```

---

## Panduan Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js (opsional, untuk Tailwind CSS build)

### Langkah Instalasi

```bash
# 1. Clone/download proyek ke direktori lokal

# 2. Install dependencies
composer install

# 3. Copy .env dan konfigurasi database
cp .env.example .env
# Edit .env: sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Generate application key
php artisan key:generate

# 5. Buat database MySQL
mysql -u root -e "CREATE DATABASE web_presensi_feb"

# 6. Jalankan migrasi
php artisan migrate

# 7. Seed data dummy
php artisan db:seed

# 8. Jalankan server
php artisan serve
```

### Akun Default (Setelah Seed)

| Role      | Username      | Password      | Keterangan           |
|-----------|---------------|---------------|----------------------|
| Admin     | admin         | password123   | Akses penuh ke sistem|
| Dosen     | 0123456789    | password123   | Sucayono, S.E., M.Sc.|
| Dosen     | 0123456790    | password123   | Dr. Ahmad Fauzi      |
| Dosen     | 0123456791    | password123   | Dr. Siti Nurhaliza   |
| Mahasiswa | 12408011010024| password123   | Naisya Rahma         |
| Mahasiswa | 12408011030100| password123   | Muammar Saladin      |

---

## Fitur Sistem

### 1. Modul Autentikasi (Multi-Role)
- **Login**: Card center-aligned, logo FEB UIN, form NIM/NIP + Password + Role dropdown
- **Registrasi**: Form khusus mahasiswa (NIM, Nama, Email, No.HP, Password, Kelas, Angkatan)
- **Middleware CheckRole**: Membatasi akses berdasarkan role

### 2. Modul Mahasiswa
- **Dashboard**: Kartu statistik (Hadir, Izin/Sakit, Alpha), progress circle persentase kehadiran (syarat ujian 75%), jadwal hari ini
- **Absensi**: Klik kehadiran per jadwal, placeholder untuk QR Code/GPS
- **Riwayat**: Tabel dengan badge warna (Hijau=Hadir, Kuning=Izin, Merah=Alpha)
- **Dokumen**: Form upload bukti surat izin/sakit (JPG/PNG/PDF, maks 2MB)

### 3. Modul Dosen
- **Dashboard**: Jadwal mengajar hari ini, jumlah validasi pending
- **Validasi**: Daftar mahasiswa yang sudah absen, ubah status kehadiran
- **Rekap**: Tabel ringkasan kehadiran per mahasiswa
- **Laporan**: Format cetak dengan tanda tangan dosen

### 4. Modul Admin
- **Dashboard**: Statistik global (total mahasiswa, dosen, MK, jadwal, absensi hari ini)
- **CRUD Mahasiswa**: Tambah, edit, hapus, filter kelas/angkatan, pencarian
- **CRUD Dosen**: Tambah, edit, hapus, pencarian
- **CRUD Mata Kelas**: Tambah via modal, hapus
- **Manajemen Jadwal**: Tambah jadwal, filter hari/kelas, hapus

---

## Teknologi

| Komponen    | Teknologi                          |
|-------------|------------------------------------|
| Framework   | Laravel 10                         |
| Template    | Blade + Tailwind CSS (CDN)         |
| Icons       | Font Awesome 6.5                   |
| Interaksi   | Alpine.js 3                       |
| Database    | MySQL                              |
| Auth        | Laravel Session (Multi-Role)       |
| Upload      | Laravel Storage (public disk)      |
| Warna       | Hijau UIN #006633 + Putih + Abu-abu|

---

## Pengembangan Selanjutnya

- [ ] Integrasi QR Code untuk absensi
- [ ] Verifikasi lokasi GPS dalam radius kampus
- [ ] Export laporan ke PDF (DomPDF)
- [ ] Export data ke Excel (Laravel Excel)
- [ ] Notifikasi email/push
- [ ] Dashboard analitik dengan Chart.js
- [ ] API REST untuk mobile app

---

**Dikembangkan untuk**: Tugas Mata Kuliah Sistem Informasi Manajemen
**Dosen Pengampu**: Sucayono, S.E., M.Sc.
**Kelompok 6**: Naisya Rahma, Muammar Saladin, Naila Imro'atul Azizah, Naila Rihadatul Aisyi
**Program Studi Manajemen - FEB UIN Syarif Hidayatullah Jakarta - 2026**
