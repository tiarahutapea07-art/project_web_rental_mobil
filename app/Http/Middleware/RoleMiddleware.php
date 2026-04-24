<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Belum login
        if (!session('login')) {
            return redirect('/login');
        }

        // Cek role
        if (session('role') !== $role) {
            // Kalau user coba akses halaman admin → redirect ke katalog mobil
            if (session('role') === 'user') {
                return redirect('/mobil')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
            return redirect('/login');
        }

        return $next($request);
    }
}