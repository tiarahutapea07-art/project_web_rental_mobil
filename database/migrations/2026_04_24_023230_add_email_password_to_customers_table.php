<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('customers', function (Blueprint $table) {
        if (!Schema::hasColumn('customers', 'email')) {
            $table->string('email')->nullable();
        }

        if (!Schema::hasColumn('customers', 'password')) {
            $table->string('password')->nullable();
        }
    });
}

};