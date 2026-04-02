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
        Customer::create($request->all());
        return redirect('/customer');
    }
}