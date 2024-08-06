@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="display-4 text-center mb-4">Edit Order</h1>

    <form action="{{ route('history.update', $order->id) }}" method="POST">
        @csrf
        @method('POST') <!-- Ensure this matches the method used in the route -->

        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <input type="text" id="shipping_address" name="shipping_address" class="form-control" value="{{ old('shipping_address', $order->shipping_address) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', $order->phone_number) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>

    <a href="{{ route('history.index') }}" class="btn btn-secondary mt-3">Back to History</a>
</div>
@endsection
