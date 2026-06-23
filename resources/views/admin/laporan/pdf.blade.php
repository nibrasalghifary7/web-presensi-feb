{{--
    Template PDF Laporan Absensi (Admin)
    Format cetak rekapitulasi kehadiran mahasiswa.
--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; font-size: 11px; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 3px double #25429f; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 16px; color: #25429f; text-transform: uppercase; }
        .header h2 { margin: 5px 0 0 0; font-size: 14px; color: #25429f; }
        .header p { margin: 5px 0 0 0; font-size: 11px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #25429f; color: white; padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; }
        td { padding: 6px 10px; border-bottom: 1px solid #dee2e6; font-size: 10px; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; }
        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-warning { background-color: #fff3cd; color: #856404; }
        .badge-danger { background-color: #f8d7da; color: #721c24; }
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fakultas Ekonomi dan Bisnis</h1>
        <h2>UIN Syarif Hidayatullah Jakarta</h2>
        <p>LAPORAN REKAPITULASI KEHADIRAN MAHASISWA</p>
        <p>Dicetak: {{ now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th style="width: 100px;">NIM</th>
                <th>Nama Mahasiswa</th>
                <th class="text-center" style="width: 50px;">Hadir</th>
                <th class="text-center" style="width: 50px;">Izin</th>
                <th class="text-center" style="width: 50px;">Sakit</th>
                <th class="text-center" style="width: 50px;">Alpha</th>
                <th class="text-center" style="width: 60px;">Total</th>
                <th class="text-center" style="width: 70px;">% Hadir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $nim => $data)
                @php
                    $persen = $data['total'] > 0 ? round(($data['hadir'] / $data['total']) * 100, 1) : 0;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $nim }}</td>
                    <td>{{ $data['nama'] }}</td>
                    <td class="text-center">{{ $data['hadir'] }}</td>
                    <td class="text-center">{{ $data['izin'] }}</td>
                    <td class="text-center">{{ $data['sakit'] }}</td>
                    <td class="text-center">{{ $data['alpha'] }}</td>
                    <td class="text-center">{{ $data['total'] }}</td>
                    <td class="text-center">
                        <span class="badge {{ $persen >= 75 ? 'badge-success' : 'badge-danger' }}">{{ $persen }}%</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px; color: #999;">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total data: {{ $absensis->count() }} record</p>
    </div>
</body>
</html>
