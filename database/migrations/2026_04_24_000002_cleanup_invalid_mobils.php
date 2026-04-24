<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus semua mobil yang file fotonya tidak ada
        $fotoFiles = [
            'agya.png',
            'ambulance.png',
            'avanza.png',
            'ayla.png',
            'baleno.png',
            'brio.png',
            'cabroilet.png',
            'expander.png',
            'fortuner.png',
            'hr-v.png',
            'jazz.png',
            'listrik.png',
            'pajerosport.png',
            'pickup.png',
            'sigra.png',
            'silion.png',
            'toyota_avanza.png',
            'van.png',
            'wagon.png',
            'x-over.png',
            'yariz.png',
        ];

        // Hapus mobil yang fotonya bukan dari list valid
        DB::table('mobils')->whereNotIn('foto', $fotoFiles)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu rollback
    }
};
