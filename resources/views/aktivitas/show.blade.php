@extends('layouts.admin')

@section('content')
<style>
.detail-wrap {
    max-width: 650px;
    margin: 30px auto;
}

/* CARD */
.single-card {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid #E2E8F0;
    box-shadow: 0 4px 24px rgba(0,0,0,.08);
    overflow: hidden;
}

/* HEADER */
.card-hero {
    background: linear-gradient(135deg, #1A2E4A, #243d63);
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.hero-label {
    font-size: 12px;
    color: rgba(255,255,255,.6);
}
.hero-value {
    font-size: 28px;
    font-weight: 800;
    color: #fff;
}

/* SECTION */
.section-title {
    padding: 14px 24px;
    background: #F8FAFC;
    border-top: 1px solid #E5E7EB;
    border-bottom: 1px solid #E5E7EB;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* GRID */
.info-body {
    padding: 20px 24px;
}
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.info-label {
    font-size: 11px;
    color: #9CA3AF;
    font-weight: 700;
}
.info-value {
    font-size: 14px;
    font-weight: 600;
}

/* STATUS */
.status-bar {
    margin: 10px 24px;
    padding: 12px 16px;
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
}
.badge-lunas {
    background: rgba(34,197,94,.15);
    color: #16a34a;
    padding: 4px 12px;
    border-radius: 20px;
}
.badge-belum {
    background: rgba(239,68,68,.15);
    color: #dc2626;
    padding: 4px 12px;
    border-radius: 20px;
}

/* FLEX */
.flex-bukti {
    display: flex;
    flex-direction: column;
    gap: 18px;
    align-items: center;
    padding: 18px;
    border: 1px dashed #d1d5db;
    border-radius: 18px;
    background: #f8fafc;
}

/* BUKTI */
.bukti-img {
    width: 100%;
    max-width: 560px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 16px;
    box-shadow: 0 18px 40px rgba(15, 23, 42, .12);
    transition: transform .2s ease, box-shadow .2s ease;
}

.bukti-img:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 20px 45px rgba(15, 23, 42, .18);
}

/* MODAL */
.img-modal {
    display: none;
    position: fixed;
    z-index: 999;
    padding-top: 100px;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.8);
}
.modal-content {
    margin: auto;
    display: block;
    max-width: 80%;
}
.close-btn {
    position: absolute;
    top: 20px;
    right: 40px;
    color: #fff;
    font-size: 30px;
    cursor: pointer;
}
</style>

<div class="detail-wrap">

<a href="{{ route('aktivitas.index') }}" class="btn btn-light mb-3">
    ← Kembali
</a>

<div class="single-card">

    {{-- HEADER --}}
    <div class="card-hero">
        <div>
            <div class="hero-label">Total Pembayaran</div>
            <div class="hero-value">
                Rp {{ number_format(optional($transaksi->rental)->total_harga,0,',','.') }}
            </div>
        </div>
        <div style="color:#fff">#{{ $transaksi->id }}</div>
    </div>

    {{-- DATA PENYEWAAN --}}
    <div class="section-title">🚗 Data Penyewaan</div>

    <div class="info-body">
        <div class="info-grid">

            <div>
                <div class="info-label">Customer</div>
                <div class="info-value">
                    {{ optional($transaksi->rental->customer)->nama }}
                </div>
            </div>

            <div>
                <div class="info-label">Mobil</div>
                <div class="info-value">
                    {{ optional($transaksi->rental->mobil)->nama_mobil }}
                </div>
            </div>

            <div>
                <div class="info-label">Tanggal Sewa</div>
                <div class="info-value">
                    {{ optional($transaksi->rental)->tanggal_sewa }}
                </div>
            </div>

            <div>
                <div class="info-label">Tanggal Kembali</div>
                <div class="info-value">
                    {{ optional($transaksi->rental)->tanggal_kembali }}
                </div>
            </div>

            <div>
                <div class="info-label">Durasi</div>
                <div class="info-value">
                    @if(optional($transaksi->rental)->tanggal_sewa && optional($transaksi->rental)->tanggal_kembali)
                        {{ \Carbon\Carbon::parse($transaksi->rental->tanggal_sewa)
                        ->diffInDays($transaksi->rental->tanggal_kembali) }} hari
                    @else
                        -
                    @endif
                </div>
            </div>

            <div>
                <div class="info-label">Total Harga</div>
                <div class="info-value">
                    Rp {{ number_format(optional($transaksi->rental)->total_harga,0,',','.') }}
                </div>
            </div>

        </div>
    </div>

    {{-- DATA PEMBAYARAN --}}
    <div class="section-title">💳 Data Pembayaran</div>

    <div class="info-body">
        <div class="info-grid">
            <div>
                <div class="info-label">Metode</div>
                <div class="info-value">
                    {{ $transaksi->metode_bayar ? strtoupper($transaksi->metode_bayar) : '-' }}
                </div>
            </div>
        </div>
    </div>

    {{-- STATUS (SUDAH FIX) --}}
    <div class="status-bar">
        <span>Status Pembayaran</span>

        @if($transaksi->status_pembayaran == 'Lunas')
            <span class="badge-lunas">Lunas</span>
        @elseif($transaksi->status_pembayaran == 'Menunggu Konfirmasi')
            <span class="badge-warning">Menunggu</span>
        @else
            <span class="badge-belum">Belum Lunas</span>
        @endif
    </div>

    {{-- BUKTI + CETAK --}}
    <div class="info-body flex-bukti">

        @if($transaksi->bukti_pembayaran)
            <div style="text-align:center; width:100%;">
                <p class="bukti-title" style="margin-bottom:12px; font-size:15px; font-weight:700; color:#111827;">Bukti Pembayaran</p>
                <img src="{{ asset('bukti/'.$transaksi->bukti_pembayaran) }}"
                     class="bukti-img"
                     alt="Bukti Pembayaran"
                     onclick="openModal(this)">
                <p class="bukti-caption" style="margin-top:12px; font-size:13px; color:#6b7280;">Klik gambar untuk memperbesar bukti transfer / QRIS.</p>
            </div>
        @else
            <p class="text-muted">Belum ada bukti</p>
        @endif
       

        <!-- CETAK -->
        <div>
            @if($transaksi->status == 'lunas')
                <a href="{{ route('transaksi.print', $transaksi->id) }}" 
                   target="_blank"
                   class="btn btn-dark mt-4">
                   🖨️ Cetak Nota
                </a>
            @endif
        </div>

    </div>

</div>
</div>

{{-- MODAL --}}
<div id="imgModal" class="img-modal" onclick="closeModal()">
    <span class="close-btn">&times;</span>
    <img class="modal-content" id="imgPreview">
</div>

<script>
function openModal(img){
    document.getElementById("imgModal").style.display="block";
    document.getElementById("imgPreview").src=img.src;
}
function closeModal(){
    document.getElementById("imgModal").style.display="none";
}
</script>

@endsection
