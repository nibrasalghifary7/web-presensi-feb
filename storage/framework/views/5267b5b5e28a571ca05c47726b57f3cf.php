<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1, width=device-width">
  <title>M-PRESENCE FEB — UIN Syarif Hidayatullah Jakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      background: #0a1628;
      color: #fff;
      overflow-x: hidden;
    }

    /* ========== BACKGROUND ========== */
    .bg-full {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100vh;
      object-fit: cover;
      z-index: 0;
      opacity: 0.4;
    }

    .bg-overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100vh;
      background: linear-gradient(180deg, rgba(10,22,40,0.7) 0%, rgba(0,17,73,0.85) 100%);
      z-index: 1;
    }

    /* ========== SVG CURVES ========== */
    .curve-top {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      z-index: 2;
      pointer-events: none;
    }

    .curve-bottom {
      position: absolute;
      bottom: 0; left: 0;
      width: 100%;
      z-index: 2;
      pointer-events: none;
      transform: rotate(180deg);
    }

    .curve-mid {
      position: absolute;
      top: 45%; left: 0;
      width: 100%;
      z-index: 2;
      pointer-events: none;
      opacity: 0.3;
    }

    /* ========== HEADER / NAVBAR ========== */
    .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 16px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(10,22,40,0.85);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .navbar-brand img {
      width: 36px;
      height: 36px;
    }

    .navbar-brand span {
      font-size: 18px;
      font-weight: 900;
      color: #fff;
      letter-spacing: 1px;
    }

    .navbar-links {
      display: flex;
      align-items: center;
      gap: 32px;
    }

    .navbar-links a {
      color: rgba(255,255,255,0.65);
      text-decoration: none;
      font-size: 13px;
      font-weight: 700;
      transition: 0.2s;
      letter-spacing: 0.5px;
    }

    .navbar-links a:hover {
      color: #fff;
    }

    .btn-nav {
      padding: 10px 28px;
      background: linear-gradient(90deg, #25429f, #3d8ade 59.13%);
      border: 1px solid #27355e;
      border-radius: 10px;
      color: #fff;
      font-size: 12px;
      font-weight: 900;
      text-decoration: none;
      transition: 0.2s;
      letter-spacing: 0.5px;
    }

    .btn-nav:hover {
      opacity: 0.9;
      transform: scale(1.03);
    }

    /* mobile hamburger */
    .hamburger {
      display: none;
      background: none;
      border: none;
      color: #fff;
      font-size: 22px;
      cursor: pointer;
    }

    /* ========== HERO SECTION ========== */
    .hero {
      position: relative;
      z-index: 10;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 120px 40px 80px;
    }

    .hero-inner {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 80px;
      max-width: 1200px;
      width: 100%;
    }

    .hero-left {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .hero-left .deco-image {
      width: 240px;
      height: auto;
      object-fit: contain;
      margin-bottom: 24px;
      opacity: 0.9;
      filter: drop-shadow(0 4px 20px rgba(61,138,222,0.3));
    }

    .hero-left h1 {
      font-size: 52px;
      font-weight: 900;
      color: #fff;
      line-height: 1.1;
      text-shadow: 0 2px 16px rgba(0,0,0,0.4);
      margin-bottom: 12px;
    }

    .hero-left h3 {
      font-size: 16px;
      font-weight: 700;
      color: rgba(255,255,255,0.8);
      margin-bottom: 6px;
    }

    .hero-left p {
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 500;
      font-style: italic;
      color: rgba(255,255,255,0.5);
      margin-bottom: 32px;
    }

    .hero-buttons {
      display: flex;
      gap: 16px;
    }

    .btn-hero {
      padding: 14px 36px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 900;
      text-decoration: none;
      transition: 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .btn-hero-primary {
      background: linear-gradient(90deg, #25429f, #3d8ade 59.13%);
      border: 1px solid #27355e;
      color: #fff;
    }

    .btn-hero-primary:hover {
      opacity: 0.9;
      transform: scale(1.03);
    }

    .btn-hero-outline {
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.2);
      color: #fff;
    }

    .btn-hero-outline:hover {
      background: rgba(255,255,255,0.15);
      border-color: rgba(255,255,255,0.4);
    }

    /* hero right - card preview */
    .hero-right {
      flex: 0 0 420px;
    }

    .preview-card {
      background: #001149;
      border-radius: 16px;
      padding: 32px 28px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.4);
      border: 1px solid rgba(255,255,255,0.06);
    }

    .preview-card .card-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .preview-card .card-header img {
      width: 20px;
      height: 20px;
    }

    .preview-card .card-header span {
      font-size: 14px;
      font-weight: 900;
      color: rgba(255,255,255,0.8);
    }

    .preview-card .divider {
      width: 100%;
      border: none;
      border-top: 1px solid rgba(255,255,255,0.1);
      margin-bottom: 24px;
    }

    .preview-card .info-row {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 0;
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .preview-card .info-row:last-child {
      border-bottom: none;
    }

    .preview-card .info-icon {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .preview-card .info-icon.blue {
      background: rgba(61,138,222,0.15);
      color: #3d8ade;
    }

    .preview-card .info-icon.green {
      background: rgba(34,197,94,0.15);
      color: #22c55e;
    }

    .preview-card .info-icon.purple {
      background: rgba(168,85,247,0.15);
      color: #a855f7;
    }

    .preview-card .info-icon.amber {
      background: rgba(245,158,11,0.15);
      color: #f59e0b;
    }

    .preview-card .info-text h4 {
      font-size: 13px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 2px;
    }

    .preview-card .info-text p {
      font-size: 11px;
      font-weight: 500;
      color: rgba(255,255,255,0.45);
    }

    /* ========== FEATURES SECTION ========== */
    .features {
      position: relative;
      z-index: 10;
      padding: 80px 40px 100px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .features-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .features-title h2 {
      font-size: 36px;
      font-weight: 900;
      color: #fff;
      margin-bottom: 12px;
    }

    .features-title p {
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      color: rgba(255,255,255,0.5);
      max-width: 500px;
      margin: 0 auto;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    .feature-card {
      background: rgba(0,17,73,0.6);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 16px;
      padding: 32px 28px;
      transition: 0.3s;
      backdrop-filter: blur(8px);
    }

    .feature-card:hover {
      transform: translateY(-4px);
      border-color: rgba(61,138,222,0.3);
      box-shadow: 0 12px 40px rgba(61,138,222,0.15);
    }

    .feature-card .icon-box {
      width: 52px;
      height: 52px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      margin-bottom: 20px;
    }

    .feature-card .icon-box.blue {
      background: linear-gradient(135deg, rgba(37,66,159,0.4), rgba(61,138,222,0.4));
      color: #5a9ee6;
    }

    .feature-card .icon-box.green {
      background: linear-gradient(135deg, rgba(16,120,60,0.4), rgba(34,197,94,0.4));
      color: #4ade80;
    }

    .feature-card .icon-box.purple {
      background: linear-gradient(135deg, rgba(100,40,180,0.4), rgba(168,85,247,0.4));
      color: #c084fc;
    }

    .feature-card .icon-box.amber {
      background: linear-gradient(135deg, rgba(150,80,10,0.4), rgba(245,158,11,0.4));
      color: #fbbf24;
    }

    .feature-card .icon-box.red {
      background: linear-gradient(135deg, rgba(150,30,30,0.4), rgba(239,68,68,0.4));
      color: #f87171;
    }

    .feature-card .icon-box.cyan {
      background: linear-gradient(135deg, rgba(10,100,130,0.4), rgba(6,182,212,0.4));
      color: #22d3ee;
    }

    .feature-card h3 {
      font-size: 16px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 8px;
    }

    .feature-card p {
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      font-weight: 500;
      color: rgba(255,255,255,0.5);
      line-height: 1.6;
    }

    /* ========== STATS SECTION ========== */
    .stats {
      position: relative;
      z-index: 10;
      padding: 60px 40px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }

    .stat-item {
      text-align: center;
      padding: 28px 16px;
      background: rgba(0,17,73,0.4);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 14px;
    }

    .stat-item .stat-number {
      font-size: 36px;
      font-weight: 900;
      background: linear-gradient(90deg, #3d8ade, #5a9ee6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .stat-item .stat-label {
      font-size: 12px;
      font-weight: 700;
      color: rgba(255,255,255,0.5);
      margin-top: 6px;
      letter-spacing: 0.5px;
    }

    /* ========== FOOTER ========== */
    .footer {
      position: relative;
      z-index: 10;
      padding: 40px;
      text-align: center;
      border-top: 1px solid rgba(255,255,255,0.06);
    }

    .footer p {
      font-size: 12px;
      font-weight: 600;
      color: rgba(255,255,255,0.35);
    }

    .footer a {
      color: #3d8ade;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
      .hero-inner {
        flex-direction: column;
        gap: 48px;
        text-align: center;
      }
      .hero-left h1 { font-size: 40px; }
      .hero-right { flex: none; width: 100%; max-width: 420px; }
      .features-grid { grid-template-columns: repeat(2, 1fr); }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
      .navbar { padding: 14px 20px; }
      .navbar-links { display: none; }
      .hamburger { display: block; }
      .hero { padding: 100px 20px 60px; }
      .hero-left h1 { font-size: 32px; }
      .hero-left .deco-image { width: 180px; }
      .hero-buttons { flex-direction: column; width: 100%; }
      .btn-hero { width: 100%; justify-content: center; }
      .features { padding: 60px 20px; }
      .features-grid { grid-template-columns: 1fr; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .stats, .footer { padding: 30px 20px; }
    }

    @media (max-width: 450px) {
      .hero-left h1 { font-size: 26px; }
      .preview-card { padding: 24px 20px; }
      .stat-item .stat-number { font-size: 28px; }
    }

    /* ========== ANIMATIONS ========== */
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .hero-left .deco-image {
      animation: float 4s ease-in-out infinite;
    }
  </style>
</head>
<body>

<!-- Background -->
<img class="bg-full" alt="" src="<?php echo e(asset('mansy-graphics-V1NQ60y4UK0-unsplash.jpg')); ?>">
<div class="bg-overlay"></div>

<!-- SVG Curves -->
<svg class="curve-top" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M0,0 L1440,0 L1440,80 Q1080,120 720,80 Q360,40 0,80 Z" fill="rgba(0,17,73,0.4)"/>
</svg>

<svg class="curve-mid" viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M0,50 Q360,0 720,50 Q1080,100 1440,50 L1440,100 L0,100 Z" fill="rgba(0,17,73,0.3)"/>
</svg>

<svg class="curve-bottom" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M0,0 L1440,0 L1440,80 Q1080,120 720,80 Q360,40 0,80 Z" fill="rgba(0,17,73,0.5)"/>
</svg>

<!-- Navbar -->
<nav class="navbar">
  <div class="navbar-brand">
    <img alt="" src="<?php echo e(asset('Key.svg')); ?>">
    <span>M-PRESENCE FEB</span>
  </div>
  <div class="navbar-links">
    <a href="#beranda">Beranda</a>
    <a href="#fitur">Fitur</a>
    <a href="#tentang">Tentang</a>
    <a href="<?php echo e(route('login')); ?>" class="btn-nav"><i class="fas fa-right-to-bracket"></i> Masuk</a>
  </div>
  <button class="hamburger" onclick="document.querySelector('.navbar-links').classList.toggle('show')">
    <i class="fas fa-bars"></i>
  </button>
</nav>

<!-- Hero Section -->
<section class="hero" id="beranda">
  <div class="hero-inner">
    <div class="hero-left">
      <img class="deco-image" alt="" src="<?php echo e(asset('005d5b9dc825d74b4f47a1a022a7913f-removebg-preview-1@2x.png')); ?>">
      <h1>M-PRESENCE FEB</h1>
      <h3>SISTEM INFORMASI MANAJEMEN ABSENSI CLASS</h3>
      <p>Fakultas Ekonomi dan Bisnis — UIN Syarif Hidayatullah Jakarta</p>
      <div class="hero-buttons">
        <a href="<?php echo e(route('login')); ?>" class="btn-hero btn-hero-primary">
          <i class="fas fa-right-to-bracket"></i> Masuk Aplikasi
        </a>
        <a href="<?php echo e(route('register-mahasiswa')); ?>" class="btn-hero btn-hero-outline">
          <i class="fas fa-user-plus"></i> Daftar Akun
        </a>
      </div>
    </div>

    <div class="hero-right">
      <div class="preview-card">
        <div class="card-header">
          <img alt="" src="<?php echo e(asset('Key.svg')); ?>">
          <span>AKSES CEPAT</span>
        </div>
        <hr class="divider">
        <div class="info-row">
          <div class="info-icon blue"><i class="fas fa-fingerprint"></i></div>
          <div class="info-text">
            <h4>Absensi Biometrik</h4>
            <p>Absen instan dengan sidik jari</p>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon green"><i class="fas fa-clock"></i></div>
          <div class="info-text">
            <h4>Real-time Monitoring</h4>
            <p>Pantau kehadiran secara langsung</p>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon purple"><i class="fas fa-file-alt"></i></div>
          <div class="info-text">
            <h4>Pengajuan Digital</h4>
            <p>Izin & sakit secara online</p>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon amber"><i class="fas fa-chart-bar"></i></div>
          <div class="info-text">
            <h4>Laporan Otomatis</h4>
            <p>Rekap kehadiran per semester</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="features" id="fitur">
  <div class="features-title">
    <h2>Fitur Unggulan</h2>
    <p>Kemudahan mengelola absensi kelas dalam satu platform terintegrasi</p>
  </div>
  <div class="features-grid">
    <div class="feature-card">
      <div class="icon-box blue"><i class="fas fa-qrcode"></i></div>
      <h3>Absensi Multi-Metode</h3>
      <p>Absensi melalui PIN, password, atau biometrik. Mendukung berbagai metode sesuai kebutuhan.</p>
    </div>
    <div class="feature-card">
      <div class="icon-box green"><i class="fas fa-calendar-check"></i></div>
      <h3>Jadwal Otomatis</h3>
      <p>Jadwal mata kuliah terintegrasi dengan dosen dan kelas. Atur sekali, jalan terus.</p>
    </div>
    <div class="feature-card">
      <div class="icon-box purple"><i class="fas fa-paper-plane"></i></div>
      <h3>Pengajuan Izin Online</h3>
      <p>Mahasiswa bisa ajukan izin atau sakit langsung dari dashboard, lengkap dengan upload bukti.</p>
    </div>
    <div class="feature-card">
      <div class="icon-box amber"><i class="fas fa-users-gear"></i></div>
      <h3>Multi-Role</h3>
      <p>Admin, Dosen, dan Mahasiswa punya dashboard masing-masing dengan akses sesuai peran.</p>
    </div>
    <div class="feature-card">
      <div class="icon-box red"><i class="fas fa-shield-halved"></i></div>
      <h3>Keamanan Akun</h3>
      <p>Lock akun setelah 5x percobaan gagal, enkripsi password bcrypt, dan session protection.</p>
    </div>
    <div class="feature-card">
      <div class="icon-box cyan"><i class="fas fa-globe"></i></div>
      <h3>Multibahasa</h3>
      <p>Dukungan bahasa Indonesia dan Inggris untuk fleksibilitas pengguna.</p>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="stats" id="tentang">
  <div class="stats-grid">
    <div class="stat-item">
      <div class="stat-number">1000+</div>
      <div class="stat-label">MAHASISWA</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">50+</div>
      <div class="stat-label">DOSEN</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">30+</div>
      <div class="stat-label">MATA KULIAH</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">99%</div>
      <div class="stat-label">UPTIME</div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <p>&copy; <?php echo e(date('Y')); ?> <a href="#">M-PRESENCE FEB</a> — Fakultas Ekonomi dan Bisnis, UIN Syarif Hidayatullah Jakarta. All rights reserved.</p>
</footer>

</body>
</html>
<?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/index.blade.php ENDPATH**/ ?>