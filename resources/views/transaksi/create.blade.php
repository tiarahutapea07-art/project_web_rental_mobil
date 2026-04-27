@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">➕ Tambah Transaksi</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <!-- PILIH RENTAL -->
                <div class="mb-3">
                    <label class="form-label">Pilih Rental</label>
                    <select name="rental_id" class="form-control" required>
                        @foreach($rentals as $r)
                            <option value="{{ $r->id }}">
                                {{ $r->customer->nama }} - {{ $r->mobil->nama_mobil }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- TAMBAHAN WAJIB -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Sewa</label>
                    <input type="date" name="tanggal_sewa" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                </div>

                <!-- METODE -->
                <div class="mb-3">
                    <label>Metode Pembayaran</label>
                    <select name="metode_bayar" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="e-wallet">E-Wallet</option>
                    </select>
                </div>

                <!-- OPTIONAL -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>
</div>
@endsection
