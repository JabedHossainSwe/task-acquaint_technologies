@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{-- <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid"> --}}
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p>Price: ${{ $product->price }}</p>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1"
                            min="1">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
