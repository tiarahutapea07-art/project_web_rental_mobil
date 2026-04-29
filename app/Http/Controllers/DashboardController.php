<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() 
    {
        // Reconcile mobil status against active rentals to fix old/broken data.
        $this->reconcileMobilStatuses();

        $totalMobil = Mobil::count();
        $mobilDisewa = Rental::where('status', 'aktif')->distinct('mobil_id')->count('mobil_id');
        $mobilTersedia = $totalMobil - $mobilDisewa;

        $pembayaranLunas = Transaksi::where('status_pembayaran', 'Lunas')->count();
        $pembayaranMenunggu = Transaksi::where('status_pembayaran', 'Menunggu Konfirmasi')->count();
        $pembayaranBelum = Transaksi::where('status_pembayaran', 'Belum Lunas')->count();

        // NEW: Monthly Revenue & Transactions for current year
        $revenueData = $this->getMonthlyRevenue();
        $transactionData = $this->getMonthlyTransactions();

        return view('dashboard', compact(
            'totalMobil', 
            'mobilTersedia', 
            'mobilDisewa',
            'pembayaranLunas',
            'pembayaranMenunggu',
            'pembayaranBelum',
            'revenueData',
            'transactionData'
        ));
    }

    /**
     * Get monthly revenue (sum of jumlah_bayar) for current year
     * Returns array with 12 values (Jan-Dec), including months with 0 revenue
     */
    private function getMonthlyRevenue()
    {
        $currentYear = Carbon::now()->year;
        
        $monthlyData = Transaksi::selectRaw('MONTH(created_at) as month, SUM(jumlah_bayar) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Ensure all 12 months exist
        $revenues = [];
        for ($month = 1; $month <= 12; $month++) {
            $revenues[] = $monthlyData[$month] ?? 0;
        }

        return $revenues;
    }

    /**
     * Get monthly transaction count for current year
     * Returns array with 12 values (Jan-Dec), including months with 0 transactions
     */
    private function getMonthlyTransactions()
    {
        $currentYear = Carbon::now()->year;
        
        $monthlyData = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Ensure all 12 months exist
        $transactions = [];
        for ($month = 1; $month <= 12; $month++) {
            $transactions[] = $monthlyData[$month] ?? 0;
        }

        return $transactions;
    }

    /**
     * Reconcile mobil status with active rentals.
     * This fixes stale or broken mobil data by marking currently rented cars as unavailable
     * and making cars without an active rental available again.
     */
    private function reconcileMobilStatuses()
    {
        $activeMobilIds = Rental::where('status', 'aktif')
            ->distinct('mobil_id')
            ->pluck('mobil_id')
            ->toArray();

        Mobil::whereIn('id', $activeMobilIds)
            ->update(['status' => 'tidak tersedia']);

        Mobil::whereNotIn('id', $activeMobilIds)
            ->update(['status' => 'tersedia']);
    }
}
