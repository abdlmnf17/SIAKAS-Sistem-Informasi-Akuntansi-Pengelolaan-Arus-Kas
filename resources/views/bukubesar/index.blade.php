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
                <h4 class="m-15 font-weight-bold text-center">{{ __('Daftar Buku Besar') }}<br/>{{ config('app.company', 'SIAKAS') }}<br/>{{ config('app.priode', 'Laravel') }}</h4>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-bordered" cellspacing="1"><br />
                    <thead>
                        <tr align="center">
                            <th style="width: 20%">Akun Buku Besar</th>
                            <th style="width: 15%">Ref</th>
                            <th style="width: 25%">Keterangan</th>
                            <th style="width: 20%">Total Debit</th>
                            <th style="width: 20%">Total Kredit</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukubesar as $buku)
                            <tr align="center">
                                <td>{{ $buku->akunbukubesar }}</td>
                                <td>{{ $buku->ref }}</td>
                                <td>{{ $buku->keterangan }}</td>
                                <td>Rp. {{ number_format($buku->totaldebit, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($buku->totalkredit, 2, ',', '.') }}</td>
                                <td>
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $buku->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="confirmDeleteModal{{ $buku->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="{{ route('bukubesar.destroy', $buku->id) }}">
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
        <i class="fas fa-trash"></i> Reset Seluruh Isi Buku Besar
    </button>
</div>
<!-- Modal Konfirmasi Reset -->
<div class="modal fade" id="confirmResetModal" tabindex="-1" role="dialog" aria-labelledby="confirmResetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('bukubesar.reset') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmResetModalLabel">Konfirmasi Reset Periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus seluruh isi buku besar? Data yang dihapus tidak dapat dikembalikan. Pastikan hasil buku besar priode sudah dibackup/download</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </div>
@endsection
