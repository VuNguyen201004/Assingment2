<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục mới
    public function create()
    {
        return view('admin.category.add');
    }

    // Xử lý lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|integer'
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Hiển thị chi tiết danh mục
    public function show(Category $category)
    {
        return view('admin.category.detail', compact('category'));
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    // Xử lý cập nhật danh mục
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|integer'
        ]);

        $category->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Xử lý xóa danh mục
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
