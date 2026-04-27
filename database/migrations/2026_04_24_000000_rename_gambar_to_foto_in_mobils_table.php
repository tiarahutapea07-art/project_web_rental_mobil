<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    if (Schema::hasColumn('mobils', 'gambar')) {
        Schema::table('mobils', function (Blueprint $table) {
            $table->renameColumn('gambar', 'foto');
        });
    }
    }


    public function down()
    {
    if (Schema::hasColumn('mobils', 'foto')) {
        Schema::table('mobils', function (Blueprint $table) {
            $table->renameColumn('foto', 'gambar');
        });
    }
    }

};
