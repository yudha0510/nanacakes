<?php

namespace App\Http\Controllers;

use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'user')->latest()->get();

        return view('admin.customer', compact('customers'));
    }
}