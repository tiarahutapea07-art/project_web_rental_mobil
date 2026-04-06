@extends('layouts.admin')

@section('content')
<style>
    .rental-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .rental-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .rental-header h1 {
        margin: 0;
        font-weight: 700;
        font-size: 2rem;
    }

    .rental-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .rental-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .rental-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .rental-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: between;
        align-items: center;
    }

    .rental-card-header h5 {
        margin: 0;
        font-weight: 600;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-aktif {
        background: linear-gradient(135deg, #00b4db 0%, #0083b0 100%);
        color: white;
    }

    .status-selesai {
        background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
        color: white;
    }

    .status-dibatalkan {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }

    .rental-body {
        padding: 1.5rem;
    }

    .rental-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-weight: 600;
        color: #667eea;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 500;
    }

    .rental-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    .btn-return {
        background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-return:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(86, 171, 47, 0.4);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .empty-state i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        color: #666;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #999;
    }
</style>

<div class="rental-container">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="rental-header">
            <div>
                <h1><i class="fas fa-list mr-2"></i>Daftar Penyewaan</h1>
                <p>Kelola semua transaksi penyewaan mobil</p>
            </div>
        </div>

        @forelse($rentals as $rental)
        <div class="rental-card">
            <div class="rental-card-header">
                <h5>
                    <i class="fas fa-car mr-2"></i>{{ $rental->mobil->nama_mobil }}
                </h5>
                <span class="status-badge status-{{ $rental->status }}">
                    {{ ucfirst($rental->status) }}
                </span>
            </div>
            <div class="rental-body">
                <div class="rental-info">
                    <div class="info-item">
                        <span class="info-label">Customer</span>
                        <span class="info-value">{{ $rental->customer->nama }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Sewa</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Kembali</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Lama Sewa</span>
                        <span class="info-value">{{ $rental->lama_sewa }} hari</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Harga</span>
                        <span class="info-value">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
                @if($rental->status == 'aktif')
                <div class="rental-actions">
                    <form action="{{ route('rental.return', $rental->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn-return" onclick="return confirm('Apakah mobil sudah dikembalikan?');">
                            <i class="fas fa-undo mr-1"></i>Kembalikan
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h4>Belum Ada Penyewaan</h4>
            <p>Saat ini belum ada transaksi penyewaan yang tercatat dalam sistem.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection