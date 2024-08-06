@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Order Details #{{ $order->id }}</span></h1>
    
    <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
        <h3 class="uk-card-title">Order Information</h3>
        
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
        <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
        <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total Price:</strong> {{ number_format($order->total_price, 2) }} VND</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('d-m-Y H:i:s') }}</p>
    </div>
    
    <h3 class="uk-heading-line"><span>Order Items</span></h3>
    
    <table class="uk-table uk-table-divider uk-table-hover">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->category->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} VND</td>
                    <td>
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100px; height: auto;">
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('orders.index') }}" class="uk-button uk-button-default">Back to Orders</a>
</div>
@endsection
