<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('rental_id')
                  ->constrained('rentals')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['rental_id']);
            $table->dropColumn('rental_id');
        });
    }
};
