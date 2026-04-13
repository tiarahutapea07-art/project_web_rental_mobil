<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        $rentalAktif = Rental::where('status', 'aktif')->pluck('mobil_id')->toArray();
        return view('mobil.index', compact('mobils', 'rentalAktif'));
    }

    public function create()
    {
        return view('mobil.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'harga_per_hari' => 'required|numeric|min:0',
            'no_polisi' => 'required|string|max:20',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $namaFile = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaFile);
        }

        Mobil::create([
            'nama_mobil' => $validated['nama_mobil'],
            'harga_per_hari' => $validated['harga_per_hari'],
            'status' => 'tersedia',
            'no_polisi' => $validated['no_polisi'],
            'gambar'  => $namaFile
        ]);

        return redirect('/mobil')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $mobil = Mobil::find($id);
        $mobil->delete();

        return redirect('/mobil');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'harga_per_hari' => 'required|numeric|min:0',
            'no_polisi' => 'required|string|max:20',
            'status' => 'required|in:tersedia,tidak tersedia'
        ]);
        
        $mobil = Mobil::findOrFail($id);
        $mobil->update(['status' => 'tidak tersedia']);

dd('SUKSES - data tersimpan'); // ← tambahkan ini sementara

return redirect('/mobil')->with('success', 'Mobil berhasil disewa!');
    }
            
            public function edit($id)
            {
                $mobil = Mobil::findOrFail($id);
                return view('mobil.edit', compact('mobil'));
            }
}

