@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
    .rental-container {
    background: transparent;
    min-height: 100vh;
    padding: 0;
}

    .page-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .card-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        padding: 1.5rem;
    }

    .card-box-title {
        font-size: 1rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 1.25rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f0f2f5;
    }

    #rentalTable {
        width: 100% !important;
    }

    #rentalTable thead th {
        background: white;
        color: #2c3e50;
        font-weight: 700;
        font-size: 0.85rem;
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        padding: 0.75rem 0.65rem;
    }

    #rentalTable tbody tr {
        background: white;
    }

    #rentalTable tbody tr:hover {
        background: #f8f9fa;
    }

    #rentalTable tbody td {
        padding: 0.7rem 0.65rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
        color: #2c3e50;
        font-size: 0.85rem;
    }

    .car-name {
        font-weight: 600;
        color: #667eea;
    }

    .status-badge {
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        color: white;
        display: inline-block;
    }

    .status-aktif {
    background: #f6c23e;
}

.status-selesai {
    background:  #c0392b;
}

    .status-dibatalkan {
        background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
    }

    .btn-return {
        background: linear-gradient(135deg, #56ab2f, #a8e6cf);
        border: none;
        color: white;
        padding: 0.28rem 0.7rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-return:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(86,171,47,0.35);
        color: white;
    }

    .dataTables_wrapper {
        font-size: 0.85rem;
        color: #2c3e50;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.75rem;
        color: #555;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0.28rem 0.55rem;
        font-size: 0.85rem;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #667eea;
    }

    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0.2rem 0.4rem;
        font-size: 0.85rem;
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 0.82rem;
        color: #555;
        padding-top: 0.75rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #dee2e6 !important;
        border-radius: 4px !important;
        padding: 0.2rem 0.55rem !important;
        margin: 0 2px;
        font-size: 0.82rem;
        color: #555 !important;
        background: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #667eea !important;
        color: white !important;
        border: 1px solid #667eea !important;
        font-weight: 700;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f0f0f0 !important;
        color: #333 !important;
        border: 1px solid #ccc !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        color: #ccc !important;
        background: white !important;
        border: 1px solid #eee !important;
    }
</style>

<div class="rental-container">
    <div class="container-fluid px-0">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        

        <div class="card-box">
            <div class="card-box-title">Daftar Penyewaan</div>

            <table id="rentalTable" class="table w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mobil</th>
                        <th>Customer</th>
                        <th>Tgl Sewa</th>
                        <th>Tgl Kembali</th>
                        <th>Lama Sewa</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $i => $rental)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="car-name">
                            <i class="fas fa-car mr-1" style="color:#667eea"></i>{{ $rental->mobil->nama_mobil }}
                        </td>
                        <td>{{ $rental->customer->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</td>
                        <td>{{ $rental->lama_sewa }} hari</td>
                        <td>Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge status-{{ $rental->status }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>
                        <td>
                            @if($rental->status == 'aktif')
                                <form action="{{ route('rental.return', $rental->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn-return"
                                        onclick="return confirm('Apakah mobil sudah dikembalikan?');">
                                        <i class="fas fa-undo mr-1"></i>Kembalikan
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada data penyewaan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#rentalTable').DataTable({
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                },
                emptyTable: "Tidak ada data penyewaan"
            },
            pageLength: 10,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [ 2, 3, 4, 6, 7, 8] }
            ]
        });
    });
</script>
@endpush

@endsection