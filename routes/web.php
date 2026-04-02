<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/mobil', [MobilController::class, 'index']);
Route::get('/mobil/create', [MobilController::class, 'create']);
Route::post('/mobil', [MobilController::class, 'store']);
Route::delete ('/mobil/{id}', [MobilController::class, 'destroy']);
// untuk update
Route::put('/mobil/{id}', [MobilController::class, 'update']);
//untuk form edit
Route::get('/mobil/{id}/edit', [MobilController::class, 'edit']);

// Route untuk menampilkan form tambah
Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/customer/create', [CustomerController::class, 'create']);
// Route untuk memproses penyimpanan data
Route::post('/customer/store', [CustomerController::class, 'store']);
Route::get('/mobil/{id}/edit', [MobilController::class, 'edit']);
