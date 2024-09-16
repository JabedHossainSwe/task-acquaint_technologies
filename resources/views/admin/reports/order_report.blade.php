@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Order Report</h2>
        <div class="text-center mt-4 mb-4">
            <a href="{{ route('report.orders.download') }}" class="btn btn-success">Download PDF</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->products as $product)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>${{ number_format($product->pivot->price, 2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
