<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Rental;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('rental.customer', 'rental.mobil')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
{
    $rentals = Rental::with('customer', 'mobil')->get();
    return view('transaksi.create', compact('rentals'));
}

public function store(Request $request)
{
    $rental = Rental::findOrFail($request->rental_id);

    $status = $request->jumlah_bayar >= $rental->total_harga ? 'lunas' : 'belum';

    Transaksi::create([
        'rental_id' => $request->rental_id,
        'tanggal_bayar' => now(),
        'jumlah_bayar' => $request->jumlah_bayar,
        'metode_bayar' => $request->metode_bayar,
        'status_bayar' => $status,
    ]);

    // update status rental kalau lunas
    if ($status == 'lunas') {
        $rental->update(['status' => 'selesai']);
        // Kembalikan mobil ke status tersedia
        $rental->mobil->update(['status' => 'tersedia']);
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
}


public function show($id)
{
    $trx = Transaksi::with('rental.customer', 'rental.mobil')->findOrFail($id);
    return view('transaksi.show', compact('trx'));
}

}

