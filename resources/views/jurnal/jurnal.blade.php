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
                {{-- <a href="{{ route('jurnal.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus-circle"></i> Tambah
                </a> --}}
                <h4 class="m-15 font-weight-bold text-center">{{ __('Daftar Entri Jurnal') }}<br/>Jurnal Umum<br/>{{ config('app.company', 'SIAKAS') }}<br/>Semua Priode</h4>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-bordered" cellspacing="1"><br />
                    <thead>
                        <tr align="center">
                            <th style="width: 15%">Tanggal/No Jurnal</th>
                            <th style="width: 30%">Keterangan</th>
                            <th style="width: 15%">Akun</th>
                            <th style="width: 20%">Debit</th>
                            <th style="width: 25%">Kredit</th>
                            <th style="width: 25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnals as $jurnal)
                            <tr align="center">
                                <td>{{ $jurnal->tgl }} /
                                {{ $jurnal->no_jurnal }}
                                </td>
                                <td>{{ $jurnal->keterangan }}</td>

                                <td>{{ $jurnal->debit }} <br /> {{ $jurnal->kredit }}</td>
                                <td>Rp. {{ number_format($jurnal->total, 2, ',', '.') }}<br />-</td>
                                <td>-<br /> Rp. {{ number_format($jurnal->total, 2, ',', '.') }}</td>
                                <td>
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $jurnal->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>


                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="confirmDeleteModal{{ $jurnal->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="{{ route('jurnal.destroy', $jurnal->id) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus ini? Harap berhati-hati bahwa data yang dihapus tidak dapat dikembalikan</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        @endforeach


                    </tbody>

                </table>

            </div>


        </div>

        <table class="table table-bordered" cellspacing="1"><br />
            <thead>
                <tr align="center">
                    <th style="width: 15%">Total</th>
                    <th style="width: 20%">Debit</th>
                    <th style="width: 25%">Kredit</th>
                </tr>
            </thead>
            <tbody>
                <tr align="center">
                    <td><strong>Total Jumlah</strong></td>
                    <td><strong>Rp. {{ number_format($totalDebit, 2, ',', '.') }}</strong></td>
                    <td><strong>Rp. {{ number_format($totalKredit, 2, ',', '.') }}</strong></td>
                </tr>


            </tbody>

        </table>


        <!-- Tombol Hapus Seluruh Isi Buku Besar -->
<div class="text-right mb-3">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmResetModal">
        <i class="fas fa-trash"></i> Reset Seluruh Isi Jurnal
    </button>
</div>
<!-- Modal Konfirmasi Reset -->
<div class="modal fade" id="confirmResetModal" tabindex="-1" role="dialog" aria-labelledby="confirmResetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('jurnal.reset') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmResetModalLabel">Konfirmasi Reset Periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus seluruh isi ? Data yang dihapus tidak dapat dikembalikan. Pastikan hasil Jurnal Umum priode sudah dibackup/download</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Semua</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
