<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;

/*
|--------------------------------------------------------------------------
| ROUTE LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| ROUTE YANG HARUS LOGIN
|--------------------------------------------------------------------------
*/
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    Route::get('/mobil', [MobilController::class, 'index']);
    Route::get('/mobil/create', [MobilController::class, 'create']);
    Route::post('/mobil', [MobilController::class, 'store']);
    Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);
    Route::put('/mobil/{id}', [MobilController::class, 'update']);
    Route::get('/mobil/{id}/edit', [MobilController::class, 'edit']);

    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer/store', [CustomerController::class, 'store']);

    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    // Mobil
    Route::get('/mobil', [MobilController::class, 'index']);
    Route::get('/mobil/create', [MobilController::class, 'create']);
    Route::post('/mobil', [MobilController::class, 'store']);
    Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);
    Route::put('/mobil/{id}', [MobilController::class, 'update']);
    Route::get('/mobil/{id}/edit', [MobilController::class, 'edit']);

    // Customer
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer/store', [CustomerController::class, 'store']);
