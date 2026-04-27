@extends('layouts.admin')

@section('content')
<style>
.container-custom {
    max-width: 800px;
    margin: 30px auto;
}

/* Title */
.page-title {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 20px;
}

/* Filter */
.filter-btn {
    background: #111827;
    color: #fff;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
}

/* Card */
.trx-card {
    background: #fff;
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,.08);
    transition: .2s;
    border: 1px solid #E5E7EB;
}
.trx-card:hover {
    transform: translateY(-3px);
}

/* Left */
.trx-title {
    font-size: 16px;
    font-weight: 700;
}
.trx-date {
    font-size: 13px;
    color: #6B7280;
}

/* Icon */
.icon {
    width: 18px;
    margin-right: 6px;
    color: #6B7280;
}

/* Right */
.trx-price {
    font-size: 18px;
    font-weight: 800;
    color: #111827;
}

/* Button */
.btn-detail {
    margin-top: 6px;
    font-size: 12px;
    padding: 6px 14px;
    border-radius: 8px;
}
</style>

<div class="container-custom">

    <div class="page-title">Riwayat Transaksi</div>

    <!-- FILTER -->
    <div class="mb-3">
        <a href="#" class="filter-btn">Semua</a>
    </div>

    @foreach($transaksis as $transaksi)
    <div class="trx-card">

        <div class="d-flex justify-content-between align-items-center">

            {{-- LEFT --}}
            <div>
                <div class="trx-title">
                    <i class="fas fa-car icon"></i>
                    {{ optional($transaksi->rental->mobil)->nama_mobil }}
                </div>

                <div class="trx-date">
                    <i class="fas fa-calendar-alt icon"></i>
                    {{ optional($transaksi->rental)->tanggal_sewa ?? '-' }}
                </div>

                {{-- STATUS --}}
                @php
                    $status = $transaksi->status_transaksi;
                @endphp

            </div>

            {{-- RIGHT --}}
            <div class="text-end">
                <div class="trx-price">
                    Rp {{ number_format(optional($transaksi->rental)->total_harga,0,',','.') }}
                </div>

                <a href="{{ route('aktivitas.show', $transaksi->id) }}" 
                   class="btn btn-dark btn-detail">
                   Detail
                </a>
            </div>

        </div>

    </div>
    @endforeach

</div>
@endsection
