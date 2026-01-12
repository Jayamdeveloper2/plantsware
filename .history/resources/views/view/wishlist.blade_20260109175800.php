@include('view.layout.header')

<!-- Ensure CSRF token is in header -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">My Wishlist</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="gi-vendor-dashboard-card">
                <div class="gi-vendor-card-header">
                    <h5>My Wishlist</h5>
                    <div class="">
                        <a class="btn btn-outline-white" href="{{ route('home') }}">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
                <div class="gi-vendor-card-body">
                    @if(Auth::check() && $wishlistItems->count() > 0)
                        <!-- Wishlist Items Table -->
                        <div class="gi-vendor-card-table">
                            <table class="table gi-table" id="wishlistTable">
                                <thead>
                                    <tr>
                                        <th scope="col">S. NO</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="wishlist-items" id="wishlistItems">
                                    @foreach($wishlistItems as $index => $item)
                                        @if(isset($item->product))
                                        <tr class="pro-gl-content" id="wishlistItem_{{ $item->id }}">
                                            <td scope="row"><span>{{ $index + 1 }}</span></td>
                                            <td>
                                                <img class="prod-img" 
                                                     src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/images/product/product1.jpg') }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <a href="{{ route('product.show', $item->product->slug) }}" class="text-decoration-none text-dark">
                                                    <strong>{{ $item->product->name }}</strong>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="text-success fw-bold">₹{{ number_format($item->product->price, 2) }}</span>
                                            </td>
                                            <td>
                                                @if($item->product->stock_quantity > 0)
                                                    <span class="badge bg-success">In Stock</span>
                                                @else
                                                    <span class="badge bg-danger">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="tbl-btn d-flex gap-2">
                                                    @if($item->product->stock_quantity > 0)
                                                        <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="gi-btn-2 add-to-cart" title="Add To Cart">
                                                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    <button type="button" class="gi-btn-1 gi-remove-wish btn" 
                                                            onclick="removeFromWishlist({{ $item->product->id }})" 
                                                            title="Remove From List">
                                                        ×
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty Wishlist -->
                        <div class="text-center py-5">
                            @if(!Auth::check())
                                <div class="empty-wishlist">
                                    <i class="far fa-heart fa-4x text-muted mb-3"></i>
                                    <h4>Your wishlist is empty</h4>
                                    <p class="text-muted">Please login to add items to your wishlist</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">
                                        <i class="fas fa-sign-in-alt me-2"></i> Login Now
                                    </a>
                                </div>
                            @else
                                <div class="empty-wishlist">
                                    <i class="far fa-heart fa-4x text-muted mb-3"></i>
                                    <h4>Your wishlist is empty</h4>
                                    <p class="text-muted">You haven't added any products to your wishlist yet</p>
                                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                                        <i class="fas fa-shopping-bag me-2"></i> Start Shopping
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($wishlistItems->count() > 0)
<section class="bg-white-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Related Products</h2>
            <div class="title-link">
                <a href="{{ route('products.index') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                <!-- You can add dynamic related products here -->
                <!-- For now, keeping the static ones -->
                @foreach($wishlistItems->take(10) as $item)
                    @if(isset($item->product))
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="product-image-container">
                                <a href="{{ route('product.show', $item->product->slug) }}">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/images/product/product1.jpg') }}" 
                                         alt="{{ $item->product->name }}" class="product-image main-image">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/images/product/product1.jpg') }}" 
                                         alt="{{ $item->product->name }}" class="product-image hover-image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">{{ $item->product->name }}</h3>
                                <div class="product-price">
                                    <span class="current-price">₹{{ number_format($item->product->price, 2) }}</span>
                                </div>
                                <div class="product-actions">
                                    <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-secondary" data-tooltip="Add to Cart">
                                            <span class="btn-text">Add to Cart</span>
                                            <i class="btn-icon fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-wishlist" 
                                            onclick="removeFromWishlist({{ $item->product->id }})" 
                                            data-tooltip="Remove from Wishlist">
                                        <i class="fas fa-heart text-danger"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
@endif

<!-- Wishlist JavaScript -->
<script>
// Base URL for your application
const baseUrl = window.location.origin + '/plantsware2';

// Get CSRF token
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

