@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">➕ Tambah Transaksi</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pilih Rental</label>
                    <select name="rental_id" class="form-control">
                        @foreach($rentals as $r)
                            <option value="{{ $r->id }}">
                                {{ $r->customer->nama }} - {{ $r->mobil->nama_mobil }} 
                                (Rp {{ number_format($r->total_harga) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Bayar</label>
                    <select name="metode_bayar" class="form-control">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>
</div>
@endsection