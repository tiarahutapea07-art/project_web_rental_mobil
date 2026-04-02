@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Mobil Baru</h1>
    <a href="{{ url('/mobil') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-6"> {{-- Membuat form hanya memakan setengah lebar layar agar tidak terlalu lebar --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Input</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/mobil') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Toyota Avanza" required>
                    </div>

                    <div class="form-group">
                        <label>Harga Per Hari (Rp)</label>
                        <input type="number" name="harga_per_hari" class="form-control" placeholder="Contoh: 350000" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Polisi </label>
                        <input type="text" name="no_polisi" class="form-control" placeholder="Contoh: B 1234 ABC">
                    </div>

                    <div class="form-group">
                        <label>Foto Mobil</label>
                        <input type="file" name="gambar" class="from-control">
                        <small class="text-muted">Format: jpg, jpeg, png. </small>

                    </div>

                

                    <hr>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Data Mobil
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection