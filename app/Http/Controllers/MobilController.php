<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil ::all();
        return view('mobil.index', compact('mobils'));
    }

    public function create()
    {
        return view('mobil.create');
    }
    public function store(Request $request)
    {
        $namaFile = null;

        if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('img'), $namaFile); // Simpan ke folder public/img
        }

        Mobil::create([
            'nama_mobil' => $request->nama_mobil,
            'harga_per_hari' => $request->harga_per_hari,
            'status' => 'tersedia',
            'no_polisi' => $request->no_polisi,
            'gambar'  => $namaFile
            
    
        ]);

        return redirect('/mobil');
    }

    public function destroy($id)
    {
        $mobil = Mobil::find($id);
        $mobil->delete();

        return redirect('/mobil');
    }

    public function update(Request $request, $id)
    {

        //Validasi input
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'harga_per_hari' => 'required|numeric',
            ]);
            
            // Cari mobil berdasarkan ID
            $mobil = Mobil::findOrFail($id);
            
            // Update data
            $mobil->nama_mobil = $request->nama_mobil;
            $mobil->harga_per_hari = $request->harga_per_hari;
            $mobil->save();
            
            // Redirect atau tampilkan pesan sukses
            return redirect('/mobil')->with('success', 'Data mobil berhasil diupdate!');
            }
            
            public function edit($id)
            {
                // 1. Ambil data mobil berdasarkan ID
                $mobil = Mobil::findOrFail($id);
                
                // 2. Tampilkan view edit dan kirim data mobilnya
                return view('mobil.edit', compact('mobil'));
                }

    }


    

