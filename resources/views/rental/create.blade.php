@extends('layouts.admin')

@section('content')
<style>
    .mobil-card {
        background: linear-gradient(135deg, #1A2E4A 0%, #243d63 100%);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .mobil-icon {
        width: 60px; height: 60px;
        border-radius: 14px;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .mobil-badge {
        display: inline-block;
        background: rgba(245,166,35,0.25);
        color: #bd882d;
        font-size: 10px; font-weight: 700;
        letter-spacing: 1px; text-transform: uppercase;
        padding: 3px 10px; border-radius: 20px;
        margin-bottom: 6px;
    }
    .mobil-name { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 4px; }
    .mobil-meta { font-size: 13px; color: rgba(255,255,255,0.75); display: flex; gap: 16px; flex-wrap: wrap; }
    .mobil-meta span { display: flex; align-items: center; gap: 5px; }
    .dot { width: 6px; height: 6px; border-radius: 50%; background: #F5A623; display: inline-block; }

    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(26,46,74,.09);
        overflow: hidden;
        margin-bottom: 20px;
        border: 1.5px solid #E2E8F0;
    }
    .form-card-header {
        padding: 16px 24px;
        border-bottom: 1.5px solid #E2E8F0;
        display: flex; align-items: center; gap: 10px;
        background: #F8FAFC;
    }
    .header-icon {
        width: 32px; height: 32px;
        border-radius: 8px; background: #1A2E4A;
        display: flex; align-items: center; justify-content: center;
    }
    .header-icon i { color: #F5A623; font-size: 14px; }
    .form-card-header .title { font-size: 14px; font-weight: 700; color: #1A2E4A; }
    .form-card-body { padding: 24px; }

    .field-group {
        display: grid;
        grid-template-columns: 180px 1fr;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }
    .field-group.top { align-items: flex-start; }
    .field-label { font-size: 13px; font-weight: 600; color: #1A2E4A; padding-top: 2px; }
    .field-group.top .field-label { padding-top: 10px; }

    .form-card-body .form-control,
    .form-card-body .form-select {
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        background: #F8FAFC;
        color: #1A2E4A;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .form-card-body .form-control:focus,
    .form-card-body .form-select:focus {
        border-color: #1A2E4A;
        box-shadow: 0 0 0 3px rgba(26,46,74,.08);
        background: #fff;
        outline: none;
    }

    /* Metode bayar radio pills */
    .metode-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .metode-pill input[type="radio"] { display: none; }
    .metode-pill label {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        font-size: 13px; font-weight: 600; color: #151616;
        cursor: pointer;
        transition: all .18s;
        user-select: none;
    }
    .metode-pill label:hover { border-color: #1A2E4A; color: #1A2E4A; }
    .metode-pill input[type="radio"]:checked + label {
        background: #1A2E4A;
        border-color: #1A2E4A;
        color: #fff;
        box-shadow: 0 4px 12px rgba(26,46,74,.2);
    }
    .metode-pill input[type="radio"]:checked + label .pill-icon { color: #F5A623; }
    .pill-icon { font-size: 15px; }

    .section-divider {
        border: none;
        border-top: 1.5px dashed #E2E8F0;
        margin: 4px 0 20px;
    }

    /* Ringkasan biaya */
    .summary-box {
        background:#1b3b68 ;
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 24px;
    }
    .summary-title {
        font-size: 11px; font-weight: 700;
        color: #F5A623;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 14px;
        display: flex; align-items: center; gap: 6px;
    }
    .summary-row {
        display: flex; justify-content: space-between;
        font-size: 13px; color: rgba(255,255,255,.7);
        margin-bottom: 8px;
    }
    .summary-row strong { color: #fff; }
    .summary-divider { border: none; border-top: 1px solid rgba(255,255,255,.15); margin: 10px 0; }
    .summary-total {
        display: flex; justify-content: space-between;
        font-size: 17px; font-weight: 800; color: #F5A623;
    }

    .btn-row { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
    .btn-confirm {
        display: inline-flex; align-items: center; gap: 8px;
        background: #1A2E4A; color: #f7f4f4;
        border: none; border-radius: 10px;
        padding: 11px 24px; font-size: 14px; font-weight: 700;
        cursor: pointer; text-decoration: none;
        transition: all .18s; font-family: inherit;
    }
    .btn-confirm:hover { background: #c9cbcf; color: #161414; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(7, 21, 41, 0.2); }
    .btn-cancel {
    display: inline-flex; align-items: center; gap: 8px;
    background: #1A2E4A; color: #fbf9f9;
    border: none; border-radius: 10px;
    padding: 11px 24px; font-size: 14px; font-weight: 700;
    cursor: pointer; text-decoration: none;
    transition: all .18s; font-family: inherit;
}

.btn-cancel:hover { 
    background: #c9cbcf;  /* ← tambahkan ini */
    color: #161414; 
    border-color: #e3d8d8;
    text-decoration: none; /* ← tambahkan ini */
}
    .btn-back-top {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff; color: #0f1010;
        border: 1.5px solid #E2E8F0; border-radius: 9px;
        padding: 8px 16px; font-size: 13px; font-weight: 600;
        text-decoration: none; transition: all .18s;
    }
    .btn-back-top:hover { border-color: #1A2E4A; color: #1A2E4A; }


</style>

<div class="page-wrap">
    <div class="container-fluid">

        {{-- Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="font-weight:800;color:#1A2E4A;">Form Penyewaan Mobil</h1>
            <a href="{{ route('mobil.index') }}" class="btn-back-top">
                <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Mobil Info Card --}}
                <div class="mobil-card">
                    <div class="mobil-icon">
                        <i class="fas fa-car" style="color:#fff; font-size:24px;"></i>
                    </div>
                    <div>
                        <div class="mobil-badge">Mobil yang disewa</div>
                        <div class="mobil-name">{{ $mobil->nama_mobil }}</div>
                        <div class="mobil-meta">
                            <span><span class="dot"></span> Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }} / hari</span>
                            <span><span class="dot"></span> Plat: {{ $mobil->no_polisi }}</span>
                            <span><span class="dot"></span> Tersedia</span>
                        </div>
                    </div>
                </div>

                {{-- Form Card --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="header-icon">
                            <i class="fas fa-user" style="color:#F5A623; font-size:13px;"></i>
                        </div>
                        <span class="title">Data Penyewa</span>
                    </div>
                    <div class="form-card-body">
                        <form action="{{ route('rental.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                            <div class="field-group">
                                <div class="field-label">Nama Penyewa</div>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap penyewa" required>
                            </div>

                            <div class="field-group">
                                <div class="field-label">NIK (KTP)</div>
                                <input type="text" name="nik" class="form-control" placeholder="Masukkan 16 digit NIK" maxlength="16" required>
                            </div>

                            <div class="field-group">
                                <div class="field-label">No. Telepon</div>
                                <input type="text" name="no_telp" class="form-control" placeholder="Contoh: 081234567890" required>
                            </div>

                            <div class="field-group top">
                                <div class="field-label">Alamat</div>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>

                            <hr class="section-divider">

                            <div class="field-group">
                                <div class="field-label">Tanggal Sewa</div>
                                <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
                            </div>

                            <div class="field-group">
                                <div class="field-label">Tanggal Kembali</div>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                            </div>

                            <hr class="section-divider">

                            {{-- ✅ METODE PEMBAYARAN --}}
                            <div class="field-group">
                                <div class="field-label">Metode Pembayaran</div>
                                <div class="metode-group">
                                    <div class="metode-pill">
                                        <input type="radio" name="metode_bayar" id="m_cash" value="cash" checked>
                                        <label for="m_cash">
                                            <span class="pill-icon"></span> Cash
                                        </label>
                                    </div>
                                    <div class="metode-pill">
                                        <input type="radio" name="metode_bayar" id="m_transfer" value="transfer">
                                        <label for="m_transfer">
                                            <span class="pill-icon"></span> Transfer Bank
                                        </label>
                                    </div>
                                    <div class="metode-pill">
                                        <input type="radio" name="metode_bayar" id="m_qris" value="qris">
                                        <label for="m_qris">
                                            <span class="pill-icon"></span> QRIS
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            {{-- Ringkasan Biaya --}}
                            <div id="priceSummary" class="summary-box" style="display:none;">
                                <div class="summary-title">
                                    <i class="fas fa-receipt" style="font-size:12px;"></i> Ringkasan Biaya
                                </div>
                                <div class="summary-row">
                                    <span>Durasi Sewa</span>
                                    <strong id="lamaSewa">0 hari</strong>
                                </div>
                                <div class="summary-row">
                                    <span>Harga per Hari</span>
                                    <span>Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</span>
                                </div>
                                <hr class="summary-divider">
                                <div class="summary-total">
                                    <span>Total Pembayaran</span>
                                    <span id="totalHarga">Rp 0</span>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="btn-row">
                                <button type="submit" class="btn-confirm">
                                    <i class="fas fa-circle-check" style="font-size:14px;"></i> Konfirmasi Penyewaan
                                </button>
                                <a href="{{ route('mobil.index') }}" class="btn-cancel">
                                    <i class="fas fa-times" style="font-size:13px;"></i> Batal
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tanggalSewa    = document.getElementById('tanggal_sewa');
    const tanggalKembali = document.getElementById('tanggal_kembali');
    const priceSummary   = document.getElementById('priceSummary');
    const lamaSewa       = document.getElementById('lamaSewa');
    const totalHarga     = document.getElementById('totalHarga');
    const hargaPerHari   = parseFloat("{{ $mobil->harga_per_hari }}");

    const today = new Date().toISOString().split('T')[0];
    tanggalSewa.min = today;

    tanggalSewa.addEventListener('change', function () {
        tanggalKembali.min = this.value;
        calculatePrice();
    });
    tanggalKembali.addEventListener('change', calculatePrice);

    function calculatePrice() {
        if (tanggalSewa.value && tanggalKembali.value) {
            const start = new Date(tanggalSewa.value);
            const end   = new Date(tanggalKembali.value);
            if (end > start) {
                const diffDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                lamaSewa.textContent   = diffDays + ' hari';
                totalHarga.textContent = 'Rp ' + (diffDays * hargaPerHari).toLocaleString('id-ID');
                priceSummary.style.display = 'block';
            } else {
                priceSummary.style.display = 'none';
            }
        }
    }
});
</script>
@endsection