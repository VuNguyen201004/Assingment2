@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Order Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Order #{{ $order->id }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h6><strong>Customer Name:</strong></h6>
                <p>{{ $order->user->name ?? 'N/A' }}</p>
            </div>
            <div class="mb-3">
                <h6><strong>Phone Number:</strong></h6>
                <p>{{ $order->phone_number }}</p>
            </div>
            <div class="mb-3">
                <h6><strong>Shipping Address:</strong></h6>
                <p>{{ $order->shipping_address }}</p>
            </div>
            <div class="mb-3">
                <h6><strong>Payment Method:</strong></h6>
                <p>{{ $order->payment_method }}</p>
            </div>
            <div class="mb-3">
                <h6><strong>Status:</strong></h6>
                <span class="badge {{ $order->status === 'pending' ? 'badge-warning' : 'badge-secondary' }}">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="mb-3">
                <h6><strong>Total Price:</strong></h6>
                <p>{{ number_format($order->total_price, 2) }} VND</p>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Order Items</h4>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->category->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="max-width: 100px; max-height: 75px;">
                    </td>
                    <td>{{ number_format($item->price, 2) }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($order->status === 'pending')
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-lg">Edit Order</a>
    @endif
</div>
@endsection
