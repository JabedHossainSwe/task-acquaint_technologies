<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.show');
    }

    public function show()
    {
        $cart = session()->get('cart', []);
        return view('cart.show', compact('cart'));
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('quantities') as $productId => $quantity) {
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.show');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('cart.checkout', compact('cart'));
    }
}
