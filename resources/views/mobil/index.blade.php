@extends('layouts.admin') {{-- Pastikan kamu punya file layout utama --}}

@section('content')
<div class="container-fluid pt-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Daftar Mobil</h1>
        <a href="{{ url('/mobil/create') }}" class="btn btn-primary shadow-sm">+ Tambah Mobil</a>
    </div>

    

    <div class="row justify-content-center">
        @foreach($mobils as $m)
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
                <div class="p-3 bg-light d-flex justify-content-center align-items-center"  style="height : 200px;">
                    @if($m->gambar)
                        <img src="{{ asset('img/' . $m->gambar) }}" class="img-fluid" alt="{{ $m->nama_mobil }}">
                    @else
      <div class="text-center text-muted">
            <i class="fas fa-car fa-4x mb-2"></i><br>
            <small>Gambar tidak tersedia</small>
        </div>
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="font-weight-bold text-dark text-uppercase">{{ $m->nama_mobil }}</h5>
                    
                    <div class="d-flex align-items-center mb-2">
                        <span class="text-primary font-weight-bold h5 mb-0">Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}</span>
                        <span class="text-muted ml-1"> / hari</span>
                    </div>

                    <div class="row text-muted small mb-3">
                        <div class="col-6">
                            <i class="fas fa-id-card"></i> {{ $m->no_polisi }}
                        </div>
                        <div class="col-6 text-right">
                            <span class="badge {{ $m->status == 'tersedia' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($m->status) }}
                            </span>
                        </div>
                    </div>

                    <p class="text-muted x-small" style="font-size: 0.8rem;">
                        Termasuk : Mobil + Sopir + BBM Durasi 12 Jam <br>
                        Sesuai ketersediaan unit dan ketentuan berlaku.
                    </p>

                    <div class="d-flex justify-content-between gap-2">
                        <a href="{{ url('/mobil/'.$m->id.'/edit') }}" class="btn btn-outline-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-primary btn-block ml-2">Sewa Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>