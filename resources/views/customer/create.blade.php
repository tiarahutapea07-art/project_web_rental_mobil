@extends('layouts.admin')

@section('content')
<style>
    .edit-wrap { max-width: 700px; }

    .btn-back {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff; color: #1A2E4A;
        border: 1.5px solid #E2E8F0; border-radius: 9px;
        padding: 7px 16px; font-size: 13px; font-weight: 600;
        text-decoration: none; transition: all .18s;
        margin-bottom: 16px;
    }
    .btn-back:hover { border-color: #1A2E4A; color: #1A2E4A; text-decoration: none; }

    .page-title { font-size: 22px; font-weight: 800; color: #1A2E4A; margin: 0; }
    .page-subtitle { font-size: 13px; color: #6B7A99; margin-top: 3px; }

    .edit-card {
        background: #fff; border-radius: 16px;
        border: 1.5px solid #E2E8F0;
        box-shadow: 0 2px 16px rgba(26,46,74,.08);
        overflow: hidden; margin-top: 20px;
    }
    .edit-card-header {
        padding: 16px 24px; border-bottom: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        display: flex; align-items: center; gap: 12px;
    }
    .header-icon {
        width: 36px; height: 36px; background: #1A2E4A;
        border-radius: 9px; display: flex; align-items: center;
        justify-content: center; flex-shrink: 0;
    }
    .header-icon i { color: #F5A623; font-size: 15px; }
    .header-title { font-size: 14px; font-weight: 700; color: #1A2E4A; }
    .header-subtitle { font-size: 12px; color: #6B7A99; margin-top: 1px; }

    .edit-card-body { padding: 28px 24px; }

    .field-wrap { margin-bottom: 20px; }
    .field-wrap label {
        display: block; font-size: 13px; font-weight: 600;
        color: #1A2E4A; margin-bottom: 7px;
    }
    .field-wrap .form-control {
        border: 1.5px solid #E2E8F0; border-radius: 10px;
        padding: 10px 14px; font-size: 13.5px;
        background: #F8FAFC; color: #1A2E4A;
        transition: border-color .2s; font-family: inherit; width: 100%;
    }
    .field-wrap .form-control:focus {
        border-color: #1A2E4A;
        box-shadow: 0 0 0 3px rgba(26,46,74,.08);
        background: #fff; outline: none;
    }
    .field-wrap .form-control.is-invalid { border-color: #EF4444; }
    .invalid-feedback { font-size: 12px; color: #EF4444; margin-top: 4px; display: block; }

    .btn-row {
        display: flex; align-items: center; justify-content: flex-end;
        gap: 10px; margin-top: 28px;
        padding-top: 20px; border-top: 1.5px solid #E2E8F0;
    }
    .btn-batal {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 20px; border-radius: 9px;
        background: #fff; border: 1.5px solid #E2E8F0;
        color: #1A2E4A; font-size: 14px; font-weight: 600;
        text-decoration: none; transition: all .18s;
    }
    .btn-batal:hover { border-color: #1A2E4A; color: #1A2E4A; text-decoration: none; }
    .btn-simpan {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 22px; border-radius: 9px;
        background: #1A2E4A; color: #fff;
        border: none; font-size: 14px; font-weight: 700;
        cursor: pointer; transition: all .18s; font-family: inherit;
    }
    .btn-simpan:hover { background: #243d63; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(26,46,74,.2); }
</style>

<div class="edit-wrap">

    {{-- Tombol Kembali --}}
    <a href="{{ url('/customer') }}" class="btn-back">
        <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali
    </a>

    {{-- Judul --}}
    <div class="page-title">Tambah Customer</div>
    <div class="page-subtitle">Tambahkan data pelanggan rental mobil baru</div>

    {{-- Card Form --}}
    <div class="edit-card">
        <div class="edit-card-header">
            <div class="header-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div>
                <div class="header-title">Form Tambah Pelanggan</div>
                <div class="header-subtitle">Isi data customer dengan informasi yang benar</div>
            </div>
        </div>

        <div class="edit-card-body">
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf

                <div class="field-wrap">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama sesuai KTP" required>
                    @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="field-wrap">
                    <label>NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik"
                           class="form-control @error('nik') is-invalid @enderror"
                           value="{{ old('nik') }}"
                           placeholder="Contoh: 3201xxxxxxxxxxxx" maxlength="16" required>
                    @error('nik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="field-wrap">
                    <label>Nomor Telepon / WA</label>
                    <input type="text" name="no_telp"
                           class="form-control @error('no_telp') is-invalid @enderror"
                           value="{{ old('no_telp') }}"
                           placeholder="Contoh: 08123456789" required>
                    @error('no_telp')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="field-wrap">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"
                              class="form-control @error('alamat') is-invalid @enderror"
                              placeholder="Masukkan alamat domisili sekarang" required>{{ old('alamat') }}</textarea>
                    @error('alamat')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="btn-row">
                    <a href="{{ url('/customer') }}" class="btn-batal">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-simpan">
                        <i class="fas fa-save"></i> Simpan Customer
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection