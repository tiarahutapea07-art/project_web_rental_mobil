@extends('layouts.admin')

@section('content')
<style>
    .rental-form-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .rental-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        margin: 2rem auto;
        max-width: 800px;
    }

    .rental-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .rental-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 2rem;
    }

    .rental-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .form-section {
        padding: 2rem;
    }

    .mobil-preview {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 1.5rem;
        color: white;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .mobil-preview img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .mobil-info h4 {
        margin: 0 0 0.5rem 0;
        font-weight: 600;
    }

    .mobil-info p {
        margin: 0;
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .customer-option-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-top: 0.75rem;
    }

    .customer-option-group .form-check {
        padding: 1rem;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        background: #f8f9fa;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        background-color: #fff;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        box-sizing: border-box;
        line-height: 1.5;
        min-height: 3.4rem;
        background-image: none;
        cursor: pointer;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .select-wrapper {
        position: relative;
        width: 100%;
    }

    .select-wrapper select {
        padding-right: 3rem;
        width: 100%;
    }

    .select-wrapper::after {
        content: '\f107';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #6c757d;
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
    }

    .date-input-group {
        display: flex;
        gap: 1rem;
    }

    .date-input-group .form-group {
        flex: 1;
    }

    @media (max-width: 768px) {
        .date-input-group {
            flex-direction: column;
        }
    }

    .price-summary {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 2rem;
        border-left: 4px solid #667eea;
    }

    .price-summary h5 {
        color: #667eea;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .price-row.total {
        border-top: 2px solid #dee2e6;
        padding-top: 0.5rem;
        font-weight: 700;
        font-size: 1.1rem;
        color: #667eea;
    }
</style>

<div class="rental-form-container">
    <div class="container">
        <div class="rental-card">
            <div class="rental-header">
                <h2><i class="fas fa-key mr-2"></i>Sewa Mobil</h2>
                <p>Lengkapi informasi penyewaan di bawah ini</p>
            </div>

            <div class="form-section">
                <form action="{{ route('rental.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                    <div class="mobil-preview">
                        @if($mobil->foto) <img src="{{ asset('storage/' . $mobil->foto) }}" alt="{{ $mobil->nama_mobil }}">
                        @else
                            <div style="width: 80px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-car fa-lg"></i>
                            </div>
                        @endif
                        <div class="mobil-info">
                            <h4>{{ $mobil->nama_mobil }}</h4>
                            <p>Harga Sewa: <strong>Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</strong> / hari</p>
                        </div>
                    </div>

                    <label class="form-label">Tipe Customer</label>
                    <div class="customer-option-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_type" id="existing" value="existing" checked>
                            <label class="form-check-label fw-bold" for="existing">Customer Lama</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_type" id="new" value="new">
                            <label class="form-check-label fw-bold" for="new">Customer Baru</label>
                        </div>
                    </div>

                    <div id="existingCustomerSection" class="form-group">
                        <label class="form-label">Pilih Customer</label>
                        <select name="customer_id" class="form-select">
                            <option value="" disabled selected>-- Pilih Nama Customer --</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }} ({{ $c->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="newCustomerSection" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Input nama lengkap">
                        </div>
                        <div class="form-group">
                            <label class="form-label">NIK</label>
                            <input type="number" name="nik" class="form-control" placeholder="Input nomor NIK">
                        </div>
                    </div>

                    <div class="date-input-group">
                        <div class="form-group">
                            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                            <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                        </div>
                    </div>

                    <div id="priceSummary" class="price-summary">
                        <h5>Ringkasan Biaya</h5>
                        <div class="price-row">
                            <span>Durasi Sewa</span>
                            <span id="lamaSewa">0 hari</span>
                        </div>
                        <div class="price-row">
                            <span>Harga per Hari</span>
                            <span>Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</span>
                        </div>
                        <div class="price-row total">
                            <span>Total Pembayaran</span>
                            <span id="totalHarga">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit mt-4">
                        <i class="fas fa-check-circle me-2"></i>Konfirmasi Penyewaan
                    </button>
                    <div class="text-center mt-3">
                        <a href="{{ route('mobil.index') }}" class="text-muted text-decoration-none small">Kembali ke Daftar Mobil</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalSewa = document.getElementById('tanggal_sewa');
    const tanggalKembali = document.getElementById('tanggal_kembali');
    const priceSummary = document.getElementById('priceSummary');
    const lamaSewa = document.getElementById('lamaSewa');
    const totalHarga = document.getElementById('totalHarga');
    const hargaPerHari = ("{{ $mobil->harga_per_hari }}");

    const existingRadio = document.getElementById('existing');
    const newRadio = document.getElementById('new');
    const existingSection = document.getElementById('existingCustomerSection');
    const newSection = document.getElementById('newCustomerSection');

    // 1. Fungsi Toggle Customer
    function toggleCustomerSection() {
        if (existingRadio.checked) {
            existingSection.style.display = 'block';
            newSection.style.display = 'none';
            document.querySelectorAll('#newCustomerSection input').forEach(el => el.required = false);
            existingSection.querySelector('select').required = true;
        } else {
            existingSection.style.display = 'none';
            newSection.style.display = 'block';
            document.querySelectorAll('#newCustomerSection input').forEach(el => el.required = true);
            existingSection.querySelector('select').required = false;
        }
    }

    existingRadio.addEventListener('change', toggleCustomerSection);
    newRadio.addEventListener('change', toggleCustomerSection);

    // 2. Fungsi Hitung Harga Otomatis
    function calculatePrice() {
        if (tanggalSewa.value && tanggalKembali.value) {
            const start = new Date(tanggalSewa.value);
            const end = new Date(tanggalKembali.value);

            if (end > start) {
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                lamaSewa.textContent = diffDays + ' hari';
                totalHarga.textContent = 'Rp ' + (diffDays * hargaPerHari).toLocaleString('id-ID');
                priceSummary.style.display = 'block';
            } else {
                priceSummary.style.display = 'none';
            }
        }
    }

    tanggalSewa.addEventListener('change', calculatePrice);
    tanggalKembali.addEventListener('change', calculatePrice);

    // Set min date hari ini
    const today = new Date().toISOString().split('T')[0];
    tanggalSewa.min = today;
    
    tanggalSewa.addEventListener('change', function() {
        tanggalKembali.min = this.value;
    });
});
</script>
@endsection