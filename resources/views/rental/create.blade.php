@extends('layouts.admin')

@section('content')
<style>
    

    .mobil-card {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
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
        background: rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .mobil-badge {
        display: inline-block;
        background: rgba(255,255,255,0.25);
        color: #fff;
        font-size: 10px; font-weight: 600;
        letter-spacing: 1px; text-transform: uppercase;
        padding: 3px 10px; border-radius: 20px;
        margin-bottom: 6px;
    }
    .mobil-name { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 4px; }
    .mobil-meta { font-size: 13px; color: rgba(255,255,255,0.85); display: flex; gap: 16px; }
    .mobil-meta span { display: flex; align-items: center; gap: 5px; }
    .dot { width: 7px; height: 7px; border-radius: 50%; background: rgba(255,255,255,0.6); display: inline-block; }

    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 20px;
        border: none;
    }
    .form-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #f0f2f8;
        display: flex; align-items: center; gap: 10px;
    }
    .header-icon {
        width: 32px; height: 32px;
        border-radius: 8px; background: #eef0fb;
        display: flex; align-items: center; justify-content: center;
    }
    .form-card-header .title { font-size: 14px; font-weight: 600; color: #3d3f4e; }
    .form-card-body { padding: 24px; }

    .field-group {
        display: grid;
        grid-template-columns: 180px 1fr;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }
    .field-group.top { align-items: flex-start; }
    .field-label { font-size: 13px; font-weight: 600; color: #5a5c69; padding-top: 2px; }
    .field-group.top .field-label { padding-top: 10px; }

    .form-card-body .form-control {
        border: 1.5px solid #e3e6f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        background: #fafbff;
        color: #6e707e;
        transition: border-color 0.2s;
    }
    .form-card-body .form-control:focus {
        border-color: #889fe6;
        box-shadow: 0 0 0 3px rgba(78,115,223,0.12);
        background: #fff;
    }

    .section-divider {
        border: none;
        border-top: 1.5px dashed #e3e6f0;
        margin: 4px 0 20px;
    }

    .summary-box {
        background: linear-gradient(135deg, #f8f9ff 0%, #eef0fb 100%);
        border: 1.5px solid #d4daff;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
    .summary-title {
        font-size: 11px; font-weight: 700;
        color: #4e73df;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 12px;
        display: flex; align-items: center; gap: 6px;
    }
    .summary-row {
        display: flex; justify-content: space-between;
        font-size: 13px; color: #6e707e;
        margin-bottom: 6px;
    }
    .summary-row strong { color: #3d3f4e; }
    .summary-divider { border: none; border-top: 1.5px solid #d4daff; margin: 10px 0; }
    .summary-total {
        display: flex; justify-content: space-between;
        font-size: 16px; font-weight: 700; color: #4e73df;
    }

    .btn-row { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
    .btn-confirm {
        display: inline-flex; align-items: center; gap: 8px;
        background: #4e73df; color: #fff;
        border: none; border-radius: 10px;
        padding: 11px 22px; font-size: 14px; font-weight: 600;
        cursor: pointer; text-decoration: none;
        transition: background 0.2s;
    }
    .btn-confirm:hover { background: #3d5fc4; color: #fff; }
    .btn-cancel {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; color: #0c1137;
        border: 1.5px solid #d1d3e2; border-radius: 10px;
        padding: 11px 20px; font-size: 14px; font-weight: 500;
        cursor: pointer; text-decoration: none;
        transition: background 0.2s;
    }
    .btn-cancel:hover { background: #f8f9fc; color: #858796; }
    .btn-back-top {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff; color: #5a5c69;
        border: 1px solid #d1d3e2; border-radius: 8px;
        padding: 7px 16px; font-size: 13px; font-weight: 500;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-back-top:hover { background: #f8f9fc; color: #5a5c69; }
</style>

<div class="page-wrap">
    <div class="container-fluid">

        {{-- Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black-800">Form Penyewaan Mobil</h1>
            <a href="{{ route('mobil.index') }}" class="btn-back-top">
                <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Mobil Info Card --}}
                <div class="mobil-card">
                    <div class="mobil-icon">
                        <i class="fas fa-car fa-lg" style="color:#fff; font-size:24px;"></i>
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
                            <i class="fas fa-file-alt" style="color:#4e73df; font-size:14px;"></i>
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
                                <input type="text" name="nik" class="form-control" placeholder="Masukkan 16 digit NIK" required>
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
                                    <i class="fas fa-check-circle" style="font-size:14px;"></i> Konfirmasi Penyewaan
                                </button>
                                <a href="{{ route('mobil.index') }}" class="btn-cancel">
                                    <i class="fas fa-times" style="font-size:14px;"></i> Batal
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
    const tanggalSewa = document.getElementById('tanggal_sewa');
    const tanggalKembali = document.getElementById('tanggal_kembali');
    const priceSummary = document.getElementById('priceSummary');
    const lamaSewa = document.getElementById('lamaSewa');
    const totalHarga = document.getElementById('totalHarga');
    const hargaPerHari = parseFloat("{{ $mobil->harga_per_hari }}");

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
            const end = new Date(tanggalKembali.value);
            if (end > start) {
                const diffDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                lamaSewa.textContent = diffDays + ' hari';
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