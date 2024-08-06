<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::with('items.product')->get(); // Eager load order items and products
        return view('admin.order.index', compact('orders'));
    }

    // Hiển thị form tạo đơn hàng mới
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.order.add', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            'shipping_address' => 'required|string',
            'phone_number' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric'
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->input('user_id'),
            'status' => $request->input('status'),
            'total_price' => $request->input('total_price'),
            'shipping_address' => $request->input('shipping_address'),
            'phone_number' => $request->input('phone_number'),
            'payment_method' => $request->input('payment_method')
        ]);

        // Add items to the order
        foreach ($request->input('items') as $item) {
            $order->items()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Order added successfully.');
    }
    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        // Eager load các mối quan hệ cần thiết
        $order->load('items.product.category');
        return view('admin.order.detail', compact('order'));
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
            'shipping_address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'payment_method' => 'nullable|string',
        ]);

        // Cập nhật thông tin đơn hàng
        $order->update($request->only(['status', 'shipping_address', 'phone_number', 'payment_method']));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }
    // Xử lý xóa đơn hàng
    public function destroy(Order $order)
    {
        $order->items()->delete(); // Xóa các mặt hàng trong đơn hàng
        $order->delete(); // Xóa đơn hàng
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
