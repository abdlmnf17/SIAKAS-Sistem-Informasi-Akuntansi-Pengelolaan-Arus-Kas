@extends('layouts.app')

@section('content')
    <div class="col-lg-11 mb-11 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-15 font-weight-bold text-center">{{ __('Detail Kas Masuk') }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                      
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $kasMasuk->tgl }}</td>
                        </tr>
                        <tr>
                            <th>No. Kas Masuk</th>
                            <td>{{ $kasMasuk->no_kasmasuk }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $kasMasuk->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>No. Bukti</th>
                            <td>{{ $kasMasuk->no_bukti }}</td>
                        </tr>
                        <tr>
                            <th>Sumber</th>
                            <td>{{ $kasMasuk->sumber }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp. {{ number_format($kasMasuk->jumlah, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $kasMasuk->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui Pada</th>
                            <td>{{ $kasMasuk->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('kasmasuk.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
