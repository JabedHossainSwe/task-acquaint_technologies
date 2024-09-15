<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class AdminOrderController extends Controller
{
    public function index()
    {
        // $orders = Order::with('orderItems.product')->get();
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');
        return view('admin.orders.show', compact('order'));
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
    public function generateInvoice(Order $order)
    {
        $order->load('orderItems.product');
        $pdf = PDF::loadView('admin.invoices.invoice', compact('order'));
        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
}
