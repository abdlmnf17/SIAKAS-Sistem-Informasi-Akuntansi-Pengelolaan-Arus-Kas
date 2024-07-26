<!DOCTYPE html>
<html>
<head>
    <title>Laporan Laba Rugi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Laba Rugi</h1>
    <h2 style="text-align: center;">{{ config('app.company', 'SIAKAS') }}</h2>
    <h3 style="text-align: center;">Periode: {{ $tanggal_mulai->format('d M Y') }} - {{ $tanggal_selesai->format('d M Y') }}</h3>
    <table>
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Pendapatan</td>
                <td>Rp. {{ number_format($pendapatan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Beban</td>
                <td>Rp. {{ number_format($beban, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Laba Bersih</strong></td>
                <td><strong>Rp. {{ number_format($labaBersih, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
