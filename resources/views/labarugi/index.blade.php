@extends('layouts.app')

@section('content')
    <div class="col-lg-11 mb-11 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-15 font-weight-bold text-center">{{ __('Laporan Laba Rugi') }}<br/>{{ config('app.company', 'SIAKAS') }}<br/>Periode: {{ config('app.priode', 'Laravel') }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
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
            </div>
        </div>
    </div>
@endsection
