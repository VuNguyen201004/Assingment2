<?php

// CheckoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function confirm()
{
    $cartItems = CartItem::all(); // Hoặc lấy các sản phẩm trong giỏ hàng của người dùng hiện tại
    $user = auth()->user(); // Lấy thông tin người dùng hiện tại nếu đã đăng nhập

    return view('user.pay', [
        'cartItems' => $cartItems,
        'user' => $user
    ]);
}

public function placeOrder(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'address' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    // Tính tổng giá của các mục trong giỏ hàng
    $cartItems = CartItem::all();
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item->product->price * $item->quantity;
    }

    if ($totalPrice === null) {
        return redirect()->back()->with('error', 'Total price cannot be null.');
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'status' => 'pending',
        'total_price' => $totalPrice,
        'shipping_address' => $request->address,
        'phone_number' => $request->phone,
        'payment_method' => $request->payment_method
    ]);

    foreach ($cartItems as $item) {
        $order->orderItems()->create([
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price
        ]);
    }

    CartItem::truncate();

    return redirect()->route('order.invoice', ['id' => $order->id]);
}
public function invoice($id)
{
    $order = Order::with('orderItems.product', 'user')->findOrFail($id);

    return view('user.Checkout', compact('order'));
}

}

