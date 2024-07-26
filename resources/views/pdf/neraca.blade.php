<!DOCTYPE html>
<html>
<head>
    <title>Neraca Saldo</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Neraca Saldo</h1>
    <h2 style="text-align: center;">{{ config('app.company', 'SIAKAS') }}</h2>
    <h3 style="text-align: center;">{{ $tanggal_mulai->format('d M Y') }} - {{ $tanggal_selesai->format('d M Y') }}</h3>
    <table>
        <thead>
            <tr>
                <th>Akun</th>
                <th>Total Debit</th>
                <th>Total Kredit</th>
                <th>Total Jumlah Debit</th>
                <th>Total Jumlah Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($NeracaAll as $buku)
                @php
                    $selisih = $buku->totaldebit - $buku->totalkredit;
                    $jumlahDebit = $selisih > 0 ? $selisih : 0;
                    $jumlahKredit = $selisih < 0 ? abs($selisih) : 0;
                @endphp
                <tr>
                    <td>{{ $buku->akunneraca }}</td>
                    <td>Rp. {{ number_format($buku->totaldebit, 2, ',', '.') }}</td>
                    <td>Rp. {{ number_format($buku->totalkredit, 2, ',', '.') }}</td>
                    <td>{{ $jumlahDebit > 0 ? 'Rp. ' . number_format($jumlahDebit, 2, ',', '.') : '-' }}</td>
                    <td>{{ $jumlahKredit > 0 ? 'Rp. ' . number_format($jumlahKredit, 2, ',', '.') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th>Rp. {{ number_format($totalDebit, 2, ',', '.') }}</th>
                <th>Rp. {{ number_format($totalKredit, 2, ',', '.') }}</th>
                <th>Rp. {{ number_format($totalJumlahDebit, 2, ',', '.') }}</th>
                <th>Rp. {{ number_format($totalJumlahKredit, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
