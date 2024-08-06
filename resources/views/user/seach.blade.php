@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Search for Products</h2>
    <form class="d-flex mb-4" action="{{ route('product.search') }}" method="GET">
        <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
        <select class="form-select me-2" name="category_id" aria-label="Category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="row">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fixed" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">${{ number_format($product->price, 2) }}</p>
                        <a href="#" class="btn btn-primary mt-auto">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
