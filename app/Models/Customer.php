<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Customer extends Model
{
    protected $table = 'customers';
    // protected $primaryKey = 'id_customer'; // Commented out - using default 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'nik', 'no_telp', 'alamat', 'email', 'password'];

    // Enkripsi password menggunakan MD5 (sistem enkripsi yang diminta)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }

    // Enkripsi nomor telepon menggunakan sistem berlapis (Crypt untuk data sensitif)



}