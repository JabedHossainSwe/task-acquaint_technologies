<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function orderReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        return view('admin.reports.order', compact('orders'));
    }
    public function customerReport(Request $request)
    {
        $productId = $request->input('product_id');
        $orders = Order::whereHas('orderItems', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->get();
        return view('admin.reports.customer', compact('orders'));
    }
}
