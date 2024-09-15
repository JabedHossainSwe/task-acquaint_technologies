<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $user)
    {
        $orders = $user->orders;
        return view('admin.customers.show', compact('user', 'orders'));
    }
}
