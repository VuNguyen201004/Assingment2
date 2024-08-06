@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Invoice</h2>
    <div class="row">
        <!-- Customer Information -->
        <div class="col-md-6">
            <h4>Customer Information</h4>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
        </div>

        <!-- Order Details -->
        <div class="col-md-6">
            <h4>Order Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="" style="width: 100px; height: 100px;">
                                
                                </td>
                            <td>{{ number_format($item->price) }}VND</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity) }}VND</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                        <td>{{ number_format($order->total_price) }}VND</td>
                    </tr>
                </tfoot>
            </table>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
        </div>
    </div>
    <div class="mt-4">
        <button class="btn btn-primary d-inline-block" onclick="window.print()">Print Invoice</button>
        <a href="{{ route('home') }}" class="btn btn-secondary d-inline-block ml-2">Go Back</a>
    </div>
</div>
@endsection
