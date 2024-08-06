@extends('layout.admin')

@section('content')
<div class="card mt-4">
    <h4 class="card-header">Sửa Sản Phẩm</h4>
    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ old('image', $product->image) }}">
               
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01">
            </div>

            <div class="mb-3">
                <label for="luot_xem" class="form-label">Lượt Xem</label>
                <input type="number" class="form-control" id="luot_xem" name="luot_xem" value="{{ old('luot_xem', $product->luot_xem) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="content" name="content" rows="3">{{ old('content', $product->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng Thái</label>
                <select class="form-select" id="status" name="status">
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Không kích hoạt</option>
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Sửa Sản Phẩm</button>
        </form>
    </div>
</div>
@endsection
