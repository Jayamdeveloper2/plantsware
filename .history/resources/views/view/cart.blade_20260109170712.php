@include('view.layout.header')

<!-- CSRF Token for AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">Cart</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main class="cart-section">
    <div class="container">
        <h1 class="cart-title">Shopping Cart</h1>

        @if(isset($cartItems) && $cartItems->count() > 0)
            <div class="row" id="cartContent">
                <!-- CART ITEMS -->
                <div class="col-lg-8">
                    <div class="cart-items-wrapper" id="cartItemsWrapper">
                        @foreach($cartItems as $item)
                            @if(isset($item->product))
                            <div class="cart-item" id="cartItem_{{ $item->id }}">
                                <div class="item-image">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/images/product/product1.jpg') }}" 
                                         alt="{{ $item->product->name }}">
                                </div>
                                <div class="item-details">
                                    <h3 class="item-name">{{ $item->product->name }}</h3>
                                    <div class="item-meta">
                                        @if($item->product->sku)
                                            <span class="item-sku">SKU: {{ $item->product->sku }}</span>
                                        @endif
                                    </div>
                                    <div class="item-price">₹{{ number_format($item->product->price ?? 0, 2) }}</div>
                                    <div class="item-total" id="itemTotal_{{ $item->id }}">
                                        ₹{{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}
                                    </div>
                                    <div class="quantity-controls">
                                        <span class="qty-label">Quantity:</span>
                                        <div class="qty-input-group">
                                            <button type="button" class="qty-btn decrement" 
                                                    onclick="updateCartItem({{ $item->id }}, -1)">−</button>
                                            <input type="number" id="quantity_{{ $item->id }}" 
                                                   value="{{ $item->quantity }}" min="1" 
                                                   class="qty-input" readonly>
                                            <button type="button" class="qty-btn increment" 
                                                    onclick="updateCartItem({{ $item->id }}, 1)">+</button>
                                        </div>
                                    </div>
                                    <div class="item-actions">
                                        @auth
                                            @if(Auth::user()->inWishlist($item->product))
                                                <button type="button" class="action-btn" 
                                                        onclick="toggleWishlist({{ $item->product->id }}, 'remove')">
                                                    <i class="fas fa-heart text-danger"></i> Remove from Wishlist
                                                </button>
                                            @else
                                                <button type="button" class="action-btn" 
                                                        onclick="toggleWishlist({{ $item->product->id }}, 'add')">
                                                    <i class="far fa-heart"></i> Save for Later
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="action-btn text-decoration-none">
                                                <i class="far fa-heart"></i> Save for Later
                                            </a>
                                        @endauth

                                        <button type="button" class="action-btn remove" 
                                                onclick="removeCartItem({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- CART SUMMARY -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h2 class="summary-title">Order Summary</h2>
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span class="summary-amount" id="cartSubtotal">₹{{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span class="summary-amount">Free</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span class="summary-amount">₹0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Discount:</span>
                            <span class="summary-amount" style="color: var(--primary-color);">-₹0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span class="summary-amount total" id="cartTotal">₹{{ number_format($total ?? $subtotal ?? 0, 2) }}</span>
                        </div>
                        <button type="button" class="checkout-btn" onclick="window.location='{{ route('checkout.address') }}'">Proceed to Checkout</button>
                        <button type="button" class="continue-shopping-btn" onclick="window.location='{{ route('home') }}'">Continue Shopping</button>
                        <button type="button" class="clear-cart-btn btn btn-outline-danger w-100 mt-3" 
                                onclick="clearCart()">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5" style="min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <h3 class="mb-4" style="color: #666;">Your cart is empty</h3>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="background-color: var(--primary-color); border: none; padding: 12px 30px; font-size: 16px;">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</main>

<script>
// Util: Get CSRF Token from page
function getCsrfToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.getAttribute('content') : '';
}

// Util: Show toast message
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = 'toast-message';
    toast.innerHTML = message;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#2ecc71' : '#e74c3c'};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease;
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Update cart quantity
function updateCartItem(itemId, delta) {
    const input = document.getElementById(`quantity_${itemId}`);
    if (!input) return;
    let quantity = parseInt(input.value) + delta;
    if (quantity < 1) quantity = 1;

    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ quantity })
    })
    .then(response => {
        if (!response.ok) throw new Error();
        return response.json();
    })
    .then(data => {
        if (data.success) {
            input.value = data.quantity;
            document.getElementById(`itemTotal_${itemId}`).textContent = `₹${data.item_total}`;
            document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
            document.getElementById('cartTotal').textContent = `₹${data.total}`;
            document.querySelectorAll('.cart-count, .cart-count-badge').forEach(e => e.textContent = data.cart_count);
            showToast(data.message || 'Quantity updated!', 'success');
        }
        else {
            showToast(data.message || 'Error updating quantity', 'error');
        }
    })
    .catch(() => {
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Remove an item
function removeCartItem(itemId) {
    if (!confirm('Are you sure you want to remove this item from cart?')) return;
    fetch(`/cart/remove/${itemId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove item in DOM
            const elem = document.getElementById(`cartItem_${itemId}`);
            if (elem) elem.remove();
            document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
            document.getElementById('cartTotal').textContent = `₹${data.total}`;
            document.querySelectorAll('.cart-count, .cart-count-badge').forEach(e => e.textContent = data.cart_count);
            const wrapper = document.getElementById('cartItemsWrapper');
            if (wrapper && wrapper.children.length === 0) {
                document.getElementById('cartContent').innerHTML =
                    `<div class="text-center py-5" style="min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <h3 class="mb-4" style="color: #666;">Your cart is empty</h3>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="background-color: var(--primary-color); border: none; padding: 12px 30px; font-size: 16px;">
                            Start Shopping
                        </a>
                    </div>`;
            }
            showToast(data.message || 'Item removed!', 'success');
        } else {
            showToast(data.message || 'Error removing item', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Clear entire cart
function clearCart() {
    if (!confirm('Are you sure you want to clear your entire cart?')) {
        return;
    }
    
    fetch('/cart/clear', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear all items
            document.getElementById('cartItemsWrapper').innerHTML = '';
            
            // Update summary
            document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
            document.getElementById('cartTotal').textContent = `₹${data.total}`;
            
            // Update cart count
            const cartCountElements = document.querySelectorAll('.cart-count, .cart-count-badge');
            cartCountElements.forEach(element => {
                element.textContent = data.cart_count;
            });
            
            // Show empty cart message
            document.getElementById('cartContent').innerHTML = `
                <div class="text-center py-5" style="min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <h3 class="mb-4" style="color: #666;">Your cart is empty</h3>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="background-color: var(--primary-color); border: none; padding: 12px 30px; font-size: 16px;">
                        Start Shopping
                    </a>
                </div>
            `;
            
            showToast(data.message || 'Cart cleared!', 'success');
        } else {
            showToast(data.message || 'Error clearing cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Toggle wishlist
function toggleWishlist(productId, action) {
    const url = action === 'add' ? `/wishlist/add/${productId}` : `/wishlist/remove/${productId}`;
    const method = action === 'add' ? 'POST' : 'DELETE';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload page to update wishlist buttons
            window.location.reload();
        } else if (data.login_url) {
            window.location.href = data.login_url;
        } else {
            showToast(data.message || 'Error updating wishlist', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Test function to verify JavaScript is working
function testCartFunctions() {
    alert('JavaScript is working! Check console for details.');
    console.log('CSRF Token:', getCsrfToken());
    console.log('Cart functions are loaded');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Cart page JavaScript loaded successfully');
    console.log('CSRF Token available:', getCsrfToken() ? 'Yes' : 'No');
});
</script>

<!-- Add CSS for toast -->
<style>
.toast-message {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #2ecc71;
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Your existing cart styles here... */
</style>

@include('view.layout.footer')