@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <h3>Monthly Total Orders</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="col-md-4">
                <h3>Monthly Total Sales</h3>
                <p>${{ number_format($totalSales, 2) }}</p>
            </div>
            <div class="col-md-4">
                <h3>Top 5 Sales Products</h3>
                <ul>
                    @foreach ($topProducts as $product)
                        <li>{{ $product->name }}: {{ $product->total_sales }} units</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
