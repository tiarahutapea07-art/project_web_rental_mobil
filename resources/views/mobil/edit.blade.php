@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Data Mobil</h1>
    <a href="{{ url('/mobil') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Mobil</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/mobil/' . $mobil->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label>Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control @error('nama_mobil') is-invalid @enderror" 
                               value="{{ old('nama_mobil', $mobil->nama_mobil) }}" placeholder="Contoh: Toyota Avanza" required>
                        @error('nama_mobil')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Harga Per Hari (Rp)</label>
                        <input type="number" name="harga_per_hari" class="form-control @error('harga_per_hari') is-invalid @enderror" 
                               value="{{ old('harga_per_hari', $mobil->harga_per_hari) }}" placeholder="Contoh: 350000" required>
                        @error('harga_per_hari')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Nomor Polisi</label>
                        <input type="text" name="no_polisi" class="form-control @error('no_polisi') is-invalid @enderror" 
                               value="{{ old('no_polisi', $mobil->no_polisi) }}" placeholder="Contoh: B 1234 ABC">
                        @error('no_polisi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="tersedia" {{ old('status', $mobil->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak tersedia" {{ old('status', $mobil->status) === 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
    <label>Gambar Mobil</label>
    {{-- Tampilkan gambar saat ini --}}
    @if($mobil->gambar)
        <div class="mb-2">
            <img src="{{ asset('img/' . $mobil->gambar) }}" 
                 style="height:100px; object-fit:contain; border-radius:8px; background:#f3f4f6; padding:4px;">
        </div>
    @endif
    <input type="file" name="gambar" class="form-control" accept="image/*">
    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
</div>

                    <hr>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Perbarui Data Mobil
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