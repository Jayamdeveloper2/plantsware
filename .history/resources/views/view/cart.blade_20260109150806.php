@include('view.layout.header')

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
                <!-- ============ CART ITEMS ============ -->
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
                                        @if($item->product->average_rating)
                                            <div class="item-rating">
                                                @php
                                                    $rating = $item->product->average_rating ?? 0;
                                                    $fullStars = floor($rating);
                                                    $hasHalfStar = $rating - $fullStars >= 0.5;
                                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                                @endphp
                                                <span class="item-stars">
                                                    @for($i = 0; $i < $fullStars; $i++)
                                                        ★
                                                    @endfor
                                                    @if($hasHalfStar)
                                                        ★
                                                    @endif
                                                    @for($i = 0; $i < $emptyStars; $i++)
                                                        ☆
                                                    @endfor
                                                </span>
                                                @if($item->product->reviews_count)
                                                    <span>({{ $item->product->reviews_count }} reviews)</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="item-price">₹{{ number_format($item->product->price ?? 0, 2) }}</div>
                                    <div class="item-total" id="itemTotal_{{ $item->id }}">
                                        ₹{{ number_format($item->product->price * $item->quantity, 2) }}
                                    </div>
                                    <div class="quantity-controls">
                                        <span class="qty-label">Quantity:</span>
                                        <div class="qty-input-group">
                                            <button type="button" class="qty-btn decrement" 
                                                    data-item-id="{{ $item->id }}">−</button>
                                            <input type="number" id="quantity_{{ $item->id }}" 
                                                   value="{{ $item->quantity }}" min="1" 
                                                   class="qty-input" readonly>
                                            <button type="button" class="qty-btn increment" 
                                                    data-item-id="{{ $item->id }}">+</button>
                                        </div>
                                    </div>
                                    <div class="item-actions">
                                        @if(Auth::check())
                                            @if(Auth::user()->inWishlist($item->product))
                                                <button type="button" class="action-btn remove-wishlist" 
                                                        data-product-id="{{ $item->product->id }}">
                                                    <i class="fas fa-heart text-danger"></i> Remove from Wishlist
                                                </button>
                                            @else
                                                <button type="button" class="action-btn add-wishlist" 
                                                        data-product-id="{{ $item->product->id }}">
                                                    <i class="far fa-heart"></i> Save for Later
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="action-btn text-decoration-none">
                                                <i class="far fa-heart"></i> Save for Later
                                            </a>
                                        @endif
                                        
                                        <button type="button" class="action-btn remove remove-cart" 
                                                data-item-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- ============ CART SUMMARY ============ -->
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
                        <a href="{{ route('checkout.address') }}" class="checkout-btn">Proceed to Checkout</a>
                        <a href="{{ route('home') }}" class="continue-shopping-btn">Continue Shopping</a>
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

<!-- Add CSS for the static styling (unchanged, omitted for brevity) -->
<style>
/* ... styles unchanged ... */
</style>

