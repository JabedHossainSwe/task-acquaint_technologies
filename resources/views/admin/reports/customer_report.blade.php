@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h2>Customer Report</h2>
        </div>

        <form method="GET" action="{{ route('report.customers') }}">
            <div class="form-group">
                <label for="order_id">Order</label>
                <select name="order_id" id="order_id" class="form-control">
                    <option value="">All Orders</option>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}" {{ request('order_id') == $order->id ? 'selected' : '' }}>
                            {{ $order->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="mt-3">
                    <label for="product_id">Product</label>
                </div>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="">All Products</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>


        @if ($customers->isNotEmpty())
            <div class="text-center">
                <h3 class="mt-4">Report Results</h3>
            </div>
            <div class="text-center mb-3">
                <a href="{{ route('report.customers.download') }}" class="btn btn-primary">Download PDF</a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Payment Method</th>
                        <th>Orders Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->payment_method }}</td>
                            <td>{{ $customer->orders_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No customers found for the selected criteria.</p>
        @endif

    </div>
@endsection
