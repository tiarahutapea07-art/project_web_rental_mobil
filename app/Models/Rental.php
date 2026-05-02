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
    return $this->belongsTo(Customer::class, 'customer_id', 'id_customer'); 
}

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
