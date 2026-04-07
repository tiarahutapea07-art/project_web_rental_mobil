<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Models\Mobil;
use App\Http\Controllers\AuthController;

// --- AUTH ROUTES ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- 1. DASHBOARD ---
Route::get('/', function () {
    if(session('login')) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

Route::get('/dashboard', function () {
    if(!session('login')) {
        return redirect('/login');
    }
    $totalMobil = Mobil::count();
    $mobilTersedia = Mobil::where('status', 'tersedia')->count();
    $mobilDisewa = Mobil::where('status', 'tidak tersedia')->count();
    return view('dashboard', compact('totalMobil', 'mobilTersedia', 'mobilDisewa'));
})->name('dashboard');

// --- 2. HALAMAN STATIS TEMPLATE (PENTING) ---
// Rute bersih untuk charts dan tables (tanpa .html)
Route::get('/charts', function () { return view('charts'); })->name('charts');
Route::get('/tables', function () { return view('tables'); })->name('tables');

// --- 3. MANAJEMEN MOBIL ---
Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
Route::get('/mobil/create', [MobilController::class, 'create'])->name('mobil.create');
Route::post('/mobil', [MobilController::class, 'store'])->name('mobil.store');
Route::get('/mobil/{id}/edit', [MobilController::class, 'edit'])->name('mobil.edit');
Route::put('/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');
Route::delete('/mobil/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');

// --- 4. CUSTOMER ---
Route::get('/customer', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::post('/customer', [\App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{id}/edit', [\App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{id}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');

// --- 5. RENTAL ---
Route::get('/rental', [\App\Http\Controllers\RentalController::class, 'index'])->name('rental.index');
Route::get('/rental/create/{mobil_id}', [\App\Http\Controllers\RentalController::class, 'create'])->name('rental.create');
Route::post('/rental', [\App\Http\Controllers\RentalController::class, 'store'])->name('rental.store');
Route::post('/rental/{id}/return', [\App\Http\Controllers\RentalController::class, 'return'])->name('rental.return');

// --- 6. GENERATOR ---
Route::get('/generate-mobil', function () {
    $daftar_gambar = ['agya', 'avanza', 'ayla', 'brio', 'fortuner', 'hr-v', 'jazz', 'pajerosport', 'yariz'];
    foreach ($daftar_gambar as $nama) {
        Mobil::updateOrCreate(['gambar' => $nama . '.png'], [
            'nama_mobil' => strtoupper($nama),
            'harga_per_hari' => rand(350, 750) * 1000,
            'status' => 'tersedia',
            'no_polisi' => 'BG ' . rand(1000, 9999) . ' OK',
        ]);
    }
    return "Berhasil! Cek di /mobil";
});