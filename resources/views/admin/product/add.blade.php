@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Add New Product</span></h1>

    <form class="uk-form-stacked" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="uk-margin">
            <label class="uk-form-label" for="product-name">Product Name</label>
            <div class="uk-form-controls">
                <input class="uk-input @error('name') uk-form-danger @enderror" id="product-name" name="name" type="text" placeholder="Enter product name" value="{{ old('name') }}">
                @error('name')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="category">Category</label>
            <div class="uk-form-controls">
                <select class="uk-select @error('category_id') uk-form-danger @enderror" id="category" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="price">Price</label>
            <div class="uk-form-controls">
                <input class="uk-input @error('price') uk-form-danger @enderror" id="price" name="price" type="number" step="0.01" placeholder="Enter price" value="{{ old('price') }}">
                @error('price')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="stock">Stock</label>
            <div class="uk-form-controls">
                <input class="uk-input @error('luot_xem') uk-form-danger @enderror" id="stock" name="luot_xem" type="number" placeholder="Enter stock quantity" value="{{ old('luot_xem') }}">
                @error('luot_xem')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="image">Product Image</label>
            <div class="uk-form-controls">
                <input class="uk-input @error('image') uk-form-danger @enderror" id="image" name="image" type="file">
                @error('image')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="content">Description</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea @error('content') uk-form-danger @enderror" id="content" name="content" rows="5" placeholder="Enter product description">{{ old('content') }}</textarea>
                @error('content')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="status">Status</label>
            <div class="uk-form-controls">
                <select class="uk-select @error('status') uk-form-danger @enderror" id="status" name="status">
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="uk-margin">
            <button class="uk-button uk-button-primary" type="submit">Save</button>
            <a class="uk-button uk-button-default" href="{{ route('products.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection
