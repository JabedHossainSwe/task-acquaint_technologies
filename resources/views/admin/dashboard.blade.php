@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        <div class="row">
            <!-- Monthly Total Orders -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Monthly Total Orders</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalOrders }}</h5>
                    </div>
                </div>
            </div>

            <!-- Monthly Total Sales -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Monthly Total Sales</div>
                    <div class="card-body">
                        <h5 class="card-title">${{ number_format($totalSales, 2) }}</h5>
                    </div>
                </div>
            </div>

            <!-- Top 5 Sales Products -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Top 5 Sales Products</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($topProducts as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $product->name }}
                                    <span class="badge bg-secondary rounded-pill">{{ $product->orders_count }} units</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Management Links -->
        <div class="row mt-4">
            <!-- Product Category Management -->
            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Product Category</div>
                    <div class="card-body">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light w-100">Manage Categories</a>
                    </div>
                </div>
            </div>

            <!-- Product Management -->
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">Product Management</div>
                    <div class="card-body">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light w-100">Manage Products</a>
                    </div>
                </div>
            </div>

            <!-- Order Management -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Order Management</div>
                    <div class="card-body">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-light w-100">Manage Orders</a>
                    </div>
                </div>
            </div>

            <!-- Customer Management -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Customer Management</div>
                    <div class="card-body">
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-light w-100">Manage Customers</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Invoicing System (PDF) -->
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Invoicing System</div>
                    <div class="card-body">
                        <a href="{{ route('orders.invoice', ['order' => 1]) }}" class="btn btn-light w-100">Generate Invoice
                            (PDF)</a>
                    </div>
                </div>
            </div>

            <!-- Order Report -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Order Report</div>
                    <div class="card-body">
                        <a href="{{ route('report.orders') }}" class="btn btn-light w-100">Generate Order Report</a>
                    </div>
                </div>
            </div>

            <!-- Customer Report -->
            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Customer Report</div>
                    <div class="card-body">
                        <a href="{{ route('report.customers') }}" class="btn btn-light w-100">Generate Customer Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
