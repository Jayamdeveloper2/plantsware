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
                                    <button type="button" class="action-btn remove" 
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

<!-- FINAL WORKING JAVASCRIPT -->
<script>
// Base URL for your application
const baseUrl = window.location.origin + '/plantsware2';

// Get CSRF token
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

// Update cart item quantity
async function updateQuantity(itemId, change) {
    const input = document.getElementById(`quantity_${itemId}`);
    if (!input) return;
    
    let newQuantity = parseInt(input.value) + change;
    if (newQuantity < 1) newQuantity = 1;
    
    // Disable input during request
    input.disabled = true;
    
    try {
        const response = await fetch(`${baseUrl}/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: newQuantity })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update UI
            input.value = data.quantity;
            
            // Update item total
            const itemTotalEl = document.getElementById(`itemTotal_${itemId}`);
            if (itemTotalEl && data.item_total) {
                itemTotalEl.textContent = `₹${data.item_total}`;
            }
            
            // Update cart summary
            if (data.subtotal) {
                document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
            }
            if (data.total) {
                document.getElementById('cartTotal').textContent = `₹${data.total}`;
            }
            
            // Update cart count in header
            updateCartCount(data.cart_count);
            
            showToast(data.message || 'Quantity updated!', 'success');
        } else {
            showToast(data.message || 'Error updating quantity', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to update quantity. Please try again.', 'error');
    } finally {
        input.disabled = false;
    }
}

// Remove item from cart
async function removeCartItem(itemId) {
    if (!confirm('Are you sure you want to remove this item from cart?')) {
        return;
    }
    
    try {
        const response = await fetch(`${baseUrl}/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Remove item with animation
            const cartItem = document.getElementById(`cartItem_${itemId}`);
            if (cartItem) {
                cartItem.style.transition = 'all 0.3s ease';
                cartItem.style.opacity = '0';
                cartItem.style.transform = 'translateX(-100px)';
                
                setTimeout(() => {
                    cartItem.remove();
                    
                    // Update cart summary
                    if (data.subtotal) {
                        document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
                    }
                    if (data.total) {
                        document.getElementById('cartTotal').textContent = `₹${data.total}`;
                    }
                    
                    // Update cart count
                    updateCartCount(data.cart_count);
                    
                    // Check if cart is empty
                    const cartItemsWrapper = document.getElementById('cartItemsWrapper');
                    if (cartItemsWrapper && cartItemsWrapper.children.length === 0) {
                        showEmptyCart();
                    }
                    
                    showToast(data.message || 'Item removed!', 'success');
                }, 300);
            }
        } else {
            showToast(data.message || 'Error removing item', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to remove item. Please try again.', 'error');
    }
}

// Clear entire cart
async function clearCart() {
    if (!confirm('Are you sure you want to clear your entire cart?')) {
        return;
    }
    
    try {
        const response = await fetch(`${baseUrl}/cart/clear`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
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
                if (data.subtotal) {
                    document.getElementById('cartSubtotal').textContent = `₹${data.subtotal}`;
                }
                if (data.total) {
                    document.getElementById('cartTotal').textContent = `₹${data.total}`;
                }
                
                // Update cart count
                updateCartCount(data.cart_count);
                
                // Show empty cart message
                showEmptyCart();
                
                showToast(data.message || 'Cart cleared!', 'success');
            }, cartItems.length * 100);
        } else {
            showToast(data.message || 'Error clearing cart', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to clear cart. Please try again.', 'error');
    }
}

// Add/remove from wishlist
async function toggleWishlist(productId, action) {
    const url = `${baseUrl}/wishlist/${action}/${productId}`;
    const method = action === 'add' ? 'POST' : 'DELETE';
    
    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Reload page to update wishlist buttons
            window.location.reload();
        } else if (data.login_url) {
            window.location.href = data.login_url;
        } else {
            showToast(data.message || 'Error updating wishlist', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to update wishlist. Please try again.', 'error');
    }
}

// Update cart count in header
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

// Show empty cart message
function showEmptyCart() {
    const cartContent = document.getElementById('cartContent');
    if (cartContent) {
        cartContent.innerHTML = `
            <div class="text-center py-5" style="min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <h3 class="mb-4" style="color: #666;">Your cart is empty</h3>
                <a href="${baseUrl}" class="btn btn-primary mt-3" style="background-color: var(--primary-color); border: none; padding: 12px 30px; font-size: 16px;">
                    Start Shopping
                </a>
            </div>
        `;
    }
}

// Show toast notification
function showToast(message, type = 'success') {
    // Remove existing toast
    const existingToast = document.querySelector('.cart-toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Create toast
    const toast = document.createElement('div');
    toast.className = `cart-toast ${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    // Style the toast
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
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
}

// Add CSS animations
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
    
    .cart-toast {
        font-family: Arial, sans-serif;
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
        padding: 0;
        margin-left: 10px;
    }
`;
document.head.appendChild(style);

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Increment buttons
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-item-id');
            if (itemId) {
                updateQuantity(itemId, 1);
            }
        });
    });
    
    // Decrement buttons
    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-item-id');
            if (itemId) {
                updateQuantity(itemId, -1);
            }
        });
    });
    
    // Remove cart item buttons
    document.querySelectorAll('.remove-cart').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-item-id');
            if (itemId) {
                removeCartItem(itemId);
            }
        });
    });
    
    // Add to wishlist buttons
    document.querySelectorAll('.add-wishlist').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            if (productId) {
                toggleWishlist(productId, 'add');
            }
        });
    });
    
    // Remove from wishlist buttons
    document.querySelectorAll('.remove-wishlist').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            if (productId) {
                toggleWishlist(productId, 'remove');
            }
        });
    });
});
</script>

@include('view.layout.footer')