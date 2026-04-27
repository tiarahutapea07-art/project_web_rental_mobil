<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'mobil_id',
        'customer_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'lama_sewa',
        'total_harga',
        'status',
    ];

    public function mobil()
{
    return $this->belongsTo(Mobil::class);
}

public function customer()
{
    return $this->belongsTo(Customer::class); // ✅ karena tabel kamu customers
}

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function index()
{
    $transaksi = Transaksi::with('rental.mobil')->get();

    dd($transaksi); // ⬅️ tambahkan ini
}

public function store(Request $request)
{
    $rental = Rental::with('mobil')->findOrFail($request->rental_id);

    $lama = \Carbon\Carbon::parse($request->tanggal_sewa)
            ->diffInDays($request->tanggal_kembali);

    $harga = $rental->mobil->harga_per_hari;

    $total = $lama * $harga;

    Transaksi::create([
        'rental_id' => $request->rental_id,
        'tanggal_sewa' => $request->tanggal_sewa,
        'tanggal_kembali' => $request->tanggal_kembali,
        'total_harga' => $total,
        'metode_bayar' => $request->metode_bayar,
        'status_pembayaran' => 'Belum Lunas'
    ]);

    return redirect()->route('transaksi.index');
}






}
