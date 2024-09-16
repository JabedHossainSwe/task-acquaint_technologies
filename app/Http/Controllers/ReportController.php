<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use PDF;

class ReportController extends Controller
{
    // Order report view
    public function orderReport()
    {
        // Fetch all orders with their related products
        $orders = Order::with('products')->get();

        // Return the view for displaying the order report
        return view('admin.reports.order_report', compact('orders'));
    }

    // Download Order report as PDF
    public function downloadOrderReport()
    {
        // Fetch all orders with their related products
        $orders = Order::with('products')->get();

        // Generate the PDF view for order report
        $pdf = PDF::loadView('admin.reports.order_report_pdf', compact('orders'));

        // Download the generated PDF file
        return $pdf->download('order_report.pdf');
    }

    // Customer report view
    public function customerReport()
    {
        // Fetch all users with their related orders and products
        $users = User::with('orders.products')->get();

        // Fetch all orders for the order filter dropdown
        $orders = Order::all(); // Fetch all orders to display in the dropdown

        $customers = Order::select('name', 'phone', 'payment_method', \DB::raw('COUNT(*) as orders_count'))
            ->groupBy('name', 'phone', 'payment_method')
            ->get();

        $products = Product::all();

        // Return the view with users, orders, and products
        return view('admin.reports.customer_report', compact('users', 'orders', 'products', 'customers'));
    }

    // Download Customer report as PDF
    public function downloadCustomerReport()
    {
        // Fetch all users with their related orders and products
        $users = User::with('orders.products')->get();

        // Generate the PDF view for customer report
        $pdf = PDF::loadView('admin.reports.customer_report_pdf', compact('users'));

        // Download the generated PDF file
        return $pdf->download('customer_report.pdf');
    }
}
