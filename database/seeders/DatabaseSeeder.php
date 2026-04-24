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
        // Default user untuk testing - gunakan firstOrCreate agar tidak duplikat
        User::firstOrCreate(
            ['email' => 'admin@rental.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@rental.com',
            ]
        );

        // Data mobil berdasarkan foto yang ada di public/img
        $daftar_mobil = [
            [
                'nama_mobil' => 'Daihatsu Agya',
                'harga_per_hari' => 350000,
                'no_polisi' => 'B 1001 AGL',
                'foto' => 'agya.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Ambulance',
                'harga_per_hari' => 500000,
                'no_polisi' => 'B 2001 AMB',
                'foto' => 'ambulance.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Avanza',
                'harga_per_hari' => 450000,
                'no_polisi' => 'B 3001 AVZ',
                'foto' => 'avanza.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Daihatsu Ayla',
                'harga_per_hari' => 350000,
                'no_polisi' => 'B 4001 AYL',
                'foto' => 'ayla.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Suzuki Baleno',
                'harga_per_hari' => 400000,
                'no_polisi' => 'B 5001 BLN',
                'foto' => 'baleno.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Honda Brio',
                'harga_per_hari' => 350000,
                'no_polisi' => 'B 6001 BRI',
                'foto' => 'brio.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Cabroilet Convertible',
                'harga_per_hari' => 600000,
                'no_polisi' => 'B 7001 CBR',
                'foto' => 'cabroilet.png',
                'status' => 'tidak tersedia'
            ],
            [
                'nama_mobil' => 'Mitsubishi Expander',
                'harga_per_hari' => 480000,
                'no_polisi' => 'B 8001 EXP',
                'foto' => 'expander.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Fortuner',
                'harga_per_hari' => 750000,
                'no_polisi' => 'B 9001 FRT',
                'foto' => 'fortuner.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Honda HR-V',
                'harga_per_hari' => 500000,
                'no_polisi' => 'B 10001 HRV',
                'foto' => 'hr-v.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Honda Jazz',
                'harga_per_hari' => 380000,
                'no_polisi' => 'B 11001 JZZ',
                'foto' => 'jazz.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Mobil Listrik',
                'harga_per_hari' => 400000,
                'no_polisi' => 'B 12001 LTK',
                'foto' => 'listrik.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Mitsubishi Pajero Sport',
                'harga_per_hari' => 700000,
                'no_polisi' => 'B 13001 PJS',
                'foto' => 'pajerosport.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Pick-up Truck',
                'harga_per_hari' => 450000,
                'no_polisi' => 'B 14001 PCK',
                'foto' => 'pickup.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Daihatsu Sigra',
                'harga_per_hari' => 420000,
                'no_polisi' => 'B 15001 SGR',
                'foto' => 'sigra.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Hino Silion',
                'harga_per_hari' => 550000,
                'no_polisi' => 'B 16001 SLN',
                'foto' => 'silion.png',
                'status' => 'tidak tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Avanza Premium',
                'harga_per_hari' => 500000,
                'no_polisi' => 'B 17001 AVP',
                'foto' => 'toyota_avanza.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Mini Van',
                'harga_per_hari' => 520000,
                'no_polisi' => 'B 18001 VAN',
                'foto' => 'van.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Wagon Family',
                'harga_per_hari' => 490000,
                'no_polisi' => 'B 19001 WGN',
                'foto' => 'wagon.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'X-Over SUV',
                'harga_per_hari' => 620000,
                'no_polisi' => 'B 20001 XOV',
                'foto' => 'x-over.png',
                'status' => 'tersedia'
            ],
            [
                'nama_mobil' => 'Toyota Yaris',
                'harga_per_hari' => 380000,
                'no_polisi' => 'B 21001 YRZ',
                'foto' => 'yariz.png',
                'status' => 'tersedia'
            ],
        ];

        // Insert semua data mobil
        foreach ($daftar_mobil as $mobil) {
            Mobil::firstOrCreate(
                ['foto' => $mobil['foto']],
                $mobil
            );
        }

        // Data customer dummy
        $daftar_customer = [
            [
                'nama' => 'John Doe',
                'nik' => '1234567890123456',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Sudirman No. 1, Jakarta'
            ],
            [
                'nama' => 'Jane Smith',
                'nik' => '2345678901234567',
                'no_telp' => '081234567891',
                'alamat' => 'Jl. Thamrin No. 2, Jakarta'
            ],
            [
                'nama' => 'Bob Johnson',
                'nik' => '3456789012345678',
                'no_telp' => '081234567892',
                'alamat' => 'Jl. Gatot Subroto No. 3, Jakarta'
            ],
            [
                'nama' => 'Alice Brown',
                'nik' => '4567890123456789',
                'no_telp' => '081234567893',
                'alamat' => 'Jl. MH Thamrin No. 4, Jakarta'
            ],
        ];

        // Insert data customer - commented out to avoid column errors
        // foreach ($daftar_customer as $customer) {
        //     \App\Models\Customer::firstOrCreate(
        //         ['nik' => $customer['nik']],
        //         $customer
        //     );
        // }
    }
}
