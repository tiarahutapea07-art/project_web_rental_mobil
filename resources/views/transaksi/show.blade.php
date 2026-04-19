@extends('layouts.admin')

@section('content')
<style>
    .detail-wrap { max-width: 720px; }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 10px;
    }
    .page-header h1 {
        font-size: 22px;
        font-weight: 700;
        color: #1a2540;
        margin: 0;
    }
    .btn-back {
        background: #f3f4f6;
        color: #1a2540;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-back:hover { background: #e5e7eb; color: #1a2540; text-decoration: none; }

    .trx-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .trx-card-header {
        background: linear-gradient(135deg, #1a2540 0%, #2d3a5a 100%);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .trx-card-header .icon {
        width: 36px; height: 36px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
    }
    .trx-card-header .icon i { color: #fff; font-size: 16px; }
    .trx-card-header .label {
        font-size: 15px;
        font-weight: 600;
        color: #fff;
    }

    .trx-card-body { padding: 20px 24px; }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 540px) {
        .info-grid { grid-template-columns: 1fr; }
    }

    .info-item {}
    .info-item .info-label {
        font-size: 11px;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 4px;
    }
    .info-item .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a2540;
    }
    .info-item .info-value.money {
        color: #e84545;
        font-size: 17px;
    }

    .status-section {
        background: #f9fafb;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .status-label { font-size: 13px; color: #6b7280; font-weight: 500; }
    .badge-lunas {
        background: #dcfce7;
        color: #15803d;
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-belum {
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .summary-box {
        background: linear-gradient(135deg, #1a2540 0%, #2d3a5a 100%);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .summary-box .sum-label { font-size: 13px; color: rgba(255,255,255,0.7); margin-bottom: 4px; }
    .summary-box .sum-value { font-size: 26px; font-weight: 700; color: #fff; }
    .summary-box .sum-badge {
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        padding: 8px 16px;
        font-size: 13px;
        color: #fff;
        font-weight: 500;
    }

    .action-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-lunas-action {
        background: linear-gradient(90deg, #16a34a, #15803d);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: opacity 0.2s;
    }
    .btn-lunas-action:hover { opacity: 0.88; color: #fff; }
    .btn-print-action {
        background: #fff;
        color: #1a2540;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-print-action:hover { background: #f3f4f6; }
</style>

<div class="detail-wrap">

    {{-- Header --}}
    <div class="page-header">
        <h1> Detail Transaksi</h1>
        <a href="{{ route('transaksi.index') }}" class="btn-back">
            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
        </a>
    </div>

    {{-- Summary Box --}}
    <div class="summary-box">
        <div>
            <div class="sum-label">Total Pembayaran</div>
            <div class="sum-value">Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</div>
        </div>
        <div class="sum-badge">
            <i class="fas fa-receipt mr-1"></i>
            ID Transaksi #{{ $trx->id }}
        </div>
    </div>

    {{-- Data Penyewaan --}}
    <div class="trx-card">
        <div class="trx-card-header">
            <div class="icon"><i class="fas fa-car"></i></div>
            <span class="label">Data Penyewaan</span>
        </div>
        <div class="trx-card-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Customer</div>
                    <div class="info-value">{{ $trx->rental->customer->nama ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Mobil</div>
                    <div class="info-value">{{ $trx->rental->mobil->nama_mobil ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Sewa</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($trx->rental->tanggal_sewa)->format('d M Y') }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Kembali</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($trx->rental->tanggal_kembali)->format('d M Y') }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Lama Sewa</div>
                    <div class="info-value">{{ $trx->rental->lama_sewa }} hari</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Harga</div>
                    <div class="info-value money">
                        Rp {{ number_format($trx->rental->total_harga, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Pembayaran --}}
    <div class="trx-card">
        <div class="trx-card-header">
            <div class="icon"><i class="fas fa-credit-card"></i></div>
            <span class="label">Data Pembayaran</span>
        </div>
        <div class="trx-card-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Tanggal Bayar</div>
                    <div class="info-value">
                        {{ $trx->tanggal_bayar ? \Carbon\Carbon::parse($trx->tanggal_bayar)->format('d M Y') : '-' }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jumlah Bayar</div>
                    <div class="info-value money">
                        Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Metode Bayar</div>
                    <div class="info-value">{{ $trx->metode_bayar ?? '-' }}</div>
                </div>
            </div>

            {{-- Status --}}
            <div class="status-section">
                <span class="status-label"><i class="fas fa-info-circle mr-1"></i> Status Pembayaran</span>
                @if($trx->status_bayar == 'lunas')
                    <span class="badge-lunas">
                        <i class="fas fa-check-circle"></i> Lunas
                    </span>
                @else
                    <span class="badge-belum">
                        <i class="fas fa-clock"></i> Belum Lunas
                    </span>
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="action-row mt-3">
                @if($trx->status_bayar != 'lunas')
                <form action="{{ route('transaksi.lunas', $trx->id) }}" method="POST"
                      onsubmit="return confirm('Tandai transaksi ini sebagai lunas?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-lunas-action">
                        <i class="fas fa-check-circle"></i> Tandai Lunas
                    </button>
                </form>
                @endif
                <button class="btn-print-action" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </div>
    </div>

</div>
@endsection