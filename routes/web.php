<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Mobil;
use App\Models\Rental;
use App\Models\Transaksi;
use Carbon\Carbon;



// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/aktivitas', [AktivitasController::class,'index'])->name('aktivitas.index');
Route::get('/aktivitas/{id}',[AktivitasController::class,'show'])->name('aktivitas.show');

Route::post('/transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');
Route::put('/transaksi/{id}/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');






// HELPER FUNCTIONS
function getMonthlyRevenue() {
    $currentYear = Carbon::now()->year;
    $monthlyData = Transaksi::selectRaw('MONTH(created_at) as month, SUM(jumlah_bayar) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

    $revenues = [];
    for ($month = 1; $month <= 12; $month++) {
        $revenues[] = $monthlyData[$month] ?? 0;
    }
    return $revenues;
}

function getMonthlyTransactions() {
    $currentYear = Carbon::now()->year;
    $monthlyData = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

    $transactions = [];
    for ($month = 1; $month <= 12; $month++) {
        $transactions[] = $monthlyData[$month] ?? 0;
    }
    return $transactions;
}

// ROOT
Route::get('/', [AuthController::class, 'showLogin'])->name('home');

// DASHBOARD — admin only
Route::get('/dashboard', function () {
    if (!session('login')) return redirect('/login');
    if (session('role') !== 'admin') return redirect('/mobil')->with('error', 'Akses ditolak!');

    $totalMobil = Mobil::count();
    $mobilDisewa = Rental::where('status', 'aktif')->distinct('mobil_id')->count('mobil_id');
    $mobilTersedia = $totalMobil - $mobilDisewa;

    $pembayaranLunas = Transaksi::where('status_pembayaran', 'Lunas')->count();
    $pembayaranMenunggu = Transaksi::where('status_pembayaran', 'Menunggu Konfirmasi')->count();
    $pembayaranBelum = Transaksi::where('status_pembayaran', 'Belum Lunas')->count();

    $grafikSewa = [12,19,15,22,18,30,25,28,24,20,26,32];

    $topMobil = [
        ['nama' => 'Avanza', 'jumlah' => 22],
        ['nama' => 'Brio', 'jumlah' => 18],
        ['nama' => 'Xenia', 'jumlah' => 15],
        ['nama' => 'Innova', 'jumlah' => 12],
        ['nama' => 'Ayla', 'jumlah' => 10],
    ];

    $revenueData = getMonthlyRevenue();
    $transactionData = getMonthlyTransactions();

    return view('dashboard', compact(
        'totalMobil',
        'mobilTersedia',
        'mobilDisewa',
        'pembayaranLunas',
        'pembayaranMenunggu',
        'pembayaranBelum',
        'grafikSewa',
        'topMobil',
        'revenueData',
        'transactionData'
    ));
})->name('dashboard');

// MOBIL
Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
Route::get('/mobil/create', [MobilController::class, 'create'])->name('mobil.create');
Route::post('/mobil', [MobilController::class, 'store'])->name('mobil.store');
Route::get('/mobil/{id}/edit', [MobilController::class, 'edit'])->name('mobil.edit');
Route::put('/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');
Route::delete('/mobil/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');

// RENTAL
Route::get('/rental/create/{mobil_id}', [RentalController::class, 'create'])->name('rental.create');
Route::post('/rental/store', [RentalController::class, 'store'])->name('rental.store');
Route::match(['get', 'post'], '/rental', [RentalController::class, 'index'])->name('rental.index');
Route::post('/rental/{id}/return', [RentalController::class, 'return'])->name('rental.return');

// CUSTOMER
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

// ✅ TRANSAKSI (FIX PRINT)
Route::resource('transaksi', TransaksiController::class);

// 🔥 PRINT STRUK (INI YANG DIPAKAI)
Route::get('/transaksi/print/{id}', [TransaksiController::class, 'print'])->name('transaksi.print');

// TANDAI LUNAS
Route::patch('/transaksi/{id}/lunas', [TransaksiController::class, 'tandaiLunas'])->name('transaksi.lunas');

// MANAGEMENT USER
Route::get('/charts', function () {
    return view('charts');
})->name('charts');

Route::get('/tables', [UserController::class, 'index'])->name('tables');
Route::post('/tables', [UserController::class, 'store'])->name('user.store');
Route::delete('/tables/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// GENERATOR
Route::get('/generate-mobil', function () {
    $daftar_gambar = ['agya', 'avanza', 'ayla', 'brio', 'fortuner', 'hr-v', 'jazz', 'pajerosport', 'yariz'];

    foreach ($daftar_gambar as $nama) {
        Mobil::updateOrCreate(
            ['gambar' => $nama . '.png'],
            [
                'nama_mobil' => strtoupper($nama),
                'harga_per_hari' => rand(350, 750) * 1000,
                'status' => 'tersedia',
                'no_polisi' => 'BG ' . rand(1000, 9999) . ' OK',
            ]
        );
    }

    return "Berhasil! Cek di /mobil";
});
