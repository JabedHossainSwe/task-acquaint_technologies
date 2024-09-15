<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->id === 1) {
            // Fetch data
            $totalOrders = Order::whereMonth('created_at', now()->month)->count();
            $totalSales = Order::whereMonth('created_at', now()->month)->sum('total');
            $topProducts = Product::withCount('orders')
                ->orderBy('orders_count', 'desc')
                ->take(5)
                ->get();

            // Return view with data
            return view('admin.dashboard', compact('totalOrders', 'totalSales', 'topProducts'));
        }

        return redirect('/');
    }
}
