<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    // protected $primaryKey = 'id_customer'; // Commented out - using default 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'nik', 'no_telp', 'alamat', 'email', 'password'];
}