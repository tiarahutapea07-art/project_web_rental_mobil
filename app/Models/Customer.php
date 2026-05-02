<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id_customer'; // ← aktifkan ini
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'nik', 'no_telp', 'alamat']; // ← hapus email & password
}