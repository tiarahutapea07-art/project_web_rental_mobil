<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable =[
        'nama_mobil',
        'harga_per_hari',
        'status',
        'no_polisi',
        'foto',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
