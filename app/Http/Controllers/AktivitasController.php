<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class AktivitasController extends Controller
{
    // LIST AKTIVITAS
    public function index(Request $request)
    {
        $query = Transaksi::with('rental.mobil', 'rental.customer');

        // 🔥 OPTIONAL FILTER STATUS (kalau mau dipakai)
        if ($request->status) {
            $query->where('status_transaksi', $request->status);
        }

        $transaksis = $query->latest()->get();

        return view('aktivitas.index', compact('transaksis'));
    }

    // DETAIL AKTIVITAS
    public function show($id)
    {
        $transaksi = Transaksi::with('rental.mobil', 'rental.customer')
            ->findOrFail($id);

        return view('aktivitas.show', compact('transaksi'));
    }
}
