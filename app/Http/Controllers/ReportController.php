<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // public function orderReport(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //         'product_id' => 'nullable|exists:products,id',
    //     ]);

    //     // Retrieve data based on filters
    //     $orders = Order::whereBetween('created_at', [$request->start_date, $request->end_date]);

    //     if ($request->filled('product_id')) {
    //         $orders->whereHas('products', function ($query) use ($request) {
    //             $query->where('id', $request->product_id);
    //         });
    //     }

    //     $orders = $orders->with('orderItems.product', 'user')->get();

    //     $products = Product::all();

    //     return view('admin.reports.order_report', compact('orders', 'products'));
    // }

    public function orderReport(Request $request)
    {
        // Optionally, handle date range filtering or other parameters
        $orders = Order::all(); // Replace with your filtering logic

        // Return a view or generate a report
        return view('admin.reports.order_report', compact('orders'));
    }
    public function customerReport(Request $request)
    {
        // Validate the request
        $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'product_id' => 'nullable|exists:products,id',
        ]);

        // Retrieve data based on filters
        $customers = User::whereHas('orders', function ($query) use ($request) {
            if ($request->filled('order_id')) {
                $query->where('id', $request->order_id);
            }
            if ($request->filled('product_id')) {
                $query->whereHas('products', function ($query) use ($request) {
                    $query->where('id', $request->product_id);
                });
            }
        })->get();

        $orders = Order::all();
        $products = Product::all();

        return view('admin.reports.customer_report', compact('customers', 'orders', 'products'));
    }
}
