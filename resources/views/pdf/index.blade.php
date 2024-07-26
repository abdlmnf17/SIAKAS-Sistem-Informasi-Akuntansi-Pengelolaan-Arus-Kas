@extends('layouts.app')

@section('content')
    <div class="col-lg-9 mb-4 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-15 font-weight-bold">{{ __('Cetak Semua Laporan ') }}</h4>
            </div>
            <div class="card-body">


                <div class="card-header py-3">
                    <h5 class="m-15 font-weight-bold">{{ __('Kas Masuk') }}</h5>
                </div>
                <br />
                <form action="{{ route('pdf.kasmasuk') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-4">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <br />
                <div class="card-header py-3">
                    <h5 class="m-15 font-weight-bold">{{ __('Kas Keluar') }}</h5>
                </div>
                <br />
                <form action="{{ route('pdf.kaskeluar') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-4">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <br />

                <div class="card-header py-3">
                    <h5 class="m-15 font-weight-bold">{{ __('Jurnal Umum') }}</h5>
                </div>
                <br />
                <form action="{{ route('pdf.jurnal') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-4">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <br />
                <div class="card-header py-3">
                    <h5 class="m-15 font-weight-bold">{{ __('Buku Besar') }}</h5>
                </div>
                <br />
                <form action="{{ route('pdf.bukubesar') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-4">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <br />
                <div class="card-header py-3">
                    <h5 class="m-15 font-weight-bold">{{ __('Neraca Saldo') }}</h5>
                </div>
                <br />
                <form action="{{ route('pdf.neraca') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-4">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <br />
                <div class="card-header py-3">
                    <h5 class="m-15 font-weight-bold">{{ __('Laporan Keuangan Rugi Laba') }}</h5>
                </div>
                <br />
                <form action="{{ route('pdf.rugilaba') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-4">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                        </div>
                    </div>
                </form>
                <br />
                <br />
            </div>



        </div>
    </div>
@endsection
