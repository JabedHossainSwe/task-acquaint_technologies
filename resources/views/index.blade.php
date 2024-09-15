@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Carousel/Banner -->
        
        <div class="banner">
          <img src="{{ asset('assets/images/banner.png') }}" alt="Shop Now" class="img-fluid" style="height: 300px; width:100%">
      </div>
      

        <!-- Featured Products -->
        <div class="featured-products my-5">
            <h2>Featured Products</h2>
            <div class="row">
                @forelse ($featuredProducts as $product)
                    <div class="col-md-4">
                        <div class="product-item card mb-4">
                            <div class="card-body">
                                <h3 class="card-title">{{ $product->name }}</h3>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Price: {{ $product->price }}</p>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Product</a>

                            </div>
                        </div>
                    </div>
                @empty
                    <p>No featured products available.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
