<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class DashboardController extends Controller
{
    public function index() 
    {
        $totalMobil = \App\Models\Mobil::count();
        $mobilTersedia = \App\Models\Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = \App\Models\Mobil::where('status', 'disewa')->count();
        // Kirim semua variabel ke view dashboard
        return view('dashboard', compact(
            'totalMobil', 
            'mobilTersedia', 
            'mobilDisewa'));
       
    }
}
