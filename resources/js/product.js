
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
