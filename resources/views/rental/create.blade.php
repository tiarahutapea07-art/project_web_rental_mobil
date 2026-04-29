@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
/* Fix select dropdown */
#customer_id {
    appearance: auto;
    -webkit-appearance: auto;
    cursor: pointer;
    padding-right: 30px;
    width: 100%;
    display: block;
    height: auto;
    min-height: 42px;
}
#customer_id option {
    padding: 8px;
    font-size: 13px;
    color: #1A2E4A;
    background: #fff;
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
    background: #F59E0B; color: #1A2E4A;
    border: none; border-radius: 10px;
    padding: 11px 24px; font-size: 14px; font-weight: 700;
    cursor: pointer; text-decoration: none;
    transition: all .18s; font-family: inherit;
}
.btn-confirm:hover { 
    background: #d97706; 
    color: #1A2E4A;
    transform: translateY(-1px); 
    box-shadow: 0 4px 14px rgba(245,158,11,0.4); 
}

.btn-cancel {
    display: inline-flex; align-items: center; gap: 8px;
    background: #e73333; color: #fff;
    border: none; border-radius: 10px;
    padding: 11px 24px; font-size: 14px; font-weight: 700;
    cursor: pointer; text-decoration: none;
    transition: all .18s; font-family: inherit;
}
.btn-cancel:hover { 
    background: #ce1d1d;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(239,68,68,0.4);
    text-decoration: none;
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
                        <form action="{{ route('rental.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                            
{{-- PILIH CUSTOMER --}}
<div class="field-group">
    <div class="field-label">Customer</div>
    <select name="customer_id" id="customer_id" class="form-control" onchange="isiDataCustomer(this)">
        <option value="">-- Pilih Customer --</option>
        <option value="baru" style="color:#059669; font-weight:700;"
            {{ old('customer_id') === 'baru' ? 'selected' : '' }}>
             Tambah Customer Baru
        </option>
        <option disabled>──────────────</option>
        @foreach($customers as $c)
            <option value="{{ $c->id }}"
                data-nama="{{ $c->nama }}"
                data-nik="{{ $c->nik }}"
                data-telp="{{ $c->no_telp }}"
                data-alamat="{{ $c->alamat }}"
                {{ old('customer_id') == $c->id || (!old('customer_id') && isset($currentCustomer) && $currentCustomer->id == $c->id) ? 'selected' : '' }}>
                {{ $c->nama }} — {{ $c->nik }}
            </option>
        @endforeach
    </select>
</div>

{{-- INFO STATUS CUSTOMER --}}
<div id="infoCustomer" style="display:none; margin-bottom:16px;">
    <div id="infoLama" style="display:none; background:#d1fae5; border:1px solid #a7f3d0; border-radius:8px; padding:10px 14px; font-size:13px; color:#065f46;">
        <i class="fas fa-check-circle me-2"></i> Data customer ditemukan — field otomatis terisi dan dikunci.
    </div>
    <div id="infoBaru" style="display:none; background:#fef3c7; border:1px solid #fde68a; border-radius:8px; padding:10px 14px; font-size:13px; color:#92400e;">
        <i class="fas fa-user-plus me-2"></i> Isi data customer baru — akan disimpan ke database.
    </div>
</div>

{{-- DATA CUSTOMER (auto-fill atau isi manual) --}}
<div id="formCustomerBaru">
    <div class="field-group">
        <div class="field-label">Nama Penyewa</div>
        <input type="text" name="nama" id="nama" class="form-control"
               placeholder="Masukkan nama lengkap penyewa"
               value="{{ old('nama', optional($currentCustomer)->nama) }}"
               required
               {{ (old('customer_id') && old('customer_id') !== 'baru') || (!old('customer_id') && isset($currentCustomer)) ? 'readonly' : '' }}>
    </div>
    <div class="field-group">
        <div class="field-label">NIK (KTP)</div>
        <input type="text" name="nik" id="nik" class="form-control"
               placeholder="Masukkan 16 digit NIK" maxlength="16"
               value="{{ old('nik', optional($currentCustomer)->nik) }}"
               required
               {{ (old('customer_id') && old('customer_id') !== 'baru') || (!old('customer_id') && isset($currentCustomer)) ? 'readonly' : '' }}>
    </div>
    <div class="field-group">
        <div class="field-label">No. Telepon</div>
        <input type="text" name="no_telp" id="no_telp" class="form-control"
               placeholder="Contoh: 081234567890"
               value="{{ old('no_telp', optional($currentCustomer)->no_telp) }}"
               {{ (old('customer_id') && old('customer_id') !== 'baru') || (!old('customer_id') && isset($currentCustomer)) ? 'readonly' : '' }}>
    </div>
    <div class="field-group top">
        <div class="field-label">Alamat</div>
        <textarea name="alamat" id="alamat" class="form-control" rows="2"
                  placeholder="Masukkan alamat lengkap"
                  {{ (old('customer_id') && old('customer_id') !== 'baru') || (!old('customer_id') && isset($currentCustomer)) ? 'readonly' : '' }}>{{ old('alamat', optional($currentCustomer)->alamat) }}</textarea>
    </div>
</div>

                            <hr class="section-divider">

                            <div class="field-group">
                                <div class="field-label">Tanggal Sewa</div>
                                <input type="text" name="tanggal_sewa" id="tanggal_sewa" class="form-control" placeholder="YYYY-MM-DD" required autocomplete="off">
                            </div>

                            <div class="field-group">
                                <div class="field-label">Tanggal Kembali</div>
                                <input type="text" name="tanggal_kembali" id="tanggal_kembali" class="form-control" placeholder="YYYY-MM-DD" required autocomplete="off">
                            </div>

                            <hr class="section-divider">

                           <div class="form-group mt-3">
                            <label>Metode Pembayaran</label>

                            <!-- value yang dikirim ke controller -->
                            <input type="hidden" name="metode_bayar" id="metode_bayar" value="cash">


                            <div style="display:flex; gap:8px;">
                                <button type="button" class="btn btn-dark rounded-2" data-metode="cash">Cash</button>
                                <button type="button" class="btn btn-outline-secondary rounded-2" data-metode="transfer">Transfer Bank</button>
                                <button type="button" class="btn btn-outline-secondary rounded-2" data-metode="qris">QRIS</button>
                            </div>
                       
                    </div>

                          

                            <!-- Upload Bukti -->
                            <div id="buktiWrapper" style="display:none; margin-top:10px;">
                                <label>Upload Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control">
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
                                <a href="{{ route('mobil.index') }}" class="btn-cancel">
                                    <i class="fas fa-times" style="font-size:13px;"></i> Batal
                                </a>
                                <button type="submit" class="btn-confirm">
                                    <i class="fas fa-circle-check" style="font-size:14px;"></i> Konfirmasi Penyewaan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
const metodeInput = document.getElementById('metode_bayar');
const bukti = document.getElementById('buktiWrapper');

function initCustomerSelection() {
    const select = document.getElementById('customer_id');
    if (select) {
        isiDataCustomer(select);
    }
}

document.querySelectorAll('[data-metode]').forEach(btn => {
    btn.addEventListener('click', function () {

        let metode = this.dataset.metode;

        // simpan ke input hidden
        metodeInput.value = metode;

        // tampilkan upload jika transfer/qris
        if (metode === 'transfer' || metode === 'qris') {
            bukti.style.display = 'block';
        } else {
            bukti.style.display = 'none';
        }

        // styling aktif
        document.querySelectorAll('[data-metode]').forEach(b => {
            b.classList.remove('btn-dark');
            b.classList.add('btn-outline-secondary');
        });

        this.classList.remove('btn-outline-secondary');
        this.classList.add('btn-dark');
    });
});

window.addEventListener('DOMContentLoaded', initCustomerSelection);
</script>

<script>
function isiDataCustomer(select) {
    const opt = select.options[select.selectedIndex];
    const infoCustomer = document.getElementById('infoCustomer');
    const infoLama = document.getElementById('infoLama');
    const infoBaru = document.getElementById('infoBaru');
    const fields = ['nama','nik','no_telp','alamat'];

    if (opt.value === 'baru') {
        // Tambah customer baru — kosongkan dan buka field
        fields.forEach(id => {
            document.getElementById(id).value    = '';
            document.getElementById(id).readOnly = false;
            document.getElementById(id).style.background = '';
        });
        infoCustomer.style.display = 'block';
        infoLama.style.display = 'none';
        infoBaru.style.display = 'block';

    } else if (opt.value) {
        // Customer lama — auto-fill dan kunci
        document.getElementById('nama').value    = opt.dataset.nama;
        document.getElementById('nik').value     = opt.dataset.nik;
        document.getElementById('no_telp').value = opt.dataset.telp;
        document.getElementById('alamat').value  = opt.dataset.alamat;
        fields.forEach(id => {
            document.getElementById(id).readOnly = true;
            document.getElementById(id).style.background = '#f0f2f8';
        });
        infoCustomer.style.display = 'block';
        infoLama.style.display = 'block';
        infoBaru.style.display = 'none';

    } else {
        // Reset — pilih awal
        fields.forEach(id => {
            document.getElementById(id).value    = '';
            document.getElementById(id).readOnly = false;
            document.getElementById(id).style.background = '';
        });
        infoCustomer.style.display = 'none';
        infoLama.style.display = 'none';
        infoBaru.style.display = 'none';
    }
}
</script>

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(function() {
    if (!($.ui && $.ui.datepicker)) {
        return;
    }

    const hargaPerHari = parseFloat("{{ $mobil->harga_per_hari }}");
    const priceSummary = document.getElementById('priceSummary');
    const lamaSewa = document.getElementById('lamaSewa');
    const totalHarga = document.getElementById('totalHarga');

    $('#tanggal_sewa').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        onSelect: function() {
            const selectedDate = $(this).datepicker('getDate');
            $('#tanggal_kembali').datepicker('option', 'minDate', selectedDate);
            calculatePrice();
        }
    });

    $('#tanggal_kembali').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        onSelect: calculatePrice
    });

    function calculatePrice() {
        const startVal = $('#tanggal_sewa').val();
        const endVal = $('#tanggal_kembali').val();

        if (!startVal || !endVal) {
            priceSummary.style.display = 'none';
            return;
        }

        const start = new Date(startVal);
        const end = new Date(endVal);

        if (end > start) {
            const diffDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            lamaSewa.textContent = diffDays + ' hari';
            totalHarga.textContent = 'Rp ' + (diffDays * hargaPerHari).toLocaleString('id-ID');
            priceSummary.style.display = 'block';
        } else {
            priceSummary.style.display = 'none';
        }
    }
});
</script>
@endpush

@endsection