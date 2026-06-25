<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1, width=device-width">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Registrasi Mahasiswa - M-PRESENCE FEB</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800;900&family=Poppins:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      overflow: hidden;
      position: relative;
      background: #0a1628;
    }

    .bg-full {
      position: fixed; top: 0; left: 0;
      width: 100%; height: 100vh;
      object-fit: cover; z-index: 0;
    }

    .card-wrapper {
      position: absolute; top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: min(90vw, 1191px);
      height: min(90vh, 820px);
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
      overflow: hidden; z-index: 1;
    }

    .card-bg {
      width: 100%; height: 100%;
      object-fit: cover; position: absolute;
      top: 0; left: 0; transform: scaleY(-1);
    }

    /* register panel */
    .register-panel {
      position: absolute; top: 50%; left: 3%;
      transform: translateY(-50%);
      width: 28%; height: 88%;
      background: #001149; border-radius: 15px;
      padding: 20px 24px;
      display: flex; flex-direction: column;
      z-index: 3; overflow-y: auto; overflow-x: hidden;
    }

    /* custom scrollbar - blue theme */
    .register-panel::-webkit-scrollbar {
      width: 6px;
    }

    .register-panel::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.05);
      border-radius: 3px;
    }

    .register-panel::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #25429f, #3d8ade);
      border-radius: 3px;
    }

    .register-panel::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #3d8ade, #5a9ee6);
    }

    /* header */
    .panel-header {
      display: flex; align-items: center;
      gap: 10px; margin-bottom: 4px;
    }

    .panel-header img { width: 20px; height: 20px; }

    .panel-title {
      font-size: 13px; font-weight: 900;
      color: #fff; opacity: 0.79;
    }

    .divider-line {
      width: 100%; border: none;
      border-top: 1px solid rgba(255,255,255,0.18);
      margin: 6px 0 10px;
    }

    /* role selector with sliding pill */
    .role-selector {
      position: relative;
      display: flex;
      background: rgba(255,255,255,0.1);
      border: 1px solid #27355e;
      border-radius: 10px;
      padding: 4px;
      margin-bottom: 14px;
      min-height: 40px;
      overflow: hidden;
    }

    .role-selector .role-slider {
      position: absolute;
      top: 4px; left: 4px;
      width: calc(50% - 4px);
      bottom: 4px;
      background: linear-gradient(90deg, #25429f, #3d8ade 59.13%);
      border-radius: 7px;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 0;
    }

    .role-selector input[type="radio"] {
      display: none;
    }

    .role-selector label {
      flex: 1;
      text-align: center;
      padding: 8px 0;
      font-size: 10px;
      font-weight: 900;
      color: #fff;
      cursor: pointer;
      position: relative;
      z-index: 1;
      transition: opacity 0.3s;
      opacity: 0.5;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .role-selector label.active {
      opacity: 1;
    }

    .role-selector input[type="radio"]:checked + label {
      opacity: 1;
    }

    /* field labels */
    .field-label {
      font-size: 8px; font-weight: 800;
      color: #fff; opacity: 0.7;
      margin-bottom: 4px; display: block;
    }

    /* input fields */
    .input-group {
      position: relative; margin-bottom: 10px;
    }

    .form-input {
      width: 100%; height: 40px;
      background: rgba(255,255,255,0.2);
      border: 1px solid #27355e;
      border-radius: 10px;
      padding: 0 12px;
      font-family: 'Poppins', sans-serif;
      font-size: 12px; font-weight: 600;
      color: #fff; outline: none;
      transition: 0.2s;
    }

    .form-input::placeholder {
      color: #fff; opacity: 0.2;
      font-weight: 600; font-size: 11px;
    }

    .form-input:focus {
      border-color: #3d8ade;
      background: rgba(255,255,255,0.25);
    }

    /* select */
    .form-select {
      width: 100%; height: 40px;
      background: rgba(255,255,255,0.2);
      border: 1px solid #27355e;
      border-radius: 10px;
      padding: 0 28px 0 12px;
      font-family: 'Poppins', sans-serif;
      font-size: 12px; font-weight: 600;
      color: #fff; outline: none;
      transition: 0.2s; appearance: none;
      cursor: pointer;
    }

    .form-select:focus {
      border-color: #3d8ade;
      background: rgba(255,255,255,0.25);
    }

    .form-select option { background: #001149; color: #fff; }

    .select-wrapper { position: relative; }

    .select-wrapper::after {
      content: '\f107';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      position: absolute; right: 12px; top: 50%;
      transform: translateY(-50%);
      color: rgba(255,255,255,0.4);
      font-size: 10px; pointer-events: none;
    }

    /* password */
    .password-wrapper { position: relative; }

    .password-wrapper .form-input { padding-right: 36px; }

    .password-toggle {
      position: absolute; right: 10px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      color: rgba(255,255,255,0.3);
      cursor: pointer; font-size: 12px; padding: 4px;
    }

    .password-toggle:hover { color: rgba(255,255,255,0.6); }

    /* form row */
    .form-row { display: flex; gap: 8px; }
    .form-row .form-col { flex: 1; }

    /* button */
    .btn-daftar {
      width: 100%; height: 40px;
      background: linear-gradient(90deg, #25429f, #3d8ade 59.13%);
      border: 1px solid #27355e;
      border-radius: 10px;
      font-family: 'Montserrat', sans-serif;
      font-size: 12px; font-weight: 900;
      color: #fff; cursor: pointer;
      transition: 0.15s;
      display: flex; align-items: center;
      justify-content: center; gap: 8px;
      margin-top: 6px;
    }

    .btn-daftar:hover { opacity: 0.9; transform: scale(1.01); }

    /* bottom */
    .bottom-section { margin-top: auto; padding-top: 10px; }

    .bottom-section .daftar-text {
      font-size: 10px; font-weight: 500;
      color: #fff; opacity: 0.7; text-align: center;
    }

    .bottom-section .daftar-text a {
      color: #fff; text-decoration: underline;
      font-weight: 700; opacity: 1;
    }

    .bottom-section .daftar-text a:hover { opacity: 0.8; }

    /* branding */
    .branding-area {
      position: absolute; top: 0; left: 32%;
      right: 0; bottom: 0; z-index: 2;
      display: flex; align-items: center; justify-content: center;
    }

    .branding-content {
      text-align: center;
      display: flex; flex-direction: column;
      align-items: center; gap: 6px;
      margin-top: -100px;
    }

    .branding-content .deco-image {
      width: 220px; height: auto;
      object-fit: contain; margin-bottom: 10px; opacity: 0.9;
    }

    .branding-content h1 {
      font-family: 'Montserrat', sans-serif;
      font-size: 56px; font-weight: 800;
      color: #fff; line-height: 1.1;
      white-space: nowrap;
      text-shadow: 0 2px 12px rgba(0,0,0,0.4);
    }

    .branding-content h3 {
      font-family: 'Montserrat', sans-serif;
      font-size: 16px; font-weight: 700;
      color: #fff; opacity: 0.85;
      margin-top: 4px;
      text-shadow: 0 1px 8px rgba(0,0,0,0.3);
    }

    .branding-content p {
      font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 600;
      font-style: italic; color: #fff;
      opacity: 0.6;
      text-shadow: 0 1px 6px rgba(0,0,0,0.3);
    }

    /* alerts */
    .alert {
      padding: 8px 12px; border-radius: 8px;
      margin-bottom: 10px; font-size: 10px; font-weight: 600;
    }

    .alert-error {
      background: rgba(220, 38, 38, 0.2);
      border: 1px solid rgba(220, 38, 38, 0.4);
      color: #fca5a5;
    }

    .alert-error ul { list-style: none; padding: 0; margin: 0; }
    .alert-error li { display: flex; align-items: center; gap: 4px; margin-bottom: 1px; }

    .alert-success {
      background: rgba(34, 197, 94, 0.2);
      border: 1px solid rgba(34, 197, 94, 0.4);
      color: #86efac;
    }

    /* responsive */
    @media (max-width: 1024px) {
      .card-wrapper { width: 95vw; }
      .register-panel { width: 36%; padding: 18px 20px; }
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
        position: relative; width: 95vw;
        aspect-ratio: auto; min-height: 100vh;
        border-radius: 0; margin: 0 auto;
      }
      .card-bg { display: none; }
      .branding-area {
        position: relative; left: 0; right: 0;
        top: 0; bottom: auto; padding: 30px 24px;
      }
      .branding-content { margin-top: 0; }
      .branding-content h1 { font-size: 30px; }
      .register-panel {
        position: relative; top: 0; left: 0;
        transform: none; width: 100%;
        height: auto; min-height: auto;
        border-radius: 0; padding: 30px 24px;
        overflow-y: visible;
      }
    }

    @media (max-width: 450px) {
      .register-panel { padding: 24px 18px; }
      .form-input, .form-select { height: 38px; font-size: 11px; }
      .btn-daftar { height: 38px; }
    }
  </style>
</head>
<body>

<img class="bg-full" alt="" src="{{ asset('mansy-graphics-V1NQ60y4UK0-unsplash.jpg') }}">

<div class="card-wrapper">
  <img class="card-bg" alt="" src="{{ asset('mansy-graphics-V1NQ60y4UK0-unsplash.jpg') }}">

  <!-- branding -->
  <div class="branding-area">
    <div class="branding-content">
      <img class="deco-image" alt="" src="{{ asset('005d5b9dc825d74b4f47a1a022a7913f-removebg-preview-1@2x.png') }}">
      <h1>M-PRESENCE FEB</h1>
      <h3>SISTEM INFORMASI MANAJEMEN ABSENSI CLASS</h3>
      <p>Fakultas Ekonomi dan Bisnis—UIN Syarif Hidayatullah Jakarta</p>
    </div>
  </div>

  <!-- register panel -->
  <div class="register-panel">
    <div class="panel-header">
      <img alt="" src="{{ asset('person.svg') }}">
      <span class="panel-title">REGISTRASI MANDIRI FEB</span>
    </div>

    <div class="divider-line"></div>

    <!-- role selector with sliding pill -->
    <label class="field-label">MENDAFTAR SEBAGAI</label>
    <div class="role-selector" id="roleSelector">
      <div class="role-slider" id="roleSlider"></div>
      <input type="radio" name="role_page" id="roleMhs" value="mahasiswa" checked>
      <label for="roleMhs" id="labelMhs" class="active">MAHASISWA BARU</label>
      <input type="radio" name="role_page" id="roleDsn" value="dosen">
      <label for="roleDsn" id="labelDsn" onclick="slideTo('right', '{{ route('register-dosen') }}')">DOSEN BARU</label>
    </div>

    @if($errors->any())
      <div class="alert alert-error">
        <ul>
          @foreach($errors->all() as $error)
            <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}" style="display:flex;flex-direction:column;flex:1;">
      @csrf

      <label class="field-label">NAMA LENGKAP</label>
      <div class="input-group">
        <input type="text" name="nama" class="form-input" placeholder="Nama Lengkap Anda..." value="{{ old('nama') }}" required>
      </div>

      <label class="field-label">NIM (NOMOR INDUK MAHASISWA)</label>
      <div class="input-group">
        <input type="text" name="nim" class="form-input" placeholder="Contoh: 1220905" value="{{ old('nim') }}" required>
      </div>

      <label class="field-label">ALAMAT EMAIL</label>
      <div class="input-group">
        <input type="email" name="email" class="form-input" placeholder="Email Akademik..." value="{{ old('email') }}" required>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label class="field-label">JENIS KELAMIN</label>
          <div class="input-group select-wrapper" style="margin-bottom:0;">
            <select name="jenis_kelamin" class="form-select">
              <option value="L" {{ old('jenis_kelamin', 'L') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
              <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="form-col">
          <label class="field-label">PIN MASUK (6 ANGKA)</label>
          <div class="input-group" style="margin-bottom:0;">
            <div class="password-wrapper">
              <input type="password" name="pin" id="pin" class="form-input" placeholder="123456" maxlength="6" inputmode="numeric" pattern="[0-9]*" value="{{ old('pin') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
              <button type="button" class="password-toggle" onclick="togglePassword('pin','eyePin')">
                <i id="eyePin" class="fas fa-eye"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <label class="field-label" style="margin-top: 8px;">KATA SANDI (PASSWORD)</label>
      <div class="input-group">
        <div class="password-wrapper">
          <input type="password" name="password" id="password" class="form-input" placeholder="Isi Sandi Akun..." required>
          <button type="button" class="password-toggle" onclick="togglePassword('password','eye1')">
            <i id="eye1" class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <label class="field-label">KONFIRMASI SANDI</label>
      <div class="input-group">
        <div class="password-wrapper">
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi Sandi..." required>
          <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation','eye2')">
            <i id="eye2" class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <button type="submit" class="btn-daftar">DAFTAR DAN MASUK PORTAL</button>

      <div class="bottom-section">
        <div class="divider-line" style="margin: 10px 0 8px;"></div>
        <div class="daftar-text">
          Sudah Punya Akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
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

  // sliding role selector with animation before navigate
  function slideTo(direction, url) {
    const slider = document.getElementById('roleSlider');
    const labelMhs = document.getElementById('labelMhs');
    const labelDsn = document.getElementById('labelDsn');
    if (direction === 'left') {
      slider.style.transform = 'translateX(0)';
      labelMhs.classList.add('active');
      labelDsn.classList.remove('active');
    } else {
      slider.style.transform = 'translateX(100%)';
      labelMhs.classList.remove('active');
      labelDsn.classList.add('active');
    }
    if (url) {
      setTimeout(function() { window.location.href = url; }, 300);
    }
  }
</script>
</body>
</html>