// Remove from wishlist with AJAX
async function removeFromWishlist(productId) {
    if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
        return;
    }
    
    try {
        const response = await fetch(`${baseUrl}/wishlist/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Find and remove the row with animation
            const rows = document.querySelectorAll('.pro-gl-content');
            rows.forEach(row => {
                const removeBtn = row.querySelector('.gi-remove-wish');
                if (removeBtn && removeBtn.getAttribute('onclick')?.includes(productId)) {
                    // Add removal animation
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0.5';
                    row.style.transform = 'translateX(20px)';
                    
                    setTimeout(() => {
                        row.remove();
                        
                        // Update serial numbers
                        updateSerialNumbers();
                        
                        // Update wishlist count in header
                        if (data.wishlist_count !== undefined) {
                            updateWishlistCount(data.wishlist_count);
                        }
                        
                        // Check if wishlist is empty
                        const wishlistItems = document.getElementById('wishlistItems');
                        if (wishlistItems && wishlistItems.children.length === 0) {
                            showEmptyWishlist();
                        }
                        
                        showToast(data.message || 'Removed from wishlist!', 'success');
                    }, 300);
                }
            });
            
            // Also update wishlist buttons in related products
            updateRelatedProductWishlistButtons(productId);
            
        } else {
            showToast(data.message || 'Failed to remove from wishlist', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to remove item. Please try again.', 'error');
    }
}

// Add to cart from wishlist
async function addToCartFromWishlist(productId, button) {
    try {
        // Add loading animation to button
        const originalHtml = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;
        
        const response = await fetch(`${baseUrl}/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                quantity: 1
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update cart count in header
            if (data.cart_count !== undefined) {
                updateCartCount(data.cart_count);
            }
            
            showToast(data.message || 'Added to cart!', 'success');
            
            // Optional: Remove from wishlist after adding to cart
            // removeFromWishlist(productId);
            
        } else {
            showToast(data.message || 'Failed to add to cart', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to add to cart. Please try again.', 'error');
    } finally {
        // Restore button
        button.innerHTML = originalHtml;
        button.disabled = false;
    }
}

// Update serial numbers after removal
function updateSerialNumbers() {
    const rows = document.querySelectorAll('.pro-gl-content');
    rows.forEach((row, index) => {
        const serialSpan = row.querySelector('td:first-child span');
        if (serialSpan) {
            serialSpan.textContent = index + 1;
        }
    });
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

// Update wishlist count in header
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

// Show empty wishlist message
function showEmptyWishlist() {
    const wishlistBody = document.querySelector('.gi-vendor-card-body');
    if (wishlistBody) {
        wishlistBody.innerHTML = `
            <div class="text-center py-5">
                <div class="empty-wishlist">
                    <i class="far fa-heart fa-4x text-muted mb-3"></i>
                    <h4>Your wishlist is empty</h4>
                    <p class="text-muted">You haven't added any products to your wishlist yet</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-shopping-bag me-2"></i> Start Shopping
                    </a>
                </div>
            </div>
        `;
        
        // Hide related products section
        const relatedSection = document.querySelector('.bg-white-section');
        if (relatedSection) {
            relatedSection.style.display = 'none';
        }
    }
}

// Update related product wishlist buttons
function updateRelatedProductWishlistButtons(productId) {
    // Find all wishlist buttons in related products
    const wishlistButtons = document.querySelectorAll('.btn-wishlist');
    wishlistButtons.forEach(button => {
        if (button.getAttribute('onclick')?.includes(productId)) {
            // Change to add to wishlist button
            button.innerHTML = '<i class="far fa-heart"></i>';
            button.setAttribute('onclick', `addToWishlistFromRelated(${productId})`);
            button.setAttribute('data-tooltip', 'Add to Wishlist');
        }
    });
}

// Add to wishlist from related products
async function addToWishlistFromRelated(productId) {
    try {
        const response = await fetch(`${baseUrl}/wishlist/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update button to remove from wishlist
            const buttons = document.querySelectorAll('.btn-wishlist');
            buttons.forEach(button => {
                if (button.getAttribute('onclick')?.includes(`addToWishlistFromRelated(${productId})`)) {
                    button.innerHTML = '<i class="fas fa-heart text-danger"></i>';
                    button.setAttribute('onclick', `removeFromWishlist(${productId})`);
                    button.setAttribute('data-tooltip', 'Remove from Wishlist');
                }
            });
            
            // Update wishlist count
            if (data.wishlist_count !== undefined) {
                updateWishlistCount(data.wishlist_count);
            }
            
            showToast(data.message || 'Added to wishlist!', 'success');
        } else if (data.login_url) {
            window.location.href = data.login_url;
        } else {
            showToast(data.message || 'Failed to add to wishlist', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Failed to add to wishlist. Please try again.', 'error');
    }
}

// Show toast notification
function showToast(message, type = 'success') {
    // Remove existing toast
    const existingToast = document.querySelector('.wishlist-toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Create toast
    const toast = document.createElement('div');
    toast.className = `wishlist-toast ${type}`;
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
    
    .wishlist-toast {
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
    
    .empty-wishlist {
        padding: 40px 0;
    }
    
    .empty-wishlist i {
        font-size: 4rem;
        margin-bottom: 20px;
    }
    
    .gi-btn-2 {
        background: #28a745;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .gi-btn-2:hover {
        background: #218838;
        transform: scale(1.05);
    }
    
    .gi-btn-1 {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .gi-btn-1:hover {
        background: #c82333;
        transform: scale(1.05);
    }
    
    .tbl-btn {
        display: flex;
        gap: 8px;
    }
`;
document.head.appendChild(style);

// Initialize event listeners for add to cart buttons
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart buttons in wishlist table
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            if (form) {
                // Submit the form
                form.submit();
            }
        });
    });
    
    // Add event listeners to wishlist buttons in related products
    document.querySelectorAll('.btn-wishlist').forEach(button => {
        button.addEventListener('click', function() {
            const onclickAttr = this.getAttribute('onclick');
            if (onclickAttr && onclickAttr.includes('removeFromWishlist')) {
                const productId = onclickAttr.match(/\d+/)[0];
                removeFromWishlist(productId);
            }
        });
    });
    
    console.log('Wishlist page initialized');
});
</script>

@include('view.layout.footer')