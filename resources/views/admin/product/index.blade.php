@extends('layout.add')

@section('content')
<div class="uk-container uk-container-large uk-margin-top">
    <h2 class="uk-heading-line"><span>Products</span></h2>
    <a href="{{ route('products.create') }}" class="uk-button uk-button-primary uk-margin-bottom">Add Product</a>

    @if(session('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <table class="uk-table uk-table-divider">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
                <th>Trạng Thái</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                        @endif
                    </td>
                    <td>
                        @if ($product->status == 1)
                        <button class="btn-active">Kích hoạt</button>
                        <!-- Màu xanh cho trạng thái kích hoạt -->
                        @else
                        <button class="btn-inactive">Không kích hoạt</button> <!-- Màu đỏ cho trạng thái không kích hoạt -->
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="uk-button uk-button-small uk-button-default">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="uk-button uk-button-small uk-button-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="uk-button uk-button-small uk-button-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection





