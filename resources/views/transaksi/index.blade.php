@extends('layouts.admin')

@section('content')
<style>
/* ── Transaksi Page — selaras dengan warna Dashboard ── */
.trx-subtitle {
    font-size: 13px;
    color: #6B7A99;
    margin-top: 3px;
}

/* Alert info — warna aksen oranye supaya nyambung ke dashboard */
.alert-otomatis {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(245, 166, 35, 0.10);
    border: 1.5px solid rgba(245, 166, 35, 0.30);
    color: #92600a;
    border-radius: 10px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 500;
}

/* Alert success */
.alert-success-custom {
    display: flex;
    align-items: center;
    gap: 9px;
    background: rgba(34, 197, 94, 0.08);
    border: 1.5px solid rgba(34, 197, 94, 0.25);
    color: #16a34a;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 18px;
}

/* Card */
.trx-card {
    background: #fff;
    border-radius: 14px;
    border: 1.5px solid #E2E8F0;
    box-shadow: 0 2px 16px rgba(26,46,74,.09);
    overflow: hidden;
}
.trx-card-top {
    padding: 18px 22px;
    border-bottom: 1.5px solid #E2E8F0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.trx-card-label {
    font-size: 18px;
    font-weight: 800;
    color: #1A2E4A;
    display: flex;
    align-items: center;
    gap: 8px;
}
.trx-card-label i { color: #F5A623; }

/* Tombol tambah — navy seperti dashboard */
.btn-tambah {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 17px;
    border-radius: 9px;
    background: #1A2E4A;
    color: #fff !important;
    font-size: 13.5px;
    font-weight: 600;
    border: none;
    text-decoration: none;
    transition: all .18s;
}
.btn-tambah:hover {
    background: #243d63;
    box-shadow: 0 4px 12px rgba(26,46,74,.2);
    transform: translateY(-1px);
    color: #fff !important;
}

/* Table */
/* Table */
.trx-table { width: 100%; border-collapse: collapse; border: 1px solid #E2E8F0; }
.trx-table thead tr { background: #1A2E4A; }
.trx-table th {
    padding: 12px 16px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .65px;
    color: rgba(255,255,255,.75);
    border-right: 1px solid rgba(255,255,255,.15);
}
.trx-table th:last-child { border-right: none; }
.trx-table td {
    padding: 13px 16px;
    font-size: 13.5px;
    border-bottom: 1px solid #E2E8F0;
    border-right: 1px solid #E2E8F0;
    vertical-align: middle;
    color: #1A2E4A;
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
/* Aksi buttons */
.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    background: #fff;
    border: 1.5px solid #E2E8F0;
    color: #1A2E4A;
    text-decoration: none;
    transition: all .15s;
}
.btn-detail:hover { border-color: #1A2E4A; color: #1A2E4A; }
.btn-print {
    width: 30px;
    height: 30px;
    border-radius: 7px;
    background: #fff;
    border: 1.5px solid #E2E8F0;
    color: #6B7A99;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .15s;
    font-size: 12px;
}
.btn-print:hover { border-color: #1A2E4A; color: #1A2E4A; }
.btn-lunas {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    background: #22C55E;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: all .15s;
}
.btn-lunas:hover { background: #16a34a; transform: translateY(-1px); }

.aksi-group { display: flex; align-items: center; gap: 5px; justify-content: center; flex-wrap: wrap; }

/* Modal Tandai Lunas */
.modal-overlay {
    display: none; position: fixed; inset: 0; z-index: 999;
    background: rgba(26,46,74,.45);
    align-items: center; justify-content: center;
}
.modal-overlay.show { display: flex; }
.modal-box {
    background: #fff; border-radius: 16px;
    width: 100%; max-width: 400px;
    box-shadow: 0 20px 60px rgba(26,46,74,.2);
    overflow: hidden;
    animation: modalIn .2s ease;
}
@keyframes modalIn { from{transform:scale(.95);opacity:0} to{transform:scale(1);opacity:1} }
.modal-head {
    background: #1A2E4A; padding: 18px 22px;
    display: flex; align-items: center; gap: 10px;
}
.modal-head i { color: #F5A623; font-size: 16px; }
.modal-head span { color: #fff; font-weight: 700; font-size: 15px; }
.modal-body { padding: 22px; }
.modal-info { font-size: 13.5px; color: #6B7A99; margin-bottom: 18px; }
.modal-info strong { color: #1A2E4A; }
.modal-body label { font-size: 12px; font-weight: 700; color: #6B7A99; text-transform: uppercase; letter-spacing: .6px; display: block; margin-bottom: 7px; }
.modal-select {
    width: 100%; padding: 10px 14px; border-radius: 9px;
    border: 1.5px solid #E2E8F0; font-family: inherit;
    font-size: 14px; color: #1A2E4A; background: #F8FAFC;
    outline: none; transition: border-color .15s;
}
.modal-select:focus { border-color: #1A2E4A; }
.modal-footer {
    padding: 14px 22px; border-top: 1.5px solid #E2E8F0;
    display: flex; gap: 8px; justify-content: flex-end;
}
.btn-modal-cancel {
    padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600;
    background: #fff; border: 1.5px solid #E2E8F0; color: #1A2E4A; cursor: pointer; transition: all .15s;
}
.btn-modal-cancel:hover { border-color: #1A2E4A; }
.btn-modal-confirm {
    padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 700;
    background: #22C55E; color: #fff; border: none; cursor: pointer;
    display: inline-flex; align-items: center; gap: 6px; transition: all .15s;
}
.btn-modal-confirm:hover { background: #16a34a; }

/* Empty state */
.empty-state {
    padding: 48px 20px;
    text-align: center;
    color: #6B7A99;
}
.empty-state i { font-size: 38px; display: block; margin-bottom: 12px; opacity: .35; }
</style>

<div class="container-fluid px-0">

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert-success-custom">
        <i class="fas fa-circle-check"></i>
        {{ session('success') }}
        <span style="margin-left:auto;cursor:pointer;opacity:.5;font-size:15px;"
              onclick="this.parentElement.remove()">✕</span>
    </div>
    @endif

    {{-- Card Table --}}
    <div class="trx-card">
        <div class="trx-card-top">
            <div>
                <div class="trx-card-label">
                    <i class="fas fa-receipt"></i>
                    Data Transaksi
                </div>
                <p class="trx-subtitle" style="margin-top:4px;margin-left:26px;">Riwayat pembayaran & status transaksi</p>
            </div>
            <div style="display:flex;align-items:center;gap:12px;">
                <div class="alert-otomatis">
                    <i class="fas fa-circle-info"></i>
                    Transaksi tercatat otomatis dari penyewaan.
                </div>
                <a href="{{ route('transaksi.create') }}" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Transaksi Manual
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="trx-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:48px;">No</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Total Sewa</th>
                        <th>Dibayar</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($transaksis as $trx)
    <tr>
        <td class="text-center" style="color:#6B7A99;font-size:13px;">
            {{ $loop->iteration }}
        </td>

        <td>
            <strong>{{ $trx->rental->customer->nama ?? '-' }}</strong>
        </td>

        <td>
            {{ $trx->rental->mobil->nama_mobil }}
        </td>

        <td style="font-weight:700;">
            Rp {{ number_format($trx->rental->total_harga, 0, ',', '.') }}
        </td>

        <td style="color:#22C55E;font-weight:600;">
            Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}
        </td>

        {{-- ✅ STATUS (SUDAH DIPERBAIKI) --}}
        <td class="text-center">
            @if($trx->status == 'lunas')
                <span class="badge-lunas">Lunas</span>
            @else
                <span class="badge-belum">Belum Lunas</span>
            @endif


        </td>

        {{-- ✅ AKSI --}}
        <td class="text-center">
            <div class="aksi-group">

                {{-- Detail --}}
                <a href="{{ route('transaksi.show', $trx->id) }}" class="btn-detail">
                    <i class="fas fa-eye"></i> Detail
                </a>

                {{-- Print --}}
                <a href="{{ route('transaksi.print', $trx->id) }}" target="_blank" class="btn-print" title="Print">
                    <i class="fas fa-print"></i>
                </a>

                {{-- Tombol Lunas hanya muncul kalau belum lunas --}}
                @if($trx->status != 'lunas')
                <form action="{{ route('transaksi.lunas', $trx->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-lunas">
                        <i class="fas fa-circle-check"></i> Tandai Lunas
                    </button>
                </form>
                @endif

            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7">
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                Belum ada data transaksi.
            </div>
        </td>
    </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>

</div>

@endsection