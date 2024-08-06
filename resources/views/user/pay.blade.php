@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Order Confirmation</h2>
    <form action="{{ route('checkout.placeOrder') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6">
                <h3>Customer Information</h3>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address:</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
            </div>

            <!-- Order Details -->
            <div class="col-md-6">
                <h3>Order Details</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="" style="width: 100px; height: 100px;">
                                
                                </td>
                                <td>${{ number_format($item->product->price, 2) }}VND</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                            <td>{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}VND</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select id="payment_method" name="payment_method" class="form-control" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">OCD</option>
                        <option value="paypal">PayPal</option>
                        <!-- Thêm các phương thức thanh toán khác nếu cần -->
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" onclick="return confirmOrder()">Confirm Order</button>
    </form>
</div>
@endsection
 