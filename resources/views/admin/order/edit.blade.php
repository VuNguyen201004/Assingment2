@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Edit Order #{{ $order->id }}</span></h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ID đơn hàng (hiển thị, không cho chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="order_id">Order ID</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="order_id" type="text" value="{{ $order->id }}" readonly>
            </div>
        </div>

        <!-- Tên khách hàng (hiển thị, không cho chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="customer_name">Customer Name</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="customer_name" type="text" value="{{ $order->user->name ?? 'N/A' }}" readonly>
            </div>
        </div>

        <!-- Số điện thoại (cho phép chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="phone_number">Phone Number</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="phone_number" name="phone_number" type="text" value="{{ $order->phone_number }}">
            </div>
        </div>

        <!-- Địa chỉ giao hàng (cho phép chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="shipping_address">Shipping Address</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="shipping_address" name="shipping_address" type="text" value="{{ $order->shipping_address }}">
            </div>
        </div>

        <!-- Trạng thái đơn hàng (cho phép chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="status">Status</label>
            <div class="uk-form-controls">
                <select id="status" name="status" class="uk-select" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Phương thức thanh toán (cho phép chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="payment_method">Payment Method</label>
            <div class="uk-form-controls">
                <select id="payment_method" name="payment_method" class="uk-select">
                    <option value="">Select Payment Method</option>
                    <option value="credit_card" {{ $order->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                    <option value="paypal" {{ $order->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                    <option value="bank_transfer" {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
            </div>
        </div>

        <!-- Tổng giá (hiển thị, không cho chỉnh sửa) -->
        <div class="uk-margin">
            <label class="uk-form-label" for="total_price">Total Price</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="total_price" type="text" value="{{ number_format($order->total_price, 2) }} VND" readonly>
            </div>
        </div>

        <!-- Hành động -->
        <button type="submit" class="uk-button uk-button-primary">Update Order</button>
    </form>
</div>
@endsection
