@extends('layouts.admin')

@section('content')
<style>
    .card-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .card-box-title {
        font-size: 1rem;
        font-weight: 700;
        color: #2b3e84;
        margin-bottom: 1.25rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f0f2f5;
    }

    #userTable thead th {
        background: white;
        color: #2c3e50;
        font-weight: 700;
        font-size: 0.9rem;
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        padding: 0.85rem 0.75rem;
    }

    #userTable tbody tr:hover { background: #f8f9fa; }

    #userTable tbody td {
        padding: 0.85rem 0.75rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
        color: #2c3e50;
        font-size: 0.9rem;
    }

    .role-badge {
        padding: 0.3rem 0.85rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.78rem;
        color: white;
        display: inline-block;
    }

    .role-admin { background: linear-gradient(135deg, #667eea, #764ba2); }
    .role-user  { background:  #227f94 }

    .btn-delete {
        background:  #e74a3b;
        border: none;
        color: white;
        padding: 0.28rem 0.7rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(231,74,59,0.4);
        color: white;
    }

    .form-control-sm { font-size: 0.85rem; }

    .dataTables_wrapper { font-size: 0.875rem; color: #2c3e50; }
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0.28rem 0.55rem;
        font-size: 0.875rem;
        outline: none;
    }
    .dataTables_wrapper .dataTables_info { font-size: 0.82rem; color: #555; padding-top: 0.75rem; }
    .dataTables_wrapper .dataTables_paginate { padding-top: 0.5rem; }
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
        background: #5f6ee4 !important;
        color: white !important;
        border: 1px solid #92a1e4 !important;
        font-weight: 700;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f0f0f0 !important;
        color: #333 !important;
        border: 1px solid #ccc !important;
    }
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

{{-- Form Tambah Pengguna --}}
<div class="card-box">
    <div class="card-box-title">Tambah Pengguna</div>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-2">
                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama" required>
            </div>
            <div class="col-md-3 mb-2">
                <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" required>
            </div>
            <div class="col-md-2 mb-2">
                <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" required>
            </div>
            <div class="col-md-2 mb-2">
                <select name="role" class="form-control form-control-sm" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-plus mr-1"></i>Tambah
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Tabel Pengguna --}}
<div class="card-box">
    <div class="card-box-title">Daftar Pengguna</div>
    <table id="userTable" class="table w-100">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><i class="fas fa-user-circle mr-1" style="color:#667eea"></i>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="role-badge role-{{ $user->role }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"
                            onclick="return confirm('Yakin hapus pengguna ini?');">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    <i class="fas fa-users fa-2x mb-2 d-block"></i>
                    Belum ada pengguna.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#userTable').DataTable({
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                paginate: { previous: "Previous", next: "Next" },
                emptyTable: "Tidak ada data pengguna"
            },
            pageLength: 10,
            columnDefs: [{ orderable: false, targets: '_all' }]
        });
    });
</script>
@endpush

@endsection