@extends('layout.admin')

@section('content')

<!-- Banner -->
<div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('storage/uploads/images/banner1.jpg') }}" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>
                    @auth
                        Welcome to Computer: {{ $user->name }}!
                    @else
                        Welcome to Computer!
                    @endauth
                </h5>
                <p>Find the best products at unbeatable prices.</p>
                <a class="btn btn-primary btn-lg" href="{{ route('product.search') }}" role="button">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('storage/uploads/images/banner3.jpg') }}" class="d-block w-100" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Wide Range of Products</h5>
                <p>Explore our wide range of products and enjoy great discounts.</p>
                <a class="btn btn-primary btn-lg" href="{{ route('product.search') }}" role="button">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('storage/uploads/images/banner2.jpg') }}" class="d-block w-100" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Great Discounts</h5>
                <p>Enjoy unbeatable prices on our best products.</p>
                <a class="btn btn-primary btn-lg" href="{{ route('product.search') }}" role="button">Shop Now</a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

{{-- <!-- Categories -->
<div class="container mt-4">
    <h2>Categories</h2>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-3 mb-4">
                <div class="card category-card h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $category->name }}</h5>
                        </div>
                        <div>
                            <a href="{{ route('category.show', ['id' => $category->id]) }}" class="btn btn-primary btn-block" data-toggle="tooltip" data-placement="top" title="View products in this category">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

<!-- Featured Products -->
<div class="container mt-4">
    <h2>Featured Products</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fixed" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price, 2) }} VND</p>
                        </div>
                        <div>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-block">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Trending Products -->
<div class="container mt-4">
    <h2>Trending Products</h2>
    <div class="row">
        @foreach($trendingProducts as $product)
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fixed" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price) }} VND</p>
                            <p>Category: {{ $product->category_name }}</p>
                        </div>
                        <div>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#productModal{{ $product->id }}">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Modal -->
            <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                            <p class="mt-3">{{ number_format($product->price) }} VND</p>
                            <p>Category: {{ $product->category_name }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<style>
   
</style>
