<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kas Masuk</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #ffffff;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2,
        h3,
        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            padding: 10px;
            border: 1px solid #1e1e1e;
            text-align: center;
            background-color: #14ff37;

        }

        td {
            padding: 10px;
            border: 1px solid #353535;
            text-align: center;
        }


        tr:nth-child(even) {
            background-color: #00e736;
        }

        @media only screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #000000;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #000000;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Laporan Kas Masuk</h2>
        </div>
        <h3>{{ config('app.company', 'Laravel') }}</h3>
        <h4>Periode {{ $tanggal_mulai }} - {{ $tanggal_selesai }}</h4>
        <table>
            <thead>
                <tr>
                    <th data-label="NoKasMasuk">No Kas Masuk</th>
                    <th data-label="NoBukti">No Bukti</th>
                    <th data-label="Tanggal">Tanggal</th>
                    <th data-label="Keterangan">Keterangan</th>
                    <th data-label="Total">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kasmasuk as $kas)
                    <tr>
                        <td>{{ $kas->no_kasmasuk }}</td>
                        <td>{{ $kas->no_bukti }}</td>
                        <td>{{ $kas->tgl }}</td>
                        <td>{{ $kas->deskripsi }}</td>
                        <td>Rp. {{ number_format($kas->jumlah, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr align="center">
                    <td colspan="4"><strong>Jumlah</strong></td>
                    <td><strong>Rp. {{ number_format($totalKeseluruhan, 2, ',', '.') }}</strong></td>

                </tr>
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            <br />
            <br /><br />

            <p><u><b>Ketua</b></u></p>
        </div>
    </div>
</body>

</html>
