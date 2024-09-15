<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function place(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // Create a new order
        $order = new Order();
        $order->user_id = Auth::id(); // Assumes user is logged in
        $order->name = $validatedData['name'];
        $order->phone = $validatedData['phone'];
        $order->payment_method = $validatedData['payment_method'];
        $order->total_amount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $order->save();

        // Save order items
        foreach ($cart as $productId => $item) {
            $order->orderItems()->create([
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('/')->with('success', 'Your order has been placed successfully.');
    }
}
