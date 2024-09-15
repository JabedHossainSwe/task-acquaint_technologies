@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Order #{{ $order->id }}</h2>
        <div class="mb-4">
            <h4>User Details</h4>
            @if ($order->user)
                <p>Name: {{ $order->user->name }}</p>
                <p>Email: {{ $order->user->email }}</p>
            @else
                <p>User details not available.</p>
            @endif
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
    </div>
@endsection
