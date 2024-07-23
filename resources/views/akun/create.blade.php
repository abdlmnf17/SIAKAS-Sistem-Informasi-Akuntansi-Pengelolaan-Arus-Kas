@extends('layouts.app')

@section('content')
<div class="col-lg-10 mb-10 mx-auto">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('akun.index') }}" class="btn btn-primary float-right">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h4 class="m-15 font-weight-bold">TAMBAH AKUN</h4>
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

            <form action="{{ route('akun.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_akun">Nama Akun:</label>
                    <input type="text" class="form-control" id="nama_akun" name="nama_akun" required>
                </div>
                <div class="form-group">
                    <label for="jenis_akun">Jenis:</label>
                    <input type="text" class="form-control" id="jenis_akun" name="jenis_akun" required>
                </div>
                <div class="form-group">
                    <label for="kode_akun">Kode Akun</label>
                    <input type="text" class="form-control" id="kode_akun" name="kode_akun" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
