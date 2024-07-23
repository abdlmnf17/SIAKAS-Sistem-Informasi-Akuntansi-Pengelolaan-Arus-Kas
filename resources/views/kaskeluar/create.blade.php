@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{ route('kaskeluar.index') }}" class="btn btn-primary float-right">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h4 class="m-15 font-weight-bold">TAMBAH TRANSAKSI KAS KELUAR</h4>
                    </div>


                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kaskeluar.store') }}" method="POST" id="transaksiForm">
                            @csrf

                            <div class="form-group">
                                <label for="no_kaskeluar">No Kas Keluar:</label>
                                <!-- Hidden input field untuk menyimpan nomor transaksi yang telah digenerate -->
                                <input type="hidden" name="no_trans_generated" id="no_trans_generated"
                                    value="{{ old('no_trans_generated') }}">
                                <!-- Input field untuk menampilkan nomor transaksi di form -->
                                <input type="text" name="no_kaskeluar" id="no_kaskeluar" class="form-control"
                                    value="{{ $no_kaskeluar }}" required>
                            </div>

                            <div class="form-group">
                                <label for="no_bukti">No Bukti Transaksi</label>
                                <input type="text" name="no_bukti" id="no_bukti" class="form-control" value="{{ old('no_bukti')}}">
                            </div>

                            <div class="form-group">
                                <label for="tgl">Tanggal:</label>
                                <input type="date" name="tgl" id="tgl" class="form-control"
                                    value="{{ old('tgl') }}">
                            </div>


                            <div class="form-group">
                                <label for="keterangan">Keterangan:</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control"
                                    value="{{ old('keterangan') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sumber">Sumber :</label>
                                <input type="text" name="sumber" id="sumber" class="form-control"
                                    value="{{ old('sumber') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah Total:</label>
                                <input type="number" name="jumlah" id="total" class="form-control"
                                    value="{{ old('jumlah') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="debit">Akun Debit:</label>
                                <select name="debit" class="form-control" id="debit" required>
                                    <option value="">Pilih Akun</option>
                                    @foreach ($akuns as $akun)
                                        <option value="{{ $akun->nama_akun }}">{{ $akun->nama_akun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kredit">Akun Kredit:</label>
                                <select name="kredit" class="form-control" id="kredit" required>
                                    <option value="">Pilih Akun</option>
                                    @foreach ($akuns as $akun)
                                        <option value="{{ $akun->nama_akun }}">{{ $akun->nama_akun }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" id="showConfirmModal" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah data sudah benar diisi?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var showConfirmModalButton = document.getElementById('showConfirmModal');
            var confirmSubmitButton = document.getElementById('confirmSubmit');
            var transaksiForm = document.getElementById('transaksiForm');


            showConfirmModalButton.addEventListener('click', function() {
                $('#confirmModal').modal('show');
            });

            confirmSubmitButton.addEventListener('click', function() {
                transaksiForm.submit();
            });
        });
    </script>
@endsection
