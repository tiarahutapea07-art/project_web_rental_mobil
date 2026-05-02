<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create() {
        return view('customer.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'nik'     => 'required|string|max:16|unique:customers,nik',
            'no_telp' => 'required|string|max:15',
            'alamat'  => 'required|string|max:500',
        ]);

        Customer::create($validated);
        return redirect('/customer')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit($id) {
        $customer = Customer::where('id_customer', $id)->firstOrFail();
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id) {
        $customer = Customer::where('id_customer', $id)->firstOrFail();

        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'nik'     => 'required|string|max:16|unique:customers,nik,' . $id . ',id_customer',
            'no_telp' => 'required|string|max:15',
            'alamat'  => 'required|string|max:500',
        ]);

        $customer->update($validated);
        return redirect('/customer')->with('success', 'Data customer berhasil diperbarui!');
    }

    public function destroy($id) {
        $customer = Customer::where('id_customer', $id)->firstOrFail();
        $customer->delete();
        return redirect('/customer')->with('success', 'Data customer berhasil dihapus!');
    }
}