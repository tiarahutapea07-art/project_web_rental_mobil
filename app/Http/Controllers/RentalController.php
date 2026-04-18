<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Mobil;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaksi;

class RentalController extends Controller
{
    public function create($mobil_id)
{
    $mobil = Mobil::findOrFail($mobil_id);
    if ($mobil->status !== 'tersedia') {
        return redirect('/mobil')->with('error', 'Mobil tidak tersedia untuk disewa.');
    }
    // Hapus $customers karena tidak dipakai lagi
    return view('rental.create', compact('mobil'));
}

public function store(Request $request)
{

    


    $request->validate([
        'mobil_id'        => 'required|exists:mobils,id',
        'nama'            => 'required|string|max:255',
        'nik'             => 'required|string|max:20',
        'tanggal_sewa'    => 'required|date',
        'tanggal_kembali' => 'required|date|after:tanggal_sewa',
    ]);

    $mobil = Mobil::findOrFail($request->mobil_id);
    if ($mobil->status !== 'tersedia') {
        return redirect('/mobil')->with('error', 'Mobil tidak tersedia untuk disewa.');
    }

    // Cek apakah customer dengan NIK ini sudah ada, kalau belum buat baru
    $customer = Customer::firstOrCreate(
        ['nik' => $request->nik],
        [
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
        'alamat'  => $request->alamat,]
    );

    $tanggalSewa    = Carbon::parse($request->tanggal_sewa);
    $tanggalKembali = Carbon::parse($request->tanggal_kembali);
    $lamaSewa       = $tanggalSewa->diffInDays($tanggalKembali);
    $totalHarga     = $lamaSewa * $mobil->harga_per_hari;



    $rental = Rental::create([
        'mobil_id'        => $request->mobil_id,
        'customer_id'     => $customer->id_customer,
        'tanggal_sewa'    => $request->tanggal_sewa,
        'tanggal_kembali' => $request->tanggal_kembali,
        'lama_sewa'       => $lamaSewa,
        'total_harga'     => $totalHarga,
        'status'          => 'aktif',

        
    ]);

    Transaksi::create([
        'rental_id' => $rental->id,
        'jumlah_bayar' => $totalHarga,
        'status_bayar' => 'belum',
    ]);

    $mobil->update(['status' => 'tidak tersedia']);

    return redirect('/mobil')->with('success', 'Mobil berhasil disewa!');
}

public function index()
{
    $rentals = Rental::with('mobil', 'customer')->get();
    return view('rental.index', compact('rentals'));
}

public function return($id)
{
    $rental = Rental::findOrFail($id);
    $rental->update(['status' => 'selesai']);
    $rental->mobil->update(['status' => 'tersedia']);
    return redirect('/rental')->with('success', 'Mobil berhasil dikembalikan.');
}


}
