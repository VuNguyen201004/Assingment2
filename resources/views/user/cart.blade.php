@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Your Cart</h2>
    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr data-item-id="{{ $item->id }}">
                        <td>{{ $item->product->name }}</td>
                        <td>
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="" style="width: 100px; height: 100px;">
                       
                    </td>
                        <td>
                            <div class="input-group">
                                <button type="button" class="btn btn-secondary btn-sm decrease-quantity">-</button>
                                <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" class="form-control text-center quantity-input" min="1">
                                <button type="button" class="btn btn-secondary btn-sm increase-quantity">+</button>
                            </div>
                        </td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td class="total-price">{{ number_format($item->product->price * $item->quantity) }}VND</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                            <form action="{{ route('cart.index') }}" method="GET" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirmCartUpdate()">Update</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                    <td id="cart-total">{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity)) }}VND</td>
                </tr>
            </tfoot>
        </table>
        <a href="{{ route('checkout.confirm') }}" class="btn btn-success">Proceed to Checkout</a>
    @endif
</div>
@endsection