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
                <form action="{{ url('/mobil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label>Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control @error('nama_mobil') is-invalid @enderror" 
                               value="{{ old('nama_mobil') }}" placeholder="Contoh: Toyota Avanza" required>
                        @error('nama_mobil')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Harga Per Hari (Rp)</label>
                        <input type="number" name="harga_per_hari" class="form-control @error('harga_per_hari') is-invalid @enderror" 
                               value="{{ old('harga_per_hari') }}" placeholder="Contoh: 350000" required>
                        @error('harga_per_hari')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Nomor Polisi</label>
                        <input type="text" name="no_polisi" class="form-control @error('no_polisi') is-invalid @enderror" 
                               value="{{ old('no_polisi') }}" placeholder="Contoh: B 1234 ABC" required>
                        @error('no_polisi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Foto Mobil</label>
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                        <small class="text-muted d-block mt-1">Format: jpg, jpeg, png, gif (Max: 2MB)</small>
                        @error('gambar')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Data Mobil
                    </button>
                    <a href="{{ url('/mobil') }}" class="btn btn-secondary btn-block mt-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection