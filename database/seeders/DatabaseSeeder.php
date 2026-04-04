<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default user untuk testing
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@rental.com',
        ]);

        // Data mobil berdasarkan foto yang ada di public/img
        $daftar_mobil = [
            [
                'nama_mobil' => 'Daihatsu Agya',
                'harga_per_hari' => 350000,
                'no_polisi' => 'B 1001 AGL',
                'gambar' => 'agya.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Ambulance',
                'harga_per_hari' => 500000,
                'no_polisi' => 'B 2001 AMB',
                'gambar' => 'ambulance.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Avanza',
                'harga_per_hari' => 450000,
                'no_polisi' => 'B 3001 AVZ',
                'gambar' => 'avanza.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Daihatsu Ayla',
                'harga_per_hari' => 350000,
                'no_polisi' => 'B 4001 AYL',
                'gambar' => 'ayla.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Suzuki Baleno',
                'harga_per_hari' => 400000,
                'no_polisi' => 'B 5001 BLN',
                'gambar' => 'baleno.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Honda Brio',
                'harga_per_hari' => 350000,
                'no_polisi' => 'B 6001 BRI',
                'gambar' => 'brio.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Cabroilet Convertible',
                'harga_per_hari' => 600000,
                'no_polisi' => 'B 7001 CBR',
                'gambar' => 'cabroilet.png',
                'status' => 'tidak tersedia'
            ],
            [
                'nama_mobil' => 'Mitsubishi Expander',
                'harga_per_hari' => 480000,
                'no_polisi' => 'B 8001 EXP',
                'gambar' => 'expander.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Fortuner',
                'harga_per_hari' => 750000,
                'no_polisi' => 'B 9001 FRT',
                'gambar' => 'fortuner.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Honda HR-V',
                'harga_per_hari' => 500000,
                'no_polisi' => 'B 10001 HRV',
                'gambar' => 'hr-v.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Honda Jazz',
                'harga_per_hari' => 380000,
                'no_polisi' => 'B 11001 JZZ',
                'gambar' => 'jazz.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Mobil Listrik',
                'harga_per_hari' => 400000,
                'no_polisi' => 'B 12001 LTK',
                'gambar' => 'listrik.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Mitsubishi Pajero Sport',
                'harga_per_hari' => 700000,
                'no_polisi' => 'B 13001 PJS',
                'gambar' => 'pajerosport.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Pick-up Truck',
                'harga_per_hari' => 450000,
                'no_polisi' => 'B 14001 PCK',
                'gambar' => 'pickup.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Daihatsu Sigra',
                'harga_per_hari' => 420000,
                'no_polisi' => 'B 15001 SGR',
                'gambar' => 'sigra.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Hino Silion',
                'harga_per_hari' => 550000,
                'no_polisi' => 'B 16001 SLN',
                'gambar' => 'silion.png',
                'status' => 'tidak tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Avanza Premium',
                'harga_per_hari' => 500000,
                'no_polisi' => 'B 17001 AVP',
                'gambar' => 'toyota_avanza.jpg',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Mini Van',
                'harga_per_hari' => 520000,
                'no_polisi' => 'B 18001 VAN',
                'gambar' => 'van.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Wagon Family',
                'harga_per_hari' => 490000,
                'no_polisi' => 'B 19001 WGN',
                'gambar' => 'wagon.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'X-Over SUV',
                'harga_per_hari' => 620000,
                'no_polisi' => 'B 20001 XOV',
                'gambar' => 'x-over.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Yaris',
                'harga_per_hari' => 380000,
                'no_polisi' => 'B 21001 YRZ',
                'gambar' => 'yariz.png',
                'status' => 'tersedia'
            ],
        ];

        // Insert semua data mobil
        foreach ($daftar_mobil as $mobil) {
            Mobil::firstOrCreate(
                ['gambar' => $mobil['gambar']],
                $mobil
            );
        }
    }
}
