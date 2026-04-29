<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Transaksi;
use App\Models\Rental;
use Carbon\Carbon;

class AuthController extends Controller
{
    private $users = [
        [
            'username' => 'kelompok6',
            'password' => '12345',
            'role'     => 'admin',
            'nama'     => 'Kelompok 6',
        ],
        [
            'username' => 'user1',
            'password' => 'user123',
            'role'     => 'user',
            'nama'     => 'Customer 1',
        ],
        [
            'username' => 'user2',
            'password' => 'user123',
            'role'     => 'user',
            'nama'     => 'Customer 2',
        ],
    ];

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
        $found = null;
        foreach ($this->users as $user) {
            if ($user['username'] === $request->username && $user['password'] === $request->password) {
                $found = $user;
                break;
            }
        }

        if ($found) {
            $sessionData = [
                'login'    => true,
                'role'     => $found['role'],
                'username' => $found['username'],
                'nama'     => $found['nama'],
            ];

            if ($found['role'] === 'user') {
                $customer = Customer::where('nama', $found['nama'])->first();
                if ($customer) {
                    $sessionData['customer_id'] = $customer->id;
                }
            }

            session($sessionData);

            if ($found['role'] === 'admin') return redirect('/dashboard');
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