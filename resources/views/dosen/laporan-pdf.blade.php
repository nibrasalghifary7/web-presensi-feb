{{--
    Template PDF Laporan Kehadiran (Dosen)
    Format cetak resmi untuk laporan kehadiran mahasiswa.
    Menggunakan inline CSS karena DomPDF tidak mendukung Tailwind CDN.
--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Kehadiran - {{ $jadwal->mataKuliah->nama_mk }}</title>
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
            border-bottom: 3px double #006633;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #006633;
            text-transform: uppercase;
        }
        .header h2 {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #006633;
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
            background-color: #006633;
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
    {{-- Header --}}
    <div class="header">
        <h1>Fakultas Ekonomi dan Bisnis</h1>
        <h2>UIN Syarif Hidayatullah Jakarta</h2>
        <p>LAPORAN KEHADIRAN MAHASISWA</p>
    </div>

    {{-- Info Mata Kuliah --}}
    <div class="info-box">
        <table>
            <tr>
                <td class="label">Mata Kuliah</td>
                <td>: {{ $jadwal->mataKuliah->nama_mk }} ({{ $jadwal->mataKuliah->sks }} SKS)</td>
            </tr>
            <tr>
                <td class="label">Kode Mata Kuliah</td>
                <td>: {{ $jadwal->mataKuliah->kode_mk }}</td>
            </tr>
            <tr>
                <td class="label">Dosen Pengampu</td>
                <td>: {{ $jadwal->dosen->nama }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: {{ $jadwal->kelas }}</td>
            </tr>
            <tr>
                <td class="label">Semester</td>
                <td>: {{ $jadwal->semester_aktif }}</td>
            </tr>
            <tr>
                <td class="label">Jadwal</td>
                <td>: {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }} WIB</td>
            </tr>
            <tr>
                <td class="label">Ruang</td>
                <td>: {{ $jadwal->ruang ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Tabel Rekap --}}
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
            @forelse($rekap as $nim => $absensis)
                @php
                    $mahasiswa = $absensis->first()->mahasiswa;
                    $hadir = $absensis->where('status', 'Hadir')->count();
                    $izin = $absensis->where('status', 'Izin')->count();
                    $sakit = $absensis->where('status', 'Sakit')->count();
                    $alpha = $absensis->where('status', 'Alpha')->count();
                    $total = $absensis->count();
                    $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $nim }}</td>
                    <td>{{ $mahasiswa->nama ?? '-' }}</td>
                    <td class="text-center">{{ $hadir }}</td>
                    <td class="text-center">{{ $izin }}</td>
                    <td class="text-center">{{ $sakit }}</td>
                    <td class="text-center">{{ $alpha }}</td>
                    <td class="text-center">
                        <span class="badge {{ $persen >= 75 ? 'badge-success' : 'badge-danger' }}">
                            {{ $persen }}%
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px; color: #999;">
                        Belum ada data kehadiran
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tanda Tangan --}}
    <div class="footer">
        <div class="signature">
            <p>Tangerang Selatan, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Dosen Pengampu,</p>
            <div class="ttd-space"></div>
            <p class="name">{{ $jadwal->dosen->nama }}</p>
            <p class="nip">NIDN: {{ $jadwal->dosen->nidn }}</p>
        </div>
    </div>
</body>
</html>
