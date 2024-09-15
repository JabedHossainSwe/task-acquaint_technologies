<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;

        $totalOrders = Order::whereMonth('created_at', $currentMonth)->count();
        $totalSales = Order::whereMonth('created_at', $currentMonth)->sum('total_amount');
        $topProducts = Order::whereMonth('created_at', $currentMonth)
            ->with('orderItems.product')
            ->get()
            ->flatMap(function ($order) {
                return $order->orderItems;
            })
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'product' => $items->first()->product,
                    'total_quantity' => $items->sum('quantity')
                ];
            })
            ->sortByDesc('total_quantity')
            ->take(5);

        return view('admin.dashboard', compact('totalOrders', 'totalSales', 'topProducts'));
    }
}
