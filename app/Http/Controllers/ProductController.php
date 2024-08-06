<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::with('category')->get(); // Eager load the category relationship
        return view('admin.product.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    // Xử lý lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'luot_xem' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string', // Thêm validation cho trường content
            'status' => 'required|integer|in:0,1', // Thêm validation cho trường status
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images', 'public');
        }
    
        Product::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'luot_xem' => $request->input('luot_xem'),
            'image' => $imagePath,
            'content' => $request->input('content'), // Lưu content
            'status' => $request->input('status'), // Lưu status
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
    
    // Hiển thị chi tiết sản phẩm
    public function show(Product $product)
    {
        return view('admin.product.view', compact('product'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }
    

    // Xử lý cập nhật sản phẩm
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'image' => 'nullable|image|max:10000', // Adjust validation rules for image as needed
        'price' => 'required|numeric',
        'content' => 'required|string',
        'status' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'luot_xem' => 'required|integer'
    ]);

    // Check if the image is present in the request
    if ($request->hasFile('image')) {
        // Delete the old image from storage if it exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->store('uploads/images', 'public');
    } else {
        // If no new image, keep the old image path
        $imagePath = $product->image;
    }

    // Update the product with the request data
    $product->update([
        'name' => $request->input('name'),
        'image' => $imagePath,
        'price' => $request->input('price'),
        'content' => $request->input('content'),
        'status' => $request->input('status'),
        'category_id' => $request->input('category_id'),
        'luot_xem' => $request->input('luot_xem')
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    // Xử lý xóa sản phẩm
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}

