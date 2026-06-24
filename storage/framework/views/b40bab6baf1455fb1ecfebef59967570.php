<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1, width=device-width">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>M-PRESENCE FEB · Login</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800;900&family=Poppins:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      overflow: hidden;
      position: relative;
      background: #0a1628;
    }

    /* full background image */
    .bg-full {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      object-fit: cover;
      z-index: 0;
    }

    /* card container */
    .card-wrapper {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: min(90vw, 1191px);
      aspect-ratio: 1191 / 670;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
      overflow: hidden;
      z-index: 1;
    }

    .card-bg {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
      transform: scaleY(-1);
    }

    /* dark blue login panel (left side) */
    .login-panel {
      position: absolute;
      top: 50%;
      left: 3%;
      transform: translateY(-50%);
      width: 28%;
      height: 85%;
      background: #001149;
      border-radius: 15px;
      padding: 24px 26px;
      display: flex;
      flex-direction: column;
      z-index: 3;
    }

    /* header icon + title */
    .panel-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 6px;
    }

    .panel-header img {
      width: 16px;
      height: 16px;
    }

    .panel-title {
      font-size: 13px;
      font-weight: 900;
      color: #fff;
      opacity: 0.79;
    }

    /* divider line */
    .divider-line {
      width: 100%;
      border: none;
      border-top: 1px solid rgba(255,255,255,0.18);
      margin: 8px 0 14px;
    }

    /* form labels */
    .field-label {
      font-size: 10px;
      font-weight: 800;
      color: #fff;
      opacity: 0.7;
      margin-bottom: 6px;
      display: block;
    }

    /* input fields */
    .input-group {
      position: relative;
      margin-bottom: 14px;
    }

    .input-group .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      z-index: 1;
    }

    .form-input {
      width: 100%;
      height: 44px;
      background: rgba(255,255,255,0.2);
      border: 1px solid #27355e;
      border-radius: 10px;
      padding: 0 14px 0 38px;
      font-family: 'Montserrat', sans-serif;
      font-size: 13px;
      font-weight: 700;
      color: #fff;
      outline: none;
      transition: 0.2s;
    }

    .form-input::placeholder {
      color: #fff;
      opacity: 0.2;
      font-weight: 700;
      font-size: 12px;
    }

    .form-input:focus {
      border-color: #3d8ade;
      background: rgba(255,255,255,0.25);
    }

    /* primary button - gradient blue */
    .btn-masuk {
      width: 100%;
      height: 44px;
      background: linear-gradient(90deg, #25429f, #3d8ade 59.13%);
      border: 1px solid #27355e;
      border-radius: 10px;
      font-family: 'Montserrat', sans-serif;
      font-size: 13px;
      font-weight: 900;
      color: #fff;
      cursor: pointer;
      transition: 0.15s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-masuk:hover {
      opacity: 0.9;
      transform: scale(1.01);
    }

    /* secondary button - biometric */
    .btn-biometrik {
      width: 100%;
      height: 44px;
      background: rgba(255,255,255,0.2);
      border: 1px solid #29438f;
      border-radius: 10px;
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 900;
      color: #fff;
      cursor: pointer;
      transition: 0.15s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-biometrik img {
      height: 48px;
      object-fit: contain;
    }

    .btn-biometrik:hover {
      background: rgba(255,255,255,0.3);
    }

    /* link style */
    .link-underlined {
      font-size: 10px;
      font-weight: 500;
      color: #fff;
      opacity: 0.7;
      text-decoration: underline;
      cursor: pointer;
      display: block;
    }

    .link-underlined:hover {
      opacity: 1;
    }

    /* bottom section */
    .bottom-section {
      margin-top: auto;
    }

    .bottom-section .daftar-text {
      font-size: 10px;
      font-weight: 500;
      color: #fff;
      opacity: 0.7;
      text-align: center;
    }

    .bottom-section .daftar-text a {
      color: #fff;
      text-decoration: underline;
      font-weight: 700;
      opacity: 1;
    }

    .bottom-section .daftar-text a:hover {
      opacity: 0.8;
    }

    /* branding area (right side of card, centered between login panel and card edge) */
    .branding-area {
      position: absolute;
      top: 0;
      left: 32%;
      right: 0;
      bottom: 0;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .branding-content {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
      margin-top: -100px;
    }

    .branding-content .deco-image {
      width: 220px;
      height: auto;
      object-fit: contain;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .branding-content h1 {
      font-family: 'Montserrat', sans-serif;
      font-size: 56px;
      font-weight: 800;
      color: #fff;
      line-height: 1.1;
      white-space: nowrap;
      text-shadow: 0 2px 12px rgba(0,0,0,0.4);
    }

    .branding-content h3 {
      font-family: 'Montserrat', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #fff;
      opacity: 0.85;
      margin-top: 4px;
      text-shadow: 0 1px 8px rgba(0,0,0,0.3);
    }

    .branding-content p {
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      font-weight: 600;
      font-style: italic;
      color: #fff;
      opacity: 0.6;
      text-shadow: 0 1px 6px rgba(0,0,0,0.3);
    }

    /* alert styles */
    .alert {
      padding: 8px 12px;
      border-radius: 8px;
      margin-bottom: 12px;
      font-size: 11px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .alert-error {
      background: rgba(220, 38, 38, 0.2);
      border: 1px solid rgba(220, 38, 38, 0.4);
      color: #fca5a5;
    }

    .alert-success {
      background: rgba(34, 197, 94, 0.2);
      border: 1px solid rgba(34, 197, 94, 0.4);
      color: #86efac;
    }

    /* responsive */
    @media (max-width: 1024px) {
      .card-wrapper { width: 95vw; }
      .login-panel { width: 36%; padding: 20px 22px; }
      .branding-area { left: 40%; }
      .branding-content h1 { font-size: 40px; }
      .branding-content h3 { font-size: 13px; }
      .branding-content p { font-size: 10px; }
      .branding-content .deco-image { width: 180px; }
    }

    @media (max-width: 750px) {
      body { overflow: auto; min-height: 100vh; }
      .bg-full { height: 100%; }
      .card-wrapper {
        position: relative;
        width: 95vw;
        aspect-ratio: auto;
        min-height: 100vh;
        border-radius: 0;
        margin: 0 auto;
      }
      .card-bg { display: none; }
      .branding-area {
        position: relative;
        left: 0; right: 0; top: 0; bottom: auto;
        padding: 30px 24px;
      }
      .branding-content h1 { font-size: 30px; }
      .login-panel {
        position: relative;
        top: 0; left: 0;
        transform: none;
        width: 100%;
        height: auto;
        min-height: auto;
        border-radius: 0;
        padding: 30px 24px;
      }
    }

    @media (max-width: 450px) {
      .login-panel { padding: 24px 18px; }
      .form-input { height: 40px; font-size: 12px; }
      .btn-masuk, .btn-biometrik { height: 40px; }
    }
  </style>
</head>
<body>

<!-- full background image -->
<img class="bg-full" alt="" src="<?php echo e(asset('mansy-graphics-V1NQ60y4UK0-unsplash.jpg')); ?>">

<!-- card -->
<div class="card-wrapper">
  <!-- card background (same image) -->
  <img class="card-bg" alt="" src="<?php echo e(asset('mansy-graphics-V1NQ60y4UK0-unsplash.jpg')); ?>">

  <!-- branding area: right side, centered between login panel and card edge -->
  <div class="branding-area">
    <div class="branding-content">
      <img class="deco-image" alt="" src="<?php echo e(asset('005d5b9dc825d74b4f47a1a022a7913f-removebg-preview-1@2x.png')); ?>">
      <h1>M-PRESENCE FEB</h1>
      <h3>SISTEM INFORMASI MANAJEMEN ABSENSI CLASS</h3>
      <p>Fakultas Ekonomi dan Bisnis—UIN Syarif Hidayatullah Jakarta</p>
    </div>
  </div>

  <!-- login panel (left side) -->
  <div class="login-panel">
    <div class="panel-header">
      <img alt="" src="<?php echo e(asset('Key.svg')); ?>">
      <span class="panel-title">AKSES AKUN PORTAL FEB</span>
    </div>

    <div class="divider-line"></div>

    <?php if($errors->any()): ?>
      <div class="alert alert-error">
        <span><?php echo e($errors->first()); ?></span>
      </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
      <div class="alert alert-success">
        <span><?php echo e(session('success')); ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login.post')); ?>" style="display:flex;flex-direction:column;flex:1;">
      <?php echo csrf_field(); ?>

      <label class="field-label">NIM / NIP / EMAIL PEMAKAI</label>
      <div class="input-group">
        <img class="input-icon" alt="" src="<?php echo e(asset('person.svg')); ?>">
        <input type="text" name="username" class="form-input" placeholder="Contoh: naisyarahma@mhs.uinjkt.ac.id" value="<?php echo e(old('username')); ?>" required autofocus>
      </div>

      <label class="field-label">KATA SANDI / PIN MASUK</label>
      <div class="input-group">
        <img class="input-icon" alt="" src="<?php echo e(asset('Lock.svg')); ?>">
        <input type="password" name="password" id="password" class="form-input" placeholder="Masukan Sandi atau PIN ..." required>
      </div>

      <!-- Tombol Masuk Aplikasi -->
      <button type="submit" class="btn-masuk" style="margin-top: 10px;">MASUK APLIKASI</button>

      <!-- Tombol Biometrik -->
      <button type="button" class="btn-biometrik" style="margin-top: 14px;">
        <img alt="" src="<?php echo e(asset('aa1a091da405808d5b32d7d4f6ec1f4a-removebg-preview-1@2x.png')); ?>">
        MASUK INSTAN BIOMETRIK
      </button>

      <!-- Butuh Bantuan di bawah biometrik -->
      <a href="https://wa.me/6285934228607" target="_blank" class="link-underlined" style="margin-top: 10px;">Butuh Bantuan Akses Masuk?</a>

      <!-- Bagian bawah: divider + daftar -->
      <div class="bottom-section">
        <div class="divider-line" style="margin: 14px 0 10px;"></div>
        <div class="daftar-text">
          Belum Punya Akun? <a href="<?php echo e(route('register-mahasiswa')); ?>">Daftar</a>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>
<?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views\auth\login.blade.php ENDPATH**/ ?>