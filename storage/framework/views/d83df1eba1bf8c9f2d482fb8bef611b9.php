
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Kehadiran - <?php echo e($jadwal->mataKuliah->nama_mk); ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #25429f;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #25429f;
            text-transform: uppercase;
        }
        .header h2 {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #25429f;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 11px;
            color: #666;
        }
        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 20px;
        }
        .info-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-box td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-box .label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data th {
            background-color: #25429f;
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        table.data td {
            padding: 6px 10px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }
        table.data tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table.data .text-center {
            text-align: center;
        }
        table.data .text-right {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        .footer .signature {
            text-align: center;
            width: 250px;
        }
        .footer .signature p {
            margin: 3px 0;
            font-size: 11px;
        }
        .footer .signature .name {
            font-weight: bold;
            text-decoration: underline;
        }
        .footer .signature .nip {
            font-size: 10px;
            color: #666;
        }
        .ttd-space {
            height: 60px;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <h1>Fakultas Ekonomi dan Bisnis</h1>
        <h2>UIN Syarif Hidayatullah Jakarta</h2>
        <p>LAPORAN KEHADIRAN MAHASISWA</p>
    </div>

    
    <div class="info-box">
        <table>
            <tr>
                <td class="label">Mata Kuliah</td>
                <td>: <?php echo e($jadwal->mataKuliah->nama_mk); ?> (<?php echo e($jadwal->mataKuliah->sks); ?> SKS)</td>
            </tr>
            <tr>
                <td class="label">Kode Mata Kuliah</td>
                <td>: <?php echo e($jadwal->mataKuliah->kode_mk); ?></td>
            </tr>
            <tr>
                <td class="label">Dosen Pengampu</td>
                <td>: <?php echo e($jadwal->dosen->nama); ?></td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: <?php echo e($jadwal->kelas); ?></td>
            </tr>
            <tr>
                <td class="label">Semester</td>
                <td>: <?php echo e($jadwal->semester_aktif); ?></td>
            </tr>
            <tr>
                <td class="label">Jadwal</td>
                <td>: <?php echo e($jadwal->hari); ?>, <?php echo e($jadwal->jam_mulai); ?> - <?php echo e($jadwal->jam_selesai); ?> WIB</td>
            </tr>
            <tr>
                <td class="label">Ruang</td>
                <td>: <?php echo e($jadwal->ruang ?? '-'); ?></td>
            </tr>
        </table>
    </div>

    
    <table class="data">
        <thead>
            <tr>
                <th class="text-center" style="width: 40px;">No</th>
                <th style="width: 120px;">NIM</th>
                <th>Nama Mahasiswa</th>
                <th class="text-center" style="width: 60px;">Hadir</th>
                <th class="text-center" style="width: 60px;">Izin</th>
                <th class="text-center" style="width: 60px;">Sakit</th>
                <th class="text-center" style="width: 60px;">Alpha</th>
                <th class="text-center" style="width: 70px;">Persen</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nim => $absensis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $mahasiswa = $absensis->first()->mahasiswa;
                    $hadir = $absensis->where('status', 'Hadir')->count();
                    $izin = $absensis->where('status', 'Izin')->count();
                    $sakit = $absensis->where('status', 'Sakit')->count();
                    $alpha = $absensis->where('status', 'Alpha')->count();
                    $total = $absensis->count();
                    $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;
                ?>
                <tr>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($nim); ?></td>
                    <td><?php echo e($mahasiswa->nama ?? '-'); ?></td>
                    <td class="text-center"><?php echo e($hadir); ?></td>
                    <td class="text-center"><?php echo e($izin); ?></td>
                    <td class="text-center"><?php echo e($sakit); ?></td>
                    <td class="text-center"><?php echo e($alpha); ?></td>
                    <td class="text-center">
                        <span class="badge <?php echo e($persen >= 75 ? 'badge-success' : 'badge-danger'); ?>">
                            <?php echo e($persen); ?>%
                        </span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px; color: #999;">
                        Belum ada data kehadiran
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    <div class="footer">
        <div class="signature">
            <p>Tangerang Selatan, <?php echo e(now()->translatedFormat('d F Y')); ?></p>
            <p>Dosen Pengampu,</p>
            <div class="ttd-space"></div>
            <p class="name"><?php echo e($jadwal->dosen->nama); ?></p>
            <p class="nip">NIDN: <?php echo e($jadwal->dosen->nidn); ?></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\ghifa's court\web-presensi-feb\resources\views\dosen\laporan-pdf.blade.php ENDPATH**/ ?>