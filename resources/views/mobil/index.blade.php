@extends('layouts.admin') 

@section('content')
<style>
    .card-mobil {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border-radius: 16px;
        overflow: hidden;
        border: none;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    
    .card-mobil:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }
    
    .img-mobil-container {
        height: 240px;
        background: linear-gradient(135deg, #EEF1F8 0%, #dde3f0 100%);
        padding: 2rem;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .img-mobil-container::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .img-mobil {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0px 10px 20px rgba(0,0,0,0.3));
        transition: transform 0.4s ease;
        position: relative;
        z-index: 1;
    }
    
    .card-mobil:hover .img-mobil {
        transform: scale(1.12) rotate(2deg);
    }
    
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 8px 14px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    /* ✅ Badge Tersedia → Amber */
    .status-badge.available {
        background: linear-gradient(135deg, #F59E0B 0%, #d97706 100%);
        color: #7C3E00;
    }
    
    /* ✅ Badge Disewa → Navy muda */
    .status-badge.unavailable {
        background: linear-gradient(135deg, #243460 0%, #1A2744 100%);
        color: #B8C8F0;
    }
    
    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .mobil-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1A2744;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    /* ✅ Harga → Amber */
    .mobil-price {
        font-size: 1.6rem;
        font-weight: 800;
        color: #d97706;
        margin-bottom: 1rem;
    }
    
    .mobil-price small {
        font-size: 0.7rem;
        color: #95a5a6;
        font-weight: 400;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.8rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid #EEF1F8;
        font-size: 0.9rem;
        color: #555;
    }
    
    /* ✅ Icon info → Navy */
    .info-item i {
        width: 20px;
        color: #1A2744;
        margin-right: 10px;
    }
    
    .info-item strong {
        color: #1A2744;
    }
    
    .action-buttons {
        margin-top: auto;
        padding-top: 1rem;
        display: flex;
        gap: 8px;
    }
    
    /* ✅ Tombol Sewa → Navy */
    .btn-sewa {
        flex: 1;
        background: linear-gradient(135deg, #1A2744 0%, #243460 100%);
        border: none;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-sewa:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(26, 39, 68, 0.4);
        color: #F59E0B;
    }
    
    /* ✅ Tombol Edit → Amber (tetap, cocok) */
    .btn-edit {
        flex: 1;
        background: #F59E0B;
        border: none;
        color: #181715;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-edit:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(245, 158, 11, 0.4);
        color: #361c02;
    }
    
    .btn-delete {
        color: #141b28;
        font-size: 0.85rem;
        padding: 0.3rem 0.8rem;
        text-decoration: none !important;
        transition: all 0.3s ease;
        cursor: pointer;
        background: none;
        border: none;
    }
    
    .btn-delete:hover {
        color: #e74c3c;
    }
    
    /* ✅ Stat cards → Navy + Amber + Navy muda */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #1A2744 0%, #243460 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    
    .stat-card h6 {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 0.5rem;
        color: #B8C8F0;
    }
    
    .stat-card .number {
        font-size: 2.2rem;
        font-weight: 800;
        color: white;
    }
    
    /* ✅ Card Tersedia → Amber */
    .stat-card.available {
        background: linear-gradient(135deg, #F59E0B 0%, #d97706 100%);
    }
    
    .stat-card.available h6 {
        color: #7C3E00;
    }

    .stat-card.available .number {
        color: #7C3E00;
    }
    
    /* ✅ Card Disewa → Navy lebih muda */
    .stat-card.unavailable {
        background: linear-gradient(135deg, #243460 0%, #1a3a6e 100%);
    }
    
    /* ✅ Header section → putih bersih dengan border */
    .header-section {
        background: #ffffff;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        border-left: 4px solid #F59E0B;
    }
</style>

<div class="container-fluid pt-4 pb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="header-section mb-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h1 class="h2 mb-1 text-black-900 font-weight-bold">
                    <i class="fas fa-car-alt text-dark mr-2"></i> Katalog Mobil
                </h1>
                <p class="text-black-600 mb-0">
                    <i class="fas fa-info-circle mr-2"></i> {{ $mobils->count() }} kendaraan tersedia untuk disewa
                </p>
            </div>
            <a href="{{ url('/mobil/create') }}" class="btn btn-primary" style="padding: 5px 15px; font-size: 14px;">
                <i class="fas fa-plus"></i> Tambah Unit Baru
            </a>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-container">
        <div class="stat-card">
            <h6><i class="fas fa-car mr-2"></i>Total Kendaraan</h6>
            <div class="number">{{ $mobils->count() }}</div>
        </div>
        <div class="stat-card available">
            <h6><i class="fas fa-check-circle mr-2"></i>Tersedia</h6>
            <div class="number">{{ $mobils->where('status', 'tersedia')->count() }}</div>
        </div>
        <div class="stat-card unavailable">
            <h6><i class="fas fa-times-circle mr-2"></i>Disewa</h6>
            <div class="number">{{ $mobils->where('status', 'tidak tersedia')->count() }}</div>
        </div>
    </div>

    <!-- Mobil Grid -->
    <div class="row">
        @forelse($mobils as $m)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card card-mobil shadow-sm bg-white">
                
                <div class="img-mobil-container position-relative">
                    @if($m->foto)
                        <img src="{{ asset('img/' . $m->foto) }}" class="img-mobil" alt="{{ $m->nama_mobil }}">
                    @else
                        <div class="text-center text-white">
                            <i class="fas fa-car fa-4x mb-2"></i><br>
                            <small>Gambar Hilang</small>
                        </div>
                    @endif
                    
                    @php
                        $isDisewa = $m->status === 'tidak tersedia';
                    @endphp
                    <span class="status-badge {{ $isDisewa ? 'unavailable' : 'available' }}">
                        <i class="fas {{ $isDisewa ? 'fa-ban' : 'fa-check-circle' }}"></i>
                        {{ $isDisewa ? 'Disewa' : 'Tersedia' }}
                    </span>
                </div>

                <div class="card-body">
                    <h5 class="mobil-name" title="{{ $m->nama_mobil }}">
                        {{ $m->nama_mobil }}
                    </h5>
                    
                    <div class="mobil-price">
                        Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}
                        <small>/ hari</small>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-id-card"></i>
                        <strong>Plat:</strong> &nbsp; {{ $m->no_polisi }}
                    </div>

                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Ditambahkan {{ $m->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ url('/mobil/'.$m->id.'/edit') }}" class="btn btn-edit btn-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <a href="{{ url('/rental/create/'.$m->id) }}" class="btn btn-sewa btn-sm {{ $m->status == 'tidak tersedia' ? 'disabled' : '' }}">
                            <i class="fas fa-key mr-1"></i> Sewa
                        </a>
                    </div>
                    
                    <div class="text-center mt-2">
                        <form action="{{ url('/mobil/'.$m->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" 
                                    onclick="return confirm('Yakin ingin menghapus {{ $m->nama_mobil }}?');">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5" role="alert">
                <i class="fas fa-inbox fa-5x text-gray-300 mb-3 d-block"></i>
                <h4 class="text-muted mt-3">Belum Ada Kendaraan</h4>
                <p class="text-muted">Mulai tambahkan kendaraan ke dalam sistem penyewaan.</p>
                <a href="{{ url('/mobil/create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus mr-2"></i> Tambah Kendaraan Pertama
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection