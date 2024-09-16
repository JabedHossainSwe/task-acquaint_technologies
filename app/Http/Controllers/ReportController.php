<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use PDF;
use DB;

class ReportController extends Controller
{
    public function orderReport()
    {
        $orders = Order::with('products')->get();
        return view('admin.reports.order_report', compact('orders'));
    }

    public function downloadOrderReport()
    {
        $orders = Order::with('products')->get();

        $pdf = Pdf::loadView('admin.reports.order_report_pdf', compact('orders'));

        return $pdf->download('order_report.pdf');
    }
    public function customerReport()
    {
        $users = User::with('orders.products')->get();

        $orders = Order::all(); 

        $customers = Order::select('name', 'phone', 'payment_method', \DB::raw('COUNT(*) as orders_count'))
            ->groupBy('name', 'phone', 'payment_method')
            ->get();

        $products = Product::all();

        return view('admin.reports.customer_report', compact('users', 'orders', 'products', 'customers'));
    }

    public function downloadCustomerReport()
    {
        $customers = DB::table('orders')
            ->select('name', 'phone', 'payment_method', DB::raw('COUNT(*) as orders_count'))
            ->groupBy('name', 'phone', 'payment_method')
            ->get();

        $pdf = PDF::loadView('admin.reports.customer_report_pdf', compact('customers'));

        return $pdf->download('customer_report.pdf');
    }
}
