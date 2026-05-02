@extends('layouts.admin')

@section('content')

{{-- SweetAlert2 CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    /* Page header */
    .page-title { font-size: 22px; font-weight: 800; color: #1A2E4A; margin: 0; }
    .page-subtitle { font-size: 13px; color: #6B7A99; margin-top: 3px; }

    /* Card */
    .cust-card {
        background: #fff; border-radius: 16px;
        border: 1.5px solid #E2E8F0;
        box-shadow: 0 2px 16px rgba(26,46,74,.08);
        overflow: hidden; margin-top: 20px;
    }
    .cust-card-header {
        padding: 16px 22px;
        border-bottom: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        display: flex; align-items: center; justify-content: space-between;
    }
    .cust-card-title {
        font-size: 15px; font-weight: 700; color: #1A2E4A;
        display: flex; align-items: center; gap: 8px;
    }
    .cust-card-title i { color: #F5A623; }

    /* Tombol Tambah */
    .btn-tambah {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 18px; border-radius: 9px;
        background: #1A2E4A; color: #fff;
        font-size: 13px; font-weight: 700;
        border: none; text-decoration: none; transition: all .18s;
    }
    .btn-tambah:hover { background: #243d63; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(26,46,74,.2); }

    /* Table */
    .cust-table { width: 100%; border-collapse: collapse; }
    .cust-table thead tr { background: #1A2E4A; }
    .cust-table th {
        padding: 12px 16px; font-size: 12px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .6px;
        color: rgba(255,255,255,.8); border: none;
    }
    .cust-table td {
        padding: 13px 16px; font-size: 13.5px;
        border-bottom: 1px solid #E2E8F0; vertical-align: middle;
        color: #1A2E4A;
    }
    .cust-table tbody tr:last-child td { border-bottom: none; }
    .cust-table tbody tr:hover { background: rgba(26,46,74,.025); }

    /* Tombol aksi */
    .btn-edit {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; border-radius: 7px;
        background: #F5A623; color: #fff;
        font-size: 12px; font-weight: 700;
        border: none; text-decoration: none; transition: all .15s;
    }
    .btn-edit:hover { background: #d97706; color: #fff; }
    .btn-hapus {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; border-radius: 7px;
        background: #EF4444; color: #fff;
        font-size: 12px; font-weight: 700;
        border: none; cursor: pointer; transition: all .15s;
        font-family: inherit;
    }
    .btn-hapus:hover { background: #dc2626; }

    /* Alert success */
    .alert-success-custom {
        display: flex; align-items: center; gap: 10px;
        background: rgba(34,197,94,.08); border: 1.5px solid rgba(34,197,94,.25);
        color: #16a34a; border-radius: 10px;
        padding: 12px 16px; font-size: 13.5px; font-weight: 500;
        margin-bottom: 20px;
    }
    .alert-close { margin-left: auto; cursor: pointer; opacity: .5; font-size: 16px; background: none; border: none; color: inherit; }

    /* SweetAlert2 override warna */
    .swal2-confirm { background: #EF4444 !important; border-radius: 9px !important; font-weight: 700 !important; }
    .swal2-cancel { background: #fff !important; color: #1A2E4A !important; border: 1.5px solid #E2E8F0 !important; border-radius: 9px !important; font-weight: 600 !important; }
    .swal2-cancel:hover { border-color: #1A2E4A !important; }
    .swal2-title { color: #1A2E4A !important; font-size: 20px !important; font-weight: 800 !important; }
    .swal2-html-container { color: #6B7A99 !important; font-size: 14px !important; }
    .swal2-icon.swal2-warning { border-color: #F5A623 !important; color: #F5A623 !important; }
    .swal2-popup { border-radius: 16px !important; }
</style>

<div class="container-fluid">

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert-success-custom" id="alertSuccess">
        <i class="fas fa-circle-check"></i>
        {{ session('success') }}
        <button class="alert-close" onclick="document.getElementById('alertSuccess').remove()">✕</button>
    </div>
    @endif

    {{-- Page Header --}}
    <div>
        <div class="page-title">Data Customer</div>
        <div class="page-subtitle">Kelola data pelanggan rental mobil</div>
    </div>

    {{-- Card --}}
    <div class="cust-card">
        <div class="cust-card-header">
            <div class="cust-card-title">
                <i class="fas fa-users"></i> Daftar Pelanggan Rental
            </div>
            <a href="{{ url('/customer/create') }}" class="btn-tambah">
                <i class="fas fa-plus"></i> Tambah Customer
            </a>
        </div>

        <div class="table-responsive">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Customer</th>
                        <th>NIK (KTP)</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $key => $c)
                    <tr>
                        <td style="color:#6B7A99;">{{ $key + 1 }}</td>
                        <td><strong>{{ $c->nama }}</strong></td>
                        <td>
                            <code style="background:#F0F4F8;padding:2px 7px;border-radius:5px;font-size:12px; color:#1A2E4A;">
                                {{ $c->nik }}
                            </code>
                        </td>
                        <td>{{ $c->no_telp }}</td>
                        <td>{{ $c->alamat }}</td>
                        <td class="text-center">
                            <div style="display:flex;gap:6px;justify-content:center;">
                                <a href="{{ url('/customer/' . $c->id_customer . '/edit') }}" class="btn-edit">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                {{-- Form hapus --}}
                                <form id="form-hapus-{{ $c->id_customer }}"
                                      action="{{ url('/customer/' . $c->id_customer) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn-hapus"
                                        onclick="konfirmasiHapus('{{ $c->id_customer }}', '{{ $c->nama }}')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:#6B7A99;">
                            <i class="fas fa-users" style="font-size:36px;display:block;margin-bottom:10px;opacity:.3;"></i>
                            Belum ada data customer.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function konfirmasiHapus(id, nama) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        html: `Data customer <strong>"${nama}"</strong> akan dihapus permanen<br>dan tidak dapat dikembalikan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        focusCancel: true,
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-hapus-' + id).submit();
        }
    });
}
</script>

@endsection