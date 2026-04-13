<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('tables', compact('users'));
    }

    public function store(Request $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);
        return redirect('/tables')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/tables')->with('success', 'Pengguna berhasil dihapus!');
    }
}