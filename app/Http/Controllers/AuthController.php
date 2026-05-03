<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('login')) {
            if (session('role') === 'admin') return redirect('/dashboard');
            return redirect('/mobil');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Cari user berdasarkan name (username) atau email
        $user = User::where('name', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        // Cek password
        if ($user && Hash::check($request->password, $user->password)) {
            $sessionData = [
                'login'    => true,
                'role'     => $user->role,
                'username' => $user->name,
                'nama'     => $user->name,
            ];

            // Kalau role user, cari customer yang terkait
            if ($user->role === 'user') {
                $customer = Customer::where('nama', $user->name)->first();
                if ($customer) {
                    $sessionData['customer_id'] = $customer->id_customer;
                }
            }

            session($sessionData);

            if ($user->role === 'admin') return redirect('/dashboard');
            return redirect('/mobil');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}