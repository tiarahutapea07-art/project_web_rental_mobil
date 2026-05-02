@extends('layouts.admin')

@section('content')
<style>
.container-custom {
    max-width: 800px;
    margin: 30px auto;
}
.page-title {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #1A2744;
}
.filter-btn {
    background: #1A2744;
    color: #fff;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    text-decoration: none;
}
.trx-card {
    background: #fff;
    border-radius: 14px;
    padding: 18px 20px;
    margin-bottom: 16px;
    box-shadow: 0 4px 16px rgba(0,0,0,.07);
    transition: .2s;
    border: 1px solid #E5E7EB;
}
.trx-card:hover { transform: translateY(-3px); }

.trx-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}
.trx-kode {
    font-size: 11px;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}
.trx-title {
    font-size: 16px;
    font-weight: 800;
    color: #1A2744;
}
.trx-customer {
    font-size: 13px;
    color: #6B7280;
    margin-top: 2px;
}
.trx-price {
    font-size: 18px;
    font-weight: 800;
    color: #1A2744;
    text-align: right;
}

.trx-info {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    padding-top: 12px;
    border-top: 1px solid #f0f2f8;
    margin-bottom: 12px;
}
.info-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #6B7280;
}
.info-item i { color: #1A2744; font-size: 12px; }
.info-item strong { color: #374151; }

.trx-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Badge status */
.badge-lunas {
    background: #d1fae5; color: #065f46;
    padding: 4px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 700;
}
.badge-belum {
    background: #fee2e2; color: #991b1b;
    padding: 4px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 700;
}
.badge-pending {
    background: #fef3c7; color: #92400e;
    padding: 4px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 700;
}
.badge-konfirmasi {
    background: #e0e7ff; color: #3730a3;
    padding: 4px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 700;
}
.btn-detail {
    font-size: 12px;
    padding: 6px 16px;
    border-radius: 8px;
    background: #1A2744;
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s;
}
.btn-detail:hover { background: #243460; color: white; }
</style>

<div class="container-custom">

    <div class="page-title">Riwayat Transaksi</div>

    <div class="mb-3">
        <a href="#" class="filter-btn">Semua</a>
    </div>

    @forelse($transaksis as $transaksi)
    @php
        $rental  = $transaksi->rental;
        $mobil   = optional($rental->mobil);
        $customer = optional($rental->customer);
        $status = strtolower($transaksi->status_pembayaran ?? $transaksi->status_bayar ?? '');
@endphp

    <div class="trx-card">

        {{-- Header --}}
        <div class="trx-header">
            <div>
                <div class="trx-kode"># TRX-{{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}</div>
                <div class="trx-title">
                    <i class="fas fa-car" style="color:#F59E0B; margin-right:6px;"></i>
                    {{ $mobil->nama_mobil ?? '-' }}
                </div>
                
            </div>
            <div>
                <div class="trx-price">
                    Rp {{ number_format(optional($rental)->total_harga, 0, ',', '.') }}
                </div>
            </div>
        </div>

        {{-- Info Row --}}
        <div class="trx-info">
            <div class="info-item">
                <i class="fas fa-calendar-alt"></i>
                <span><strong>Sewa:</strong> {{ optional($rental)->tanggal_sewa ?? '-' }}</span>
            </div>
            <div class="info-item">
                <i class="fas fa-calendar-check"></i>
                <span><strong>Kembali:</strong> {{ optional($rental)->tanggal_kembali ?? '-' }}</span>
            </div>
            <div class="info-item">
                <i class="fas fa-clock"></i>
                <span><strong>Durasi:</strong> {{ optional($rental)->lama_sewa ?? '-' }} hari</span>
            </div>
        </div>

        {{-- Footer --}}
        <div class="trx-footer">
            @if($status === 'lunas')
                <span class="badge-lunas"><i class="fas fa-check-circle me-1"></i> Lunas</span>
            @elseif($status === 'belum' || $status === 'belum lunas')
                <span class="badge-belum"><i class="fas fa-times-circle me-1"></i> Belum Lunas</span>
            @elseif($status === 'pending')
                <span class="badge-pending"><i class="fas fa-hourglass-half me-1"></i> Pending</span>
            @elseif(str_contains($status, 'konfirmasi') || str_contains($status, 'menunggu'))
                <span class="badge-konfirmasi"><i class="fas fa-clock me-1"></i> Menunggu Konfirmasi</span>
            @else
                <span class="badge-pending">{{ ucfirst($status) }}</span>
            @endif

            <a href="{{ route('aktivitas.show', $transaksi->id) }}" class="btn-detail">
                <i class="fas fa-eye me-1"></i> Detail
            </a>
        </div>

    </div>
    @empty
    <div class="text-center py-5 text-muted">
        <i class="fas fa-folder-open fa-3x mb-3 d-block" style="opacity:0.3;"></i>
        Belum ada riwayat transaksi.
    </div>
    @endforelse

</div>
@endsection