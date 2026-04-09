@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Data Transaksi</h3>
        <div class="alert alert-info mb-0 py-2 shadow-sm" style="border-radius: 10px;">
            <i class="fas fa-info-circle"></i> Transaksi tercatat otomatis dari penyewaan.
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm" style="border-radius: 15px; border: none;">
        <div class="card-body">

            <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3 shadow-sm" style="border-radius: 8px;">
                <i class="fas fa-plus"></i> Tambah Transaksi Manual
            </a>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Customer</th>
                            <th>Mobil</th>
                            <th>Total Sewa</th>
                            <th>Dibayar</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $trx)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $trx->rental->customer->nama }}</strong>
                            </td>
                            <td>{{ $trx->rental->mobil->nama_mobil }}</td>
                            <td class="fw-bold">Rp {{ number_format($trx->rental->total_harga, 0, ',', '.') }}</td>
                            <td class="text-success">Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($trx->status_bayar == 'lunas')
                                    <span class="badge bg-success" style="border-radius: 12px; padding: 6px 12px;">Lunas</span>
                                @else
                                    <span class="badge bg-danger" style="border-radius: 12px; padding: 6px 12px;">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <button class="btn btn-secondary btn-sm">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                Belum ada data transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection