<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('customer_id'); // Menghubung ke id_customer
            $table->unsignedBigInteger('mobil_id');    // Menghubung ke id_mobil
            $table->date('tgl_sewa');
            $table->date('tgl_kembali')->nullable();
            $table->integer('total_harga')->nullable();
            $table->string('status_transaksi'); // Contoh: 'berjalan', 'selesai'
            $table->timestamps();

            $table->foreign('customer_id')->references('id_customer')->on('customers')->onDelete('cascade');
        $table->foreign('mobil_id')->references('id_mobil')->on('mobils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
