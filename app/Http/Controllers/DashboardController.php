<?php

namespace App\Http\Controllers;

use App\Models\Mobil;

class DashboardController extends Controller
{
    public function index() 
    {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = Mobil::where('status', 'tidak tersedia')->count();

        return view('dashboard', compact(
            'totalMobil', 
            'mobilTersedia', 
            'mobilDisewa'
        ));
    }
}