<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Tìm hoặc tạo giỏ hàng cho người dùng hiện tại
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Tìm hoặc tạo sản phẩm trong giỏ hàng
        $cartItem = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $productId],
            ['quantity' => $quantity]
        );

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }
    public function index()
    {
        $userId = auth()->id();
        $cart = Cart::where('user_id', $userId)->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect();

        return view('user.cart', compact('cartItems'));
    }


      // CartController.php

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::find($id);
        if ($item) {
            $item->quantity = $request->quantity;
            $item->save();

            // Tính toán tổng cho mục này và tổng giỏ hàng
            $total = $item->product->price * $item->quantity;
            $cartTotal = CartItem::sum(fn($item) => $item->product->price * $item->quantity);

            return response()->json([
                'success' => true,
                'total' => number_format($total, 2),
                'cartTotal' => number_format($cartTotal, 2),
            ]);
        }

        return response()->json(['success' => false], 400);
    }



    public function remove($id)
    {
        $item = CartItem::find($id);
        if ($item) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

}
