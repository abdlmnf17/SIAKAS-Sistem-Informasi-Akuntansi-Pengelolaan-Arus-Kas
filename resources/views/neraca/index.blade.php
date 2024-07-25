@extends('layouts.app')

@section('content')
    <div class="col-lg-11 mb-11 mx-auto">
        <!-- Menampilkan pesan kesuksesan -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="success">&times;</button>
                {{ session('success') }}.
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <strong>Gagal ditambahkan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <br />
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-15 font-weight-bold text-center">{{ __('Neraca Saldo') }}<br/>{{ config('app.company', 'SIAKAS') }}<br/>Semua Priode</h4>
            </div>
            <div class="card-body">
                @php
                    $totalJumlahDebit = 0;
                    $totalJumlahKredit = 0;
                @endphp
                <table id="dataTable" class="table table-bordered" cellspacing="1"><br />
                    <thead>
                        <tr align="center">
                            <th style="width: 20%">Akun</th>
                            <th style="width: 20%">Total Debit</th>
                            <th style="width: 20%">Total Kredit</th>
                            <th style="width: 20%">Total Jumlah Debit</th>
                            <th style="width: 20%">Total Jumlah Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($neraca as $buku)
                            @php
                                $selisih = $buku->totaldebit - $buku->totalkredit;
                                $jumlahDebit = $selisih > 0 ? $selisih : 0;
                                $jumlahKredit = $selisih < 0 ? abs($selisih) : 0;
                                $totalJumlahDebit += $jumlahDebit;
                                $totalJumlahKredit += $jumlahKredit;
                            @endphp
                            <tr align="center">
                                <td>{{ $buku->akunneraca }}</td>
                                <td>Rp. {{ number_format($buku->totaldebit, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($buku->totalkredit, 2, ',', '.') }}</td>
                                <td>{{ $jumlahDebit > 0 ? 'Rp. ' . number_format($jumlahDebit, 2, ',', '.') : '-' }}</td>
                                <td>{{ $jumlahKredit > 0 ? 'Rp. ' . number_format($jumlahKredit, 2, ',', '.') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr align="center">
                            <th>Total</th>
                            <th>Rp. {{ number_format($totalDebit, 2, ',', '.') }}</th>
                            <th>Rp. {{ number_format($totalKredit, 2, ',', '.') }}</th>
                            <th>Rp. {{ number_format($totalJumlahDebit, 2, ',', '.') }}</th>
                            <th>Rp. {{ number_format($totalJumlahKredit, 2, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
