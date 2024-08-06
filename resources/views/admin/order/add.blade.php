@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Add New Order</span></h1>
    
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="uk-margin">
            <label class="uk-form-label" for="user_id">Customer</label>
            <div class="uk-form-controls">
                <select id="user_id" name="user_id" class="uk-select" required>
                    <option value="">Select Customer</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="status">Status</label>
            <div class="uk-form-controls">
                <select id="status" name="status" class="uk-select" required>
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="total_price">Total Price</label>
            <div class="uk-form-controls">
                <input id="total_price" name="total_price" class="uk-input" type="number" step="0.01" readonly>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="shipping_address">Shipping Address</label>
            <div class="uk-form-controls">
                <input id="shipping_address" name="shipping_address" class="uk-input" type="text" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="phone_number">Phone Number</label>
            <div class="uk-form-controls">
                <input id="phone_number" name="phone_number" class="uk-input" type="text" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="payment_method">Payment Method</label>
            <div class="uk-form-controls">
                <select id="payment_method" name="payment_method" class="uk-select" required>
                    <option value="">Select Payment Method</option>
                    <option value="cash">Cash</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <h4>Order Items</h4>
            <div id="order-items">
                <div class="order-item">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="product_id">Product</label>
                        <div class="uk-form-controls">
                            <select name="items[0][product_id]" class="uk-select product-select" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-category="{{ $product->category->name }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="category">Category</label>
                        <div class="uk-form-controls">
                            <input name="items[0][category]" class="uk-input" type="text" readonly>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="quantity">Quantity</label>
                        <div class="uk-form-controls">
                            <input name="items[0][quantity]" class="uk-input quantity-input" type="number" min="1" required>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="price">Price</label>
                        <div class="uk-form-controls">
                            <input name="items[0][price]" class="uk-input price-input" type="number" step="0.01" readonly>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="total_item_price">Total Item Price</label>
                        <div class="uk-form-controls">
                            <input name="items[0][total_item_price]" class="uk-input total-item-price" type="number" step="0.01" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-item" class="uk-button uk-button-primary">Add Item</button>
        </div>

        <button type="submit" class="uk-button uk-button-primary">Save Order</button>
    </form>
</div>
<!-- layoutAdmin\order\add.blade.php -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderItemsContainer = document.getElementById('order-items');
        let itemIndex = orderItemsContainer.children.length;

        function updateItemDetails(index) {
            const productSelect = document.querySelector(`.order-item:nth-child(${index + 1}) .product-select`);
            const categoryInput = document.querySelector(`.order-item:nth-child(${index + 1}) input[name='items[${index}][category]']`);
            const priceInput = document.querySelector(`.order-item:nth-child(${index + 1}) input[name='items[${index}][price]']`);
            const quantityInput = document.querySelector(`.order-item:nth-child(${index + 1}) .quantity-input`);
            const totalItemPriceInput = document.querySelector(`.order-item:nth-child(${index + 1}) .total-item-price`);

            productSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                categoryInput.value = selectedOption.dataset.category;
                priceInput.value = selectedOption.dataset.price;
                totalItemPriceInput.value = quantityInput.value * priceInput.value;
                updateTotalPrice();
            });

            quantityInput.addEventListener('input', function() {
                totalItemPriceInput.value = this.value * priceInput.value;
                updateTotalPrice();
            });
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('.total-item-price').forEach(input => {
                totalPrice += parseFloat(input.value) || 0;
            });
            document.getElementById('total_price').value = totalPrice;
        }

        document.getElementById('add-item').addEventListener('click', function() {
            const newItem = `
                <div class="order-item">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="product_id">Product</label>
                        <div class="uk-form-controls">
                            <select name="items[${itemIndex}][product_id]" class="uk-select product-select" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-category="{{ $product->category->name }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="category">Category</label>
                        <div class="uk-form-controls">
                            <input name="items[${itemIndex}][category]" class="uk-input" type="text" readonly>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="quantity">Quantity</label>
                        <div class="uk-form-controls">
                            <input name="items[${itemIndex}][quantity]" class="uk-input quantity-input" type="number" min="1" required>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="price">Price</label>
                        <div class="uk-form-controls">
                            <input name="items[${itemIndex}][price]" class="uk-input price-input" type="number" step="0.01" readonly>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="total_item_price">Total Item Price</label>
                        <div class="uk-form-controls">
                            <input name="items[${itemIndex}][total_item_price]" class="uk-input total-item-price" type="number" step="0.01" readonly>
                        </div>
                    </div>
                </div>
            `;
            orderItemsContainer.insertAdjacentHTML('beforeend', newItem);
            updateItemDetails(itemIndex);
            itemIndex++;
        });

        // Initialize existing items
        document.querySelectorAll('.order-item').forEach((_, index) => updateItemDetails(index));
    });
</script>
@endsection
