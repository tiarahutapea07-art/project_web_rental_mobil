@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Customer</h1>
        <a href="{{ url('/customer') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Pelanggan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/customer/' . $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $customer->nama) }}" placeholder="Masukkan nama sesuai KTP" required>
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                                   value="{{ old('nik', $customer->nik) }}" placeholder="Contoh: 3201xxxxxxxxxxxx" required>
                            @error('nik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_telp">Nomor Telepon / WA</label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" 
                                   value="{{ old('no_telp', $customer->no_telp) }}" placeholder="Contoh: 08123456789" required>
                            @error('no_telp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" placeholder="Masukkan alamat domisili sekarang" required>{{ old('alamat', $customer->alamat) }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-block shadow-sm">
                            <i class="fas fa-save fa-sm text-white-50"></i> Perbarui Data Customer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