<!-- JavaScript for AJAX functionality -->
<script>
// CSRF Token setup for AJAX
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Update quantity with AJAX
function updateQuantity(itemId, newQuantity) {
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity input
            document.getElementById(`quantity_${itemId}`).value = newQuantity;

            // Update item total
            document.getElementById(`itemTotal_${itemId}`).textContent = `₹${data.item_total}`;

            // Update cart summary
            document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
            document.getElementById('cartTotal').textContent = `₹${data.total}`;

            // Update cart count in header (if you have one)
            updateCartCount(data.cart_count);

            showToast(data.message, 'success');
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Remove item with AJAX
function removeCartItem(itemId) {
    if (!confirm('Are you sure you want to remove this item from cart?')) {
        return;
    }
    fetch(`/cart/remove/${itemId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove item from DOM with animation
            const cartItem = document.getElementById(`cartItem_${itemId}`);
            cartItem.style.transition = 'all 0.3s ease';
            cartItem.style.opacity = '0';
            cartItem.style.transform = 'translateX(-100px)';

            setTimeout(() => {
                cartItem.remove();

                // Update cart summary
                document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
                document.getElementById('cartTotal').textContent = `₹${data.total}`;

                // Update cart count in header
                updateCartCount(data.cart_count);

                // If cart is empty, show empty cart message
                const cartItemsWrapper = document.getElementById('cartItemsWrapper');
                if (cartItemsWrapper.children.length === 0) {
                    showEmptyCart();
                }

                showToast(data.message, 'success');
            }, 300);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Clear entire cart with AJAX
function clearCart() {
    if (!confirm('Are you sure you want to clear your entire cart?')) {
        return;
    }
    fetch('/cart/clear', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear all cart items with animation
            const cartItems = document.querySelectorAll('.cart-item');
            cartItems.forEach((item, index) => {
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '0';
                item.style.transform = 'translateX(-100px)';
                setTimeout(() => {
                    item.remove();
                }, index * 100);
            });

            setTimeout(() => {
                // Update cart summary
                document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
                document.getElementById('cartTotal').textContent = `₹${data.total}`;
                // Update cart count in header
                updateCartCount(data.cart_count);
                // Show empty cart message
                showEmptyCart();
                showToast(data.message, 'success');
            }, cartItems.length * 100);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Add to wishlist with AJAX
function addToWishlist(productId) {
    fetch(`/wishlist/add/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button state
            const addBtn = document.querySelector(`button.add-wishlist[data-product-id="${productId}"]`);
            if (addBtn) {
                addBtn.innerHTML = '<i class="fas fa-heart text-danger"></i> Remove from Wishlist';
                addBtn.classList.remove('add-wishlist');
                addBtn.classList.add('remove-wishlist');
                addBtn.dataset.action = 'remove-wishlist'; // for event delegation
            }
            // Update wishlist count
            updateWishlistCount(data.wishlist_count);
            showToast(data.message, 'success');
        } else if (data.login_url) {
            // Redirect to login if not authenticated
            window.location.href = data.login_url;
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Remove from wishlist with AJAX
function removeFromWishlist(productId) {
    fetch(`/wishlist/remove/${productId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button state
            const removeBtn = document.querySelector(`button.remove-wishlist[data-product-id="${productId}"]`);
            if (removeBtn) {
                removeBtn.innerHTML = '<i class="far fa-heart"></i> Save for Later';
                removeBtn.classList.remove('remove-wishlist');
                removeBtn.classList.add('add-wishlist');
                removeBtn.dataset.action = 'add-wishlist'; // for event delegation
            }
            // Update wishlist count
            updateWishlistCount(data.wishlist_count);
            showToast(data.message, 'success');
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    });
}

// Update cart count in header (if you have a cart count element)
function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count, .cart-count-badge');
    cartCountElements.forEach(element => {
        element.textContent = count;
        if (count > 0) {
            element.style.display = 'inline';
        } else {
            element.style.display = 'none';
        }
    });
}

// Update wishlist count in header (if you have a wishlist count element)
function updateWishlistCount(count) {
    const wishlistCountElements = document.querySelectorAll('.wishlist-count, .wishlist-count-badge');
    wishlistCountElements.forEach(element => {
        element.textContent = count;
        if (count > 0) {
            element.style.display = 'inline';
        } else {
            element.style.display = 'none';
        }
    });
}

// Show empty cart message
function showEmptyCart() {
    const cartContent = document.getElementById('cartContent');
    cartContent.innerHTML = `
        <div class="text-center py-5" style="min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h3 class="mb-4" style="color: #666;">Your cart is empty</h3>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="background-color: var(--primary-color); border: none; padding: 12px 30px; font-size: 16px;">
                Start Shopping
            </a>
        </div>
    `;
}

// Show toast notification
function showToast(message, type = 'success') {
    // Remove existing toast
    const existingToast = document.querySelector('.custom-toast');
    if (existingToast) {
        existingToast.remove();
    }
    // Create toast
    const toast = document.createElement('div');
    toast.className = `custom-toast ${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#2ecc71' : '#e74c3c'};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease;
        max-width: 400px;
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
        if (toast.parentNode) {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
}

// Add CSS animations (unchanged)
const style = document.createElement('style');
style.textContent = `
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
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    .toast-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .toast-close {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        line-height: 1;
    }
`;
document.head.appendChild(style);

// Event delegation for actions to support increment/decrement and wishlist reliably
document.addEventListener('DOMContentLoaded', function () {
    // Use event delegation for cart actions
    document.body.addEventListener('click', function (event) {
        const btn = event.target.closest('button, a');

        if (!btn) return;

        // Handle increment
        if (btn.classList.contains('increment') && btn.hasAttribute('data-item-id')) {
            event.preventDefault();
            const itemId = btn.getAttribute('data-item-id');
            const input = document.getElementById(`quantity_${itemId}`);
            const currentValue = parseInt(input.value);
            const newQuantity = currentValue + 1;
            updateQuantity(itemId, newQuantity);
            return;
        }

        // Handle decrement
        if (btn.classList.contains('decrement') && btn.hasAttribute('data-item-id')) {
            event.preventDefault();
            const itemId = btn.getAttribute('data-item-id');
            const input = document.getElementById(`quantity_${itemId}`);
            const currentValue = parseInt(input.value);
            const newQuantity = Math.max(1, currentValue - 1);
            if (newQuantity !== currentValue) {
                updateQuantity(itemId, newQuantity);
            }
            return;
        }

        // Handle remove cart
        if (btn.classList.contains('remove-cart') && btn.hasAttribute('data-item-id')) {
            event.preventDefault();
            const itemId = btn.getAttribute('data-item-id');
            removeCartItem(itemId);
            return;
        }

        // Handle add to wishlist
        if (btn.classList.contains('add-wishlist') && btn.hasAttribute('data-product-id')) {
            event.preventDefault();
            const productId = btn.getAttribute('data-product-id');
            addToWishlist(productId);
            return;
        }

        // Handle remove from wishlist
        if (btn.classList.contains('remove-wishlist') && btn.hasAttribute('data-product-id')) {
            event.preventDefault();
            const productId = btn.getAttribute('data-product-id');
            removeFromWishlist(productId);
            return;
        }
    });
});
</script>

@include('view.layout.footer')