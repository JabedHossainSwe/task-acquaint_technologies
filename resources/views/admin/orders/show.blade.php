@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Order #{{ $order->id }}</h2>
        <div class="mb-4">
            <h4>User Details</h4>
            <p>Name: {{ $order->user->name }}</p>
            <p>Email: {{ $order->user->email }}</p>
        </div>
        <div class="mb-4">
            <h4>Order Details</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-4">
            <h4>Total Amount: ${{ number_format($order->total_amount, 2) }}</h4>
        </div>
    </div>
@endsection
