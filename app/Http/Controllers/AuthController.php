<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // DATA SEMENTARA (biar tidak error)
        $totalMobil = 0;
        $mobilTersedia = 0;
        $mobilDisewa = 0;

        return view('dashboard', compact('totalMobil','mobilTersedia','mobilDisewa'));
    }

    // logout
    public function logout(){
        session()->flush();
        return redirect('/login');
    }
}