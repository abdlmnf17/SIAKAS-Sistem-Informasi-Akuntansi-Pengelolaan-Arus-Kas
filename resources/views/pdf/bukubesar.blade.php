<!DOCTYPE html>
<html>
<head>
    <title>Laporan Buku Besar</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Daftar Buku Besar</h1>
    <h2 style="text-align: center;">{{ config('app.company', 'SIAKAS') }}</h2>
    <h3 style="text-align: center;">{{ $tanggal_mulai->format('d M Y') }} - {{ $tanggal_selesai->format('d M Y') }}</h3>
    <table>
        <thead>
            <tr>
                <th>Akun Buku Besar</th>
                <th>Ref</th>
                <th>Keterangan</th>
                <th>Total Debit</th>
                <th>Total Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($BukuBesarAll as $buku)
                <tr>
                    <td>{{ $buku->akunbukubesar }}</td>
                    <td>{{ $buku->ref }}</td>
                    <td>{{ $buku->keterangan }}</td>
                    <td>Rp. {{ number_format($buku->totaldebit, 2, ',', '.') }}</td>
                    <td>Rp. {{ number_format($buku->totalkredit, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br/>
    <table>
        <thead>
            <tr>
                <th>Total</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total Jumlah</strong></td>
                <td><strong>Rp. {{ number_format($totalDebit, 2, ',', '.') }}</strong></td>
                <td><strong>Rp. {{ number_format($totalKredit, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
