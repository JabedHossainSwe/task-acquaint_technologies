@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Shopping Cart</h2>
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $productId => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <input type="number" name="quantities[{{ $productId }}]" value="{{ $item['quantity'] }}"
                                    min="1">
                            </td>
                            <td>${{ $item['price'] }}</td>
                            <td>${{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Cart</button>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Checkout</a>
        </form>
    </div>
@endsection
