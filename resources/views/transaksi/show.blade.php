@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">📄 Detail Transaksi</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">🚗 Data Penyewaan</h5>
            <p><strong>Customer:</strong> {{ $trx->rental->customer->nama }}</p>
            <p><strong>Mobil:</strong> {{ $trx->rental->mobil->nama_mobil }}</p>
            <p><strong>Tanggal Sewa:</strong> {{ $trx->rental->tanggal_sewa }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $trx->rental->tanggal_kembali }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($trx->rental->total_harga) }}</p>

            <hr>

            <h5 class="mb-3">💳 Pembayaran</h5>
            <p><strong>Tanggal Bayar:</strong> {{ $trx->tanggal_bayar }}</p>
            <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($trx->jumlah_bayar) }}</p>
            <p><strong>Metode:</strong> {{ $trx->metode_bayar }}</p>
            <p><strong>Status:</strong>
                @if($trx->status_bayar == 'lunas')
                    <span class="badge bg-success">Lunas</span>
                @else
                    <span class="badge bg-danger">Belum Lunas</span>
                @endif
            </p>

            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection