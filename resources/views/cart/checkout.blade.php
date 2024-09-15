@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Checkout</h2>
        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            
            <!-- Customer Information -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            
            <!-- Cash on Delivery Option -->
            <div class="form-check mb-3">
                <input type="checkbox" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" class="form-check-input">
                <label for="cash_on_delivery" class="form-check-label">Cash on Delivery</label>
            </div>
            
            <!-- Place Order Button -->
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
@endsection
