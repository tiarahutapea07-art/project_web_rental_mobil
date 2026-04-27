<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->date('tanggal_sewa')->nullable();
        $table->date('tanggal_kembali')->nullable();
        $table->integer('total_harga')->default(0);
        $table->string('status_pembayaran')->default('Belum Lunas');
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropColumn([
            'tanggal_sewa',
            'tanggal_kembali',
            'total_harga',
            'status_pembayaran'
        ]);
    });
}

};
