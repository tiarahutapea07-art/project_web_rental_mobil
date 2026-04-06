<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Mobil;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function create($mobil_id)
    {
        $mobil = Mobil::findOrFail($mobil_id);
        if ($mobil->status !== 'tersedia') {
            return redirect('/mobil')->with('error', 'Mobil tidak tersedia untuk disewa.');
        }
        $customers = Customer::all();
        return view('rental.create', compact('mobil', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'customer_id' => 'required|exists:customers,id',
            'tanggal_sewa' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
        ]);

        $mobil = Mobil::findOrFail($request->mobil_id);
        if ($mobil->status !== 'tersedia') {
            return redirect('/mobil')->with('error', 'Mobil tidak tersedia untuk disewa.');
        }

        $tanggalSewa = Carbon::parse($request->tanggal_sewa);
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);
        $lamaSewa = $tanggalSewa->diffInDays($tanggalKembali);
        $totalHarga = $lamaSewa * $mobil->harga_per_hari;

        Rental::create([
            'mobil_id' => $request->mobil_id,
            'customer_id' => $request->customer_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_sewa' => $lamaSewa,
            'total_harga' => $totalHarga,
            'status' => 'aktif',
        ]);

        // Update status mobil
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
