@extends('layouts.admin')

@section('content')
<style>
.detail-wrap {
    max-width: 640px;
    margin: 30px auto;
    padding: 0 20px;
}

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
    margin-bottom: 20px;
}

.single-card {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid #E2E8F0;
    box-shadow: 0 4px 24px rgba(26,46,74,.10);
    overflow: hidden;
}

.card-hero {
    background: linear-gradient(135deg, #1A2E4A 0%, #243d63 100%);
    padding: 24px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.hero-value {
    font-size: 30px;
    font-weight: 800;
    color: #fff;
}

.section-title {
    padding: 16px 28px;
    background: #F8FAFC;
    border-top: 1.5px solid #E2E8F0;
    border-bottom: 1.5px solid #E2E8F0;
    font-size: 13px;
    font-weight: 700;
}

.info-body {
    padding: 20px 28px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.info-label {
    font-size: 11px;
    color: #9CA3AF;
    font-weight: 700;
}

.info-value {
    font-size: 15px;
    font-weight: 600;
}

.status-bar {
    margin: 16px 28px;
    padding: 14px 18px;
    border: 1.5px solid #E2E8F0;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
}

.bukti-wrap {
    text-align: center;
    margin-top: 15px;
}

.bukti-img {
    width: 250px;
    cursor: pointer;
    transition: 0.2s;
}

.bukti-img:hover {
    transform: scale(1.05);
}

.action-wrap {
    text-align: center;
    margin: 20px 0;
}

/* MODAL */
.img-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 60px;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.85);
}

.modal-content {
    max-width: 80%;
    max-height: 80%;
}

.close-btn {
    position: absolute;
    top: 20px;
    right: 40px;
    color: #fff;
    font-size: 35px;
    cursor: pointer;
}
</style>

<div class="detail-wrap">

<a href="{{ route('transaksi.index') }}" class="btn-back">
    ← Kembali
</a>

<div class="single-card">

    {{-- HEADER --}}
    <div class="card-hero">
        <div class="hero-value">
            Rp {{ number_format($transaksi->jumlah_bayar,0,',','.') }}
        </div>
        <div style="color:#fff;">
            ID #{{ $transaksi->id }}
        </div>
    </div>

    {{-- DATA PENYEWAAN --}}
    <div class="section-title">Data Penyewaan</div>
    <div class="info-body">
        <div class="info-grid">
            <div>
                <div class="info-label">Customer</div>
                <div class="info-value">{{ $transaksi->rental->customer->nama ?? '-' }}</div>
            </div>
            <div>
                <div class="info-label">Mobil</div>
                <div class="info-value">{{ $transaksi->rental->mobil->nama_mobil ?? '-' }}</div>
            </div>
            <div>
                <div class="info-label">Tanggal Sewa</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($transaksi->rental->tanggal_sewa)->format('d M Y') }}
                </div>
            </div>
            <div>
                <div class="info-label">Tanggal Kembali</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($transaksi->rental->tanggal_kembali)->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- DATA PEMBAYARAN --}}
    <div class="section-title">Data Pembayaran</div>
    <div class="info-body">
        <div class="info-grid">
            <div>
                <div class="info-label">Tanggal Bayar</div>
                <div class="info-value">
                    {{ $transaksi->tanggal_bayar ? \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('d M Y') : '-' }}
                </div>
            </div>
            <div>
                <div class="info-label">Metode Bayar</div>
                <div class="info-value">{{ $transaksi->metode_bayar ?? '-' }}</div>
            </div>
        </div>
    </div>

    {{-- STATUS --}}
    <div class="status-bar">
        <span>Status Pembayaran</span>
        @if($transaksi->status == 'lunas')
            <span class="badge-lunas">Lunas</span>
        @else
            <span class="badge-belum">Belum Lunas</span>
        @endif

    </div>

    {{-- BUKTI --}}
    <div class="bukti-wrap">
        @if($transaksi->bukti_pembayaran)
            <p><strong>Bukti Pembayaran</strong></p>
            <img src="{{ asset('bukti/'.$transaksi->bukti_pembayaran) }}" 
                 class="bukti-img"
                 onclick="openModal(this)">
        @else
            <p class="text-muted">Belum ada bukti pembayaran</p>
        @endif
    </div>

    {{-- ACTION --}}
    <div class="action-wrap">

        {{-- Tombol konfirmasi hanya kalau ada bukti --}}
        @if($transaksi->status_pembayaran != 'Lunas' && $transaksi->bukti_pembayaran)
        <form action="{{ route('transaksi.konfirmasi', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button class="btn btn-success">
                Konfirmasi Pembayaran
            </button>
        </form>
        @endif

        <br><br>

        {{-- CETAK --}}
        <button onclick="window.print()" class="btn btn-outline-dark">
            Cetak Nota
        </button>

    </div>

</div>
</div>

{{-- MODAL --}}
<div id="imgModal" class="img-modal" onclick="closeModal()">
    <span class="close-btn">&times;</span>
    <img class="modal-content" id="imgPreview">
</div>

<script>
function openModal(img) {
    document.getElementById("imgModal").style.display = "block";
    document.getElementById("imgPreview").src = img.src;
}

function closeModal() {
    document.getElementById("imgModal").style.display = "none";
}
</script>

@endsection
