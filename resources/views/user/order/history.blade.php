@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Order History</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Payment Method</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>{{ $order->phone_number }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->category->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="max-width: 100px; max-height: 75px;">
                            </td>
                            <td class="status-column">
                                <span class="badge {{ $order->status === 'pending' ? 'badge-warning' : 'badge-secondary' }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ number_format($order->total_price, 2) }} VND</td>
                            <td>
                                <a href="{{ route('history.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if($order->status === 'pending')
                                    <a href="{{ route('history.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include a custom CSS file or inline styles -->
<style>
    .status-column .badge {
        color: black; /* Set text color to black */
    }
</style>
@endsection
