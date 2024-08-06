@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Product Details</span></h1>

    <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title">{{ $product->name }}</h3>
        <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
        <p>
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" style="width: 200px; height: 200px;">
        </p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Stock:</strong> {{ $product->luot_xem }}</p>
    </div>

    <div class="uk-margin-top">
        <a class="uk-button uk-button-primary" href="{{ route('products.edit', $product) }}">Edit Product</a>
        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="uk-button uk-button-danger">Delete Product</button>
        </form>
        <a class="uk-button uk-button-default" href="{{ route('products.index') }}">Back to List</a>
    </div>
</div>
@endsection


