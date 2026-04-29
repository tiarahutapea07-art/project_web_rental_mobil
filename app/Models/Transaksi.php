<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'rental_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'total_harga',
        'jumlah_bayar',
        'metode_bayar',
        'status_pembayaran',
        'status_transaksi',
        'tanggal_bayar',
        'bukti_pembayaran',
        'bukti_bayar'
    ];

    // Relasi ke rental
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    // Akses user lewat rental (optional helper)
    public function getUserAttribute()
    {
        return $this->rental ? $this->rental->user : null;
    }

    
}
