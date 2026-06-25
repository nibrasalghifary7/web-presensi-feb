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
      overflow-y: auto;
      overflow-x: hidden;
    }

    /* custom scrollbar - blue theme */
    .login-panel::-webkit-scrollbar {
      width: 6px;
    }

    .login-panel::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.05);
      border-radius: 3px;
    }

    .login-panel::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #25429f, #3d8ade);
      border-radius: 3px;
    }

    .login-panel::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #3d8ade, #5a9ee6);
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

    /* password wrapper */
    .password-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .password-wrapper .form-input {
      flex: 1;
      padding-right: 40px;
    }

    .password-wrapper .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      z-index: 2;
      pointer-events: none;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: rgba(255,255,255,0.35);
      cursor: pointer;
      font-size: 14px;
      padding: 4px;
      z-index: 2;
      transition: 0.2s;
    }

    .password-toggle:hover {
      color: rgba(255,255,255,0.7);
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
      height: 48px;
      background: rgba(255,255,255,0.15);
      border: 1px solid rgba(255,255,255,0.25);
      border-radius: 10px;
      font-family: 'Montserrat', sans-serif;
      font-size: 12px;
      font-weight: 800;
      color: #fff;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-biometrik:hover {
      background: rgba(255,255,255,0.25);
      border-color: rgba(255,255,255,0.4);
    }

    /* modal biometric overlay */
    .bio-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      backdrop-filter: blur(6px);
      z-index: 100;
      align-items: center;
      justify-content: center;
    }

    .bio-overlay.active {
      display: flex;
    }

    .bio-modal {
      background: linear-gradient(145deg, #0d1f3c, #1a2f7a);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 24px;
      padding: 36px 40px;
      text-align: center;
      width: 320px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
      animation: bioSlideUp 0.3s ease;
    }

    @keyframes bioSlideUp {
      from { opacity: 0; transform: translateY(30px) scale(0.95); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .bio-modal h3 {
      font-family: 'Montserrat', sans-serif;
      font-size: 16px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 6px;
    }

    .bio-modal p {
      font-family: 'Poppins', sans-serif;
      font-size: 12px;
      color: rgba(255,255,255,0.6);
      margin-bottom: 24px;
    }

    /* fingerprint circle */
    .fingerprint-area {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      border: 3px solid rgba(91, 127, 255, 0.4);
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
      position: relative;
      background: rgba(91, 127, 255, 0.08);
      user-select: none;
      -webkit-user-select: none;
    }

    .fingerprint-area:hover {
      border-color: rgba(91, 127, 255, 0.7);
      background: rgba(91, 127, 255, 0.15);
    }

    .fingerprint-area.scanning {
      border-color: #5B7FFF;
      background: rgba(91, 127, 255, 0.2);
      box-shadow: 0 0 30px rgba(91, 127, 255, 0.3), inset 0 0 20px rgba(91, 127, 255, 0.1);
    }

    .fingerprint-area.success {
      border-color: #22c55e;
      background: rgba(34, 197, 94, 0.2);
      box-shadow: 0 0 30px rgba(34, 197, 94, 0.3);
    }

    .fingerprint-area .fp-icon {
      font-size: 56px;
      color: rgba(255,255,255,0.5);
      transition: all 0.3s;
    }

    .fingerprint-area.scanning .fp-icon {
      color: #5B7FFF;
      animation: fpPulse 1s ease infinite;
    }

    .fingerprint-area.success .fp-icon {
      color: #22c55e;
    }

    @keyframes fpPulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.1); opacity: 0.7; }
    }

    /* progress ring */
    .fp-ring {
      position: absolute;
      inset: -3px;
      border-radius: 50%;
      border: 3px solid transparent;
      border-top-color: #5B7FFF;
      border-right-color: #5B7FFF;
      opacity: 0;
      transition: opacity 0.2s;
    }

    .fingerprint-area.scanning .fp-ring {
      opacity: 1;
      animation: fpSpin 1.2s linear infinite;
    }

    @keyframes fpSpin {
      to { transform: rotate(360deg); }
    }

    .bio-hint {
      font-size: 11px;
      color: rgba(255,255,255,0.4);
      margin-top: 16px;
    }

    .bio-close {
      margin-top: 16px;
      background: none;
      border: 1px solid rgba(255,255,255,0.2);
      color: rgba(255,255,255,0.6);
      padding: 8px 24px;
      border-radius: 30px;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
    }

    .bio-close:hover {
      background: rgba(255,255,255,0.1);
      color: #fff;
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

      <label class="field-label">NIM / NIDN / EMAIL PENGGUNA</label>
      <div class="input-group">
        <img class="input-icon" alt="" src="<?php echo e(asset('person.svg')); ?>">
        <input type="text" name="username" class="form-input" placeholder="Contoh: naisyarahma@mhs.uinjkt.ac.id" value="<?php echo e(old('username')); ?>" required autofocus>
      </div>

      <label class="field-label">KATA SANDI / PIN MASUK</label>
      <div class="password-wrapper" style="margin-bottom: 0;">
        <img class="input-icon" alt="" src="<?php echo e(asset('Lock.svg')); ?>">
        <input type="password" name="password" id="password" class="form-input" placeholder="Masukan Sandi atau PIN ..." required>
        <button type="button" class="password-toggle" onclick="toggleLoginPassword()">
          <i id="eyeLogin" class="fas fa-eye"></i>
        </button>
      </div>

      <!-- Tombol Masuk Aplikasi -->
      <button type="submit" class="btn-masuk" style="margin-top: 10px;">MASUK APLIKASI</button>

      <!-- Tombol Biometrik -->
      <button type="button" class="btn-biometrik" id="btnBiometrik" style="margin-top: 14px;" onclick="openBioModal()">
        <i class="fas fa-fingerprint" style="font-size:20px;"></i> MASUK INSTAN BIOMETRIK
      </button>

      <!-- Modal Biometric -->
      <div class="bio-overlay" id="bioOverlay">
        <div class="bio-modal">
          <h3><i class="fas fa-shield-halved" style="color:#5B7FFF;margin-right:6px;"></i> Autentikasi Biometrik</h3>
          <p>Tempelkan jari Anda pada sensor untuk masuk</p>
          <div class="fingerprint-area" id="fpArea"
               onmousedown="startBioScan()" onmouseup="cancelBioScan()" onmouseleave="cancelBioScan()"
               ontouchstart="startBioScan()" ontouchend="cancelBioScan()">
            <div class="fp-ring"></div>
            <i class="fas fa-fingerprint fp-icon"></i>
          </div>
          <p class="bio-hint" id="bioHint">Tekan dan tahan sidik jari selama 2 detik</p>
          <button class="bio-close" onclick="closeBioModal()">Batal</button>
        </div>
      </div>

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

<script>
function toggleLoginPassword() {
  const input = document.getElementById('password');
  const icon = document.getElementById('eyeLogin');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}

let bioTimer = null;

function openBioModal() {
  document.getElementById('bioOverlay').classList.add('active');
  resetBioState();
}

function closeBioModal() {
  document.getElementById('bioOverlay').classList.remove('active');
  resetBioState();
}

function resetBioState() {
  const area = document.getElementById('fpArea');
  const hint = document.getElementById('bioHint');
  area.classList.remove('scanning', 'success');
  hint.textContent = 'Tekan dan tahan sidik jari selama 2 detik';
  hint.style.color = 'rgba(255,255,255,0.4)';
  if (bioTimer) { clearTimeout(bioTimer); bioTimer = null; }
}

function startBioScan() {
  const area = document.getElementById('fpArea');
  const hint = document.getElementById('bioHint');
  area.classList.add('scanning');
  hint.textContent = 'Memindai sidik jari...';
  hint.style.color = '#5B7FFF';

  bioTimer = setTimeout(function() {
    area.classList.remove('scanning');
    area.classList.add('success');
    hint.textContent = 'Sidik jari terverifikasi!';
    hint.style.color = '#22c55e';

    setTimeout(function() {
      window.location.href = '<?php echo e(route("login.biometric")); ?>';
    }, 800);
  }, 2000);
}

function cancelBioScan() {
  const area = document.getElementById('fpArea');
  const hint = document.getElementById('bioHint');
  area.classList.remove('scanning');
  hint.textContent = 'Tekan dan tahan sidik jari selama 2 detik';
  hint.style.color = 'rgba(255,255,255,0.4)';
  if (bioTimer) { clearTimeout(bioTimer); bioTimer = null; }
}

// Tutup modal kalau klik di luar
document.getElementById('bioOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeBioModal();
});
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/auth/login.blade.php ENDPATH**/ ?>