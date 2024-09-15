@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Customer Report</h2>
        <form action="{{ route('admin.reports.customer') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Generate Report</button>
        </form>
        @if (isset($customers))
            <h3>Report Results</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Total Orders</th>
                        <th>Total Amount Spent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->total_orders }}</td>
                            <td>${{ number_format($customer->total_amount_spent, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
