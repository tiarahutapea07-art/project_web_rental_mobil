<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Mobil;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Transaksi;
use Yajra\DataTables\DataTables;

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
        'metode_bayar'    => 'required|in:cash,transfer,qris',
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
            'alamat' => $request->alamat,
            'email' => $request->nik . '@example.com', // Default email
            'password' => Hash::make('password123'), // Default password
        ]
    );

    $tanggalSewa    = Carbon::parse($request->tanggal_sewa);
    $tanggalKembali = Carbon::parse($request->tanggal_kembali);
    $lamaSewa       = $tanggalSewa->diffInDays($tanggalKembali);
    $totalHarga     = $lamaSewa * $mobil->harga_per_hari;



    $rental = Rental::create([
        'mobil_id'        => $request->mobil_id,
        'customer_id'     => $customer->id,
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
        'metode_bayar'=> $request->metode_bayar,
    ]);

    $mobil->update(['status' => 'tidak tersedia']);

    return redirect('/mobil')->with('success', 'Mobil berhasil disewa!');
}

public function index()
{
    if (request()->ajax()) {
        return $this->getDataTables();
    }
    return view('rental.index');
}

public function getDataTables()
{
    $rentals = Rental::with('mobil', 'customer')->select('rentals.*');

    return DataTables::of($rentals)
        ->addIndexColumn()
        ->addColumn('nama_mobil', function ($rental) {
            return $rental->mobil->nama_mobil;
        })
        ->addColumn('customer', function ($rental) {
            return $rental->customer->nama;
        })
        ->addColumn('tanggal_sewa_formatted', function ($rental) {
            return Carbon::parse($rental->tanggal_sewa)->format('d M Y');
        })
        ->addColumn('tanggal_kembali_formatted', function ($rental) {
            return Carbon::parse($rental->tanggal_kembali)->format('d M Y');
        })
        ->addColumn('lama_sewa_formatted', function ($rental) {
            return $rental->lama_sewa . ' hari';
        })
        ->addColumn('total_harga_formatted', function ($rental) {
            return 'Rp ' . number_format($rental->total_harga, 0, ',', '.');
        })
        ->addColumn('status_badge', function ($rental) {
            return '<span class="status-badge status-' . $rental->status . '">' . ucfirst($rental->status) . '</span>';
        })
        ->addColumn('aksi', function ($rental) {
            if ($rental->status == 'aktif') {
                return '<form action="' . route('rental.return', $rental->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="POST">
                    <button type="submit" class="btn-return"
                        onclick="return confirm(\'Apakah mobil sudah dikembalikan?\');">
                        <i class="fas fa-undo mr-1"></i>Kembalikan
                    </button>
                </form>';
            } else {
                return '<span class="text-muted">—</span>';
            }
        })
        ->rawColumns(['status_badge', 'aksi'])
        ->make(true);
}

public function return($id)
{
    $rental = Rental::findOrFail($id);

    $rental->update(['status' => 'selesai']);

    $rental->mobil->update(['status' => 'tersedia']);
    Transaksi::where('rental_id', $rental->id)
        ->update(['status_bayar' => 'lunas']);

    return redirect('/rental')->with('success', 'Mobil berhasil dikembalikan.');
}


}
