<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Transaksi;
use App\Models\Rental;
use Carbon\Carbon;

class AuthController extends Controller
{
    // tampilkan halaman login
    public function showLogin(){
        return view('login');
    }

    // proses login
    public function login(Request $request){
        if($request->username == 'kelompok6' && $request->password == '12345'){
            session(['login' => true]);
            return redirect('/dashboard');
        }else{
            return back()->with('error', 'Login gagal');
        }
    }

    // halaman dashboard
    public function dashboard(){
        if(!session('login')){
            return redirect('/login');
        }

        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = Rental::where('status', 'aktif')->count();

        // Monthly Revenue & Transactions for current year
        $currentYear = Carbon::now()->year;
        
        $monthlyRevenue = Transaksi::selectRaw('MONTH(created_at) as month, SUM(jumlah_bayar) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyTransactions = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $revenueData = [];
        $transactionData = [];
        for ($month = 1; $month <= 12; $month++) {
            $revenueData[] = $monthlyRevenue[$month] ?? 0;
            $transactionData[] = $monthlyTransactions[$month] ?? 0;
        }

        return view('dashboard', compact('totalMobil','mobilTersedia','mobilDisewa','revenueData','transactionData'));
    }

    // logout
    public function logout(){
        session()->flush();
        return redirect('/login');
    }
}