@extends('layouts.admin')

@section('content')
<style>
.detail-wrap {
    max-width: 640px;
    margin: 0 auto;
}

/* Tombol Kembali */
.btn-back {
    background: #fff;
    color: #1A2E4A;
    border: 1.5px solid #E2E8F0;
    border-radius: 9px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all .18s;
    margin-bottom: 20px;
}
.btn-back:hover {
    border-color: #1A2E4A;
    color: #1A2E4A;
    text-decoration: none;
}

/* Card utama */
.single-card {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid #E2E8F0;
    box-shadow: 0 4px 24px rgba(26,46,74,.10);
    overflow: hidden;
}

/* Header card — navy gradient */
.card-hero {
    background: linear-gradient(135deg, #1A2E4A 0%, #243d63 100%);
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.card-hero-left .hero-label {
    font-size: 12px;
    color: rgba(255,255,255,.6);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .7px;
    margin-bottom: 6px;
}
.card-hero-left .hero-value {
    font-size: 30px;
    font-weight: 800;
    color: #fff;
}
.card-hero-right {
    background: rgba(255,255,255,.12);
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 7px;
}
.card-hero-right i { color: #F5A623; }

/* Divider section */
.section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px 28px 12px;
    background: #F8FAFC;
    border-top: 1.5px solid #E2E8F0;
    border-bottom: 1.5px solid #E2E8F0;
    font-size: 13px;
    font-weight: 700;
    color: #1A2E4A;
    text-transform: uppercase;
    letter-spacing: .6px;
}
.section-title i {
    width: 30px; height: 30px;
    background: #1A2E4A;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #F5A623;
    font-size: 13px;
    flex-shrink: 0;
}

/* Info grid */
.info-body { padding: 20px 28px; }
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}
@media (max-width: 480px) { .info-grid { grid-template-columns: 1fr; } }

.info-label {
    font-size: 11px;
    font-weight: 700;
    color: #9CA3AF;
    text-transform: uppercase;
    letter-spacing: .6px;
    margin-bottom: 4px;
}
.info-value {
    font-size: 15px;
    font-weight: 600;
    color: #1A2E4A;
}
.info-value.money {
    color: #F5A623;
    font-size: 16px;
}

/* Status bar */
.status-bar {
    margin: 4px 28px 0;
    background: #F8FAFC;
    border: 1.5px solid #E2E8F0;
    border-radius: 10px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.status-bar-label {
    font-size: 13px;
    font-weight: 600;
    color: #6B7A99;
    display: flex;
    align-items: center;
    gap: 7px;
}
.badge-lunas {
    background: rgba(34,197,94,.12);
    color: #16a34a;
    border-radius: 20px;
    padding: 5px 14px;
    font-size: 13px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.badge-belum {
    background: rgba(239,68,68,.12);
    color: #dc2626;
    border-radius: 20px;
    padding: 5px 14px;
    font-size: 13px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Action footer */
.card-footer-actions {
    padding: 18px 28px;
    border-top: 1.5px solid #E2E8F0;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.btn-lunas-action {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px; border-radius: 9px;
    background: #22C55E; color: #fff;
    border: none; font-family: inherit;
    font-size: 14px; font-weight: 700;
    cursor: pointer; transition: all .18s;
    text-decoration: none;
}
.btn-lunas-action:hover { background: #16a34a; transform: translateY(-1px); color: #fff; }
.btn-print-action {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px; border-radius: 9px;
    background: #fff; color: #1A2E4A;
    border: 1.5px solid #E2E8F0;
    font-family: inherit; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: all .18s;
}
.btn-print-action:hover { border-color: #1A2E4A; }
</style>

<div class="detail-wrap">

    {{-- Tombol Kembali --}}
    <a href="{{ route('transaksi.index') }}" class="btn-back">
        <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali
    </a>

    {{-- SINGLE CARD --}}
    <div class="single-card">

        {{-- Hero: Total Pembayaran --}}
        <div class="card-hero">
            <div class="card-hero-left">
                <div class="hero-label">Total Pembayaran</div>
                <div class="hero-value">Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</div>
            </div>
            <div class="card-hero-right">
                <i class="fas fa-receipt"></i>
                ID Transaksi #{{ $trx->id }}
            </div>
        </div>

        {{-- Section: Data Penyewaan --}}
        <div class="section-title">
            <i class="fas fa-car"></i>
            Data Penyewaan
        </div>
        <div class="info-body">
            <div class="info-grid">
                <div>
                    <div class="info-label">Customer</div>
                    <div class="info-value">{{ $trx->rental->customer->nama ?? '-' }}</div>
                </div>
                <div>
                    <div class="info-label">Mobil</div>
                    <div class="info-value">{{ $trx->rental->mobil->nama_mobil ?? '-' }}</div>
                </div>
                <div>
                    <div class="info-label">Tanggal Sewa</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($trx->rental->tanggal_sewa)->format('d M Y') }}</div>
                </div>
                <div>
                    <div class="info-label">Tanggal Kembali</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($trx->rental->tanggal_kembali)->format('d M Y') }}</div>
                </div>
                <div>
                    <div class="info-label">Lama Sewa</div>
                    <div class="info-value">{{ $trx->rental->lama_sewa }} hari</div>
                </div>
                <div>
                    <div class="info-label">Total Harga</div>
                    <div class="info-value money">Rp {{ number_format($trx->rental->total_harga, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- Section: Data Pembayaran --}}
        <div class="section-title">
            <i class="fas fa-credit-card"></i>
            Data Pembayaran
        </div>
        <div class="info-body">
            <div class="info-grid">
                <div>
                    <div class="info-label">Tanggal Bayar</div>
                    <div class="info-value">
                        {{ $trx->tanggal_bayar ? \Carbon\Carbon::parse($trx->tanggal_bayar)->format('d M Y') : '-' }}
                    </div>
                </div>
                <div>
                    <div class="info-label">Jumlah Bayar</div>
                    <div class="info-value money">Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</div>
                </div>
                <div>
                    <div class="info-label">Metode Bayar</div>
                    <div class="info-value">{{ $trx->metode_bayar ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Status Pembayaran --}}
        <div class="status-bar">
            <span class="status-bar-label">
                <i class="fas fa-circle-info"></i> Status Pembayaran
            </span>
            @if($trx->status_bayar == 'lunas')
                <span class="badge-lunas"><i class="fas fa-circle-check"></i> Lunas</span>
            @else
                <span class="badge-belum"><i class="fas fa-clock"></i> Belum Lunas</span>
            @endif
        </div>

        {{-- Footer Aksi --}}
        <div class="card-footer-actions">
            @if($trx->status_bayar != 'lunas')
            <form action="{{ route('transaksi.lunas', $trx->id) }}" method="POST"
                  onsubmit="return confirm('Tandai transaksi ini sebagai lunas?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-lunas-action">
                    <i class="fas fa-circle-check"></i> Tandai Lunas
                </button>
            </form>
            @endif
            <button class="btn-print-action" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>

    </div>{{-- /single-card --}}

</div>
@endsection