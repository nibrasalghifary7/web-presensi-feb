<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Izin Tidak Masuk</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Times New Roman', serif;
      font-size: 12pt;
      color: #000;
      line-height: 1.6;
    }
    .page {
      padding: 60px 70px;
      width: 210mm;
      min-height: 297mm;
    }

    /* Header */
    .header {
      text-align: center;
      border-bottom: 3px double #000;
      padding-bottom: 16px;
      margin-bottom: 24px;
    }
    .header .logo {
      width: 70px;
      height: 70px;
      margin: 0 auto 8px;
    }
    .header h2 {
      font-size: 14pt;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 2px;
    }
    .header h3 {
      font-size: 13pt;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 2px;
    }
    .header p {
      font-size: 10pt;
      color: #333;
    }
    .header .alamat {
      font-size: 9pt;
      margin-top: 4px;
    }

    /* Info surat */
    .info-surat {
      margin-top: 24px;
      margin-bottom: 20px;
    }
    .info-surat table {
      font-size: 12pt;
    }
    .info-surat table td {
      padding: 2px 0;
      vertical-align: top;
    }
    .info-surat table td:first-child {
      width: 120px;
    }

    /* Isi surat */
    .isi {
      text-align: justify;
      margin-bottom: 20px;
      text-indent: 40px;
    }

    /* Tabel detail */
    .detail-table {
      width: 100%;
      border-collapse: collapse;
      margin: 16px 0 24px 40px;
      font-size: 12pt;
    }
    .detail-table td {
      padding: 4px 0;
      vertical-align: top;
    }
    .detail-table td:first-child {
      width: 160px;
      font-weight: normal;
    }
    .detail-table td:nth-child(2) {
      width: 15px;
    }

    /* Tanda tangan */
    .ttd-section {
      margin-top: 40px;
      display: flex;
      justify-content: flex-end;
    }
    .ttd-box {
      text-align: center;
      width: 250px;
    }
    .ttd-box .tanggal {
      margin-bottom: 60px;
    }
    .ttd-box .nama {
      font-weight: bold;
      text-decoration: underline;
    }
    .ttd-box .nidn {
      font-size: 11pt;
    }

    /* Footer */
    .footer-note {
      margin-top: 40px;
      font-size: 10pt;
      color: #555;
      border-top: 1px solid #ccc;
      padding-top: 10px;
    }
    .footer-note p {
      margin-bottom: 2px;
    }
  </style>
</head>
<body>
  <div class="page">

    <!-- Header -->
    <div class="header">
      <img class="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==" alt="Logo UIN">
      <h2>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h2>
      <h3>UNIVERSITAS ISLAM NEGERI (UIN) SYARIF HIDAYATULLAH JAKARTA</h3>
      <h3>FAKULTAS EKONOMI DAN BISNIS</h3>
      <p>Jl. Ir. H. Juanda No. 95, Ciputat, Tangerang Selatan, Banten 15412</p>
      <p class="alamat">Telepon: (021) 7424194 &nbsp;|&nbsp; Email: feb@uinjkt.ac.id &nbsp;|&nbsp; Website: feb.uinjkt.ac.id</p>
    </div>

    <!-- Judul -->
    <h3 style="text-align:center; text-decoration:underline; margin-bottom:24px; font-size:13pt;">
      SURAT IZIN TIDAK MASUK MENGAJAR
    </h3>

    <!-- Info Surat -->
    <div class="info-surat">
      <table>
        <tr>
          <td>Nomor</td>
          <td>:</td>
          <td><?php echo e($nomor ?? '001/FEB-UIN/VI/2026'); ?></td>
        </tr>
        <tr>
          <td>Lampiran</td>
          <td>:</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td>:</td>
          <td><strong>Izin Tidak Masuk Mengajar</strong></td>
        </tr>
      </table>
    </div>

    <!-- Kepada -->
    <div style="margin-bottom:16px;">
      <p>Kepada Yth.</p>
      <p style="margin-left:20px;">Dekan Fakultas Ekonomi dan Bisnis</p>
      <p style="margin-left:20px;">UIN Syarif Hidayatullah Jakarta</p>
      <p style="margin-left:20px;">di Tempat</p>
    </div>

    <!-- Isi -->
    <p class="isi">
      Dengan hormat, saya yang bertanda tangan di bawah ini:
    </p>

    <table class="detail-table">
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?php echo e($dosen->nama ?? 'Sucayono, S.E., M.Sc.'); ?></td>
      </tr>
      <tr>
        <td>NIDN</td>
        <td>:</td>
        <td><?php echo e($dosen->nidn ?? '0123456789'); ?></td>
      </tr>
      <tr>
        <td>Bidang Keahlian</td>
        <td>:</td>
        <td><?php echo e($dosen->bidang_keahlian ?? 'Sistem Informasi Manajemen'); ?></td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>Dosen Tetap</td>
      </tr>
    </table>

    <p class="isi">
      Dengan ini mengajukan izin untuk tidak melaksanakan kegiatan mengajar pada hari ini,
      <strong><?php echo e($tanggal ?? now()->translatedFormat('l, d F Y')); ?></strong>,
      dikarenakan <strong><?php echo e($alasan ?? 'keperluan pribadi yang tidak dapat ditinggalkan'); ?></strong>.
    </p>

    <p class="isi">
      Demikian surat izin ini saya buat dengan sebenarnya. Atas perhatian dan kebijaksanaan Bapak/Ibu Dekan,
      saya ucapkan terima kasih.
    </p>

    <!-- Tanda tangan -->
    <div class="ttd-section">
      <div class="ttd-box">
        <p class="tanggal">Ciputat, <?php echo e($tanggal ?? now()->translatedFormat('d F Y')); ?></p>
        <p style="margin-bottom:60px;"></p>
        <p class="nama"><?php echo e($dosen->nama ?? 'Sucayono, S.E., M.Sc.'); ?></p>
        <p class="nidn">NIDN. <?php echo e($dosen->nidn ?? '0123456789'); ?></p>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer-note">
      <p>Dokumen ini dicetak secara otomatis oleh sistem M-Presence FEB.</p>
      <p>Fakultas Ekonomi dan Bisnis — UIN Syarif Hidayatullah Jakarta</p>
    </div>

  </div>
</body>
</html>
<?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/pdf/surat-izin.blade.php ENDPATH**/ ?>