<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'rental_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_bayar',
        'status_bayar',
        'bukti_bayar'
    ];
    
    public function rental()
    {
        return $this->belongTo(Rental::class);
    }
}
