<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);
    
        // Lấy các bình luận liên quan đến sản phẩm
        $comments = Comment::where('product_id', $id)
                            ->where('status', 0) // Lọc bình luận đã phê duyệt
                            ->with('user') // Tải thông tin người dùng liên quan
                            ->get();
    
        // Trả về view với các biến cần thiết
        return view('user.detail', compact('product', 'comments'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'product_id' => 'required|exists:products,id',
        ]);

        Comment::create([
            'comment' => $request->input('content'),
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
            'status' => 0, // Default status
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được thêm.');
    }



}

