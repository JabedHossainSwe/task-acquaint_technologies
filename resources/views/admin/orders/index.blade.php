@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.orders.invoice', $order) }}" class="btn btn-primary btn-sm">Generate
                                Invoice</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
