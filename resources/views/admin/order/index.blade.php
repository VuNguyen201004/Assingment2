@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Orders</span></h1>

    <a href="{{ route('orders.create') }}" class="uk-button uk-button-primary uk-margin-bottom">Add New Order</a>

    <table class="uk-table uk-table-divider uk-table-hover uk-table-responsive">
        <thead>
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
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="max-width: 100px; max-height: 75px; object-fit: cover;">
                        </td>
                        <td>{{ $order->status }}</td>
                        <td>{{ number_format($order->total_price, 2) }} VND</td>
                    
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="uk-button uk-button-default">View</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="uk-button uk-button-warning">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="uk-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="uk-button uk-button-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
