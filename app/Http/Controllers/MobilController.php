<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Ambil data mobil
        $mobils = Mobil::when($search, function ($query, $search) {
            return $query->where('nama_mobil', 'like', '%' . $search . '%')
                         ->orWhere('no_polisi', 'like', '%' . $search . '%');
        })->get();

        // Ambil mobil yang sedang disewa
        $rentalAktif = Rental::where('status', 'aktif')
            ->distinct()
            ->pluck('mobil_id')
            ->toArray();

        // Sinkronisasi status mobil
        Mobil::whereIn('id', $rentalAktif)
            ->update(['status' => 'tidak tersedia']);

        Mobil::whereNotIn('id', $rentalAktif)
            ->update(['status' => 'tersedia']);

        // Refresh data mobil setelah update status
        $mobils = Mobil::when($search, function ($query, $search) {
            return $query->where('nama_mobil', 'like', '%' . $search . '%')
                         ->orWhere('no_polisi', 'like', '%' . $search . '%');
        })->get();

        return view('mobil.index', compact('mobils', 'rentalAktif'));
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil'      => 'required|string|max:255',
            'harga_per_hari'  => 'required|numeric|min:0',
            'no_polisi'       => 'required|string|max:20',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $namaFile = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaFile);
        }

        Mobil::create([
            'nama_mobil'      => $validated['nama_mobil'],
            'harga_per_hari'  => $validated['harga_per_hari'],
            'status'          => 'tersedia',
            'no_polisi'       => $validated['no_polisi'],
            'foto'            => $namaFile
        ]);

        return redirect('/mobil')
            ->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);

        return view('mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_mobil'      => 'required|string|max:255',
            'harga_per_hari'  => 'required|numeric|min:0',
            'no_polisi'       => 'required|string|max:20',
            'status'          => 'required|in:tersedia,tidak tersedia'
        ]);

        $mobil = Mobil::findOrFail($id);

        $namaFile = $mobil->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaFile);
        }

        $mobil->update([
            'nama_mobil'      => $request->nama_mobil,
            'harga_per_hari'  => $request->harga_per_hari,
            'no_polisi'       => $request->no_polisi,
            'status'          => $request->status,
            'foto'            => $namaFile,
        ]);

        return redirect('/mobil')
            ->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        // Hapus foto jika ada
        if ($mobil->foto && file_exists(public_path('img/' . $mobil->foto))) {
            unlink(public_path('img/' . $mobil->foto));
        }

        $mobil->delete();

        return redirect('/mobil')
            ->with('success', 'Mobil berhasil dihapus!');
    }
}