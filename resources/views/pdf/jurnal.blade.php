<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jurnal Umum</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Daftar Entri Jurnal</h1>
    <h2 style="text-align: center;">Jurnal Umum</h2>
    <h3 style="text-align: center;">{{ config('app.company', 'SIAKAS') }}</h3>
    <h4 style="text-align: center;">Priode: {{ $tanggal_mulai->format('d M Y') }} - {{ $tanggal_selesai->format('d M Y') }}</h4>
    <table>
        <thead>
            <tr>
                <th>Tanggal/No Jurnal</th>
                <th>Keterangan</th>
                <th>Akun</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurnals as $jurnal)
                <tr>
                    <td>{{ $jurnal->tgl }} / {{ $jurnal->no_jurnal }}</td>
                    <td>{{ $jurnal->keterangan }}</td>
                    <td>{{ $jurnal->debit }} <br /> {{ $jurnal->kredit }}</td>
                    <td>Rp. {{ number_format($jurnal->total, 2, ',', '.') }}</td>
                    <td>Rp. {{ number_format($jurnal->total, 2, ',', '.') }}</td>
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
                <td><strong>Rp. {{ number_format($totalKeseluruhan, 2, ',', '.') }}</strong></td>
                <td><strong>Rp. {{ number_format($totalKeseluruhan, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
