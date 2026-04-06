<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nik', 'no_telp', 'alamat'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
