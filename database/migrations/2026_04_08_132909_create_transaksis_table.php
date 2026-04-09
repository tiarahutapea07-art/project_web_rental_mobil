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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained()->onDelete('cascade');

        $table->date('tanggal_bayar')->nullable();
        $table->decimal('jumlah_bayar', 15, 2)->default(0);

        $table->enum('metode_bayar', ['cash', 'transfer'])->nullable();
        $table->enum('status_bayar', ['belum', 'lunas'])->default('belum');

        $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
