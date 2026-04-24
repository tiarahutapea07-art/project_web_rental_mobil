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
        // Mapping nama_mobil ke foto yang benar
        $fotoMapping = [
            'Daihatsu Agya' => 'agya.png',
            'Ambulance' => 'ambulance.png',
            'Toyota Avanza' => 'avanza.png',
            'Daihatsu Ayla' => 'ayla.png',
            'Suzuki Baleno' => 'baleno.png',
            'Honda Brio' => 'brio.png',
            'Cabroilet Convertible' => 'cabroilet.png',
            'Mitsubishi Expander' => 'expander.png',
            'Toyota Fortuner' => 'fortuner.png',
            'Honda HR-V' => 'hr-v.png',
            'Honda Jazz' => 'jazz.png',
            'Mobil Listrik' => 'listrik.png',
            'Mitsubishi Pajero Sport' => 'pajerosport.png',
            'Pick-up Truck' => 'pickup.png',
            'Daihatsu Sigra' => 'sigra.png',
            'Hino Silion' => 'silion.png',
            'Toyota Avanza Premium' => 'toyota_avanza.png',
            'Mini Van' => 'van.png',
            'Wagon Family' => 'wagon.png',
            'X-Over SUV' => 'x-over.png',
            'Toyota Yaris' => 'yariz.png',
        ];

        // Update semua mobil dengan foto yang benar
        foreach ($fotoMapping as $nama => $foto) {
            DB::table('mobils')
                ->where('nama_mobil', $nama)
                ->update(['foto' => $foto]);
        }

        // Hapus duplikat - keep yang punya foto.png format (dari seeder), hapus yang punya timestamp
        DB::table('mobils')
            ->where('foto', 'NOT LIKE', '%.png')
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu rollback custom, migration tidak mengubah structure
    }
};
