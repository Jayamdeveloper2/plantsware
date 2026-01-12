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
                    <div class="cart-items-wrapper">
                        @foreach($cartItems as $item)
                            @if(isset($item->product))
                            <div class="cart-item">
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
                                    <div class="quantity-controls">
                                        <span class="qty-label">Quantity:</span>
                                        <div class="qty-input-group">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="button" class="qty-btn" 
                                                        onclick="let form = this.closest('form'); let input = form.querySelector('input[name=quantity]'); if(parseInt(input.value) > 1) { input.value = parseInt(input.value)-1; form.submit(); }">−</button>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                                       class="qty-input" onchange="this.form.submit();">
                                                <button type="button" class="qty-btn" 
                                                        onclick="let form = this.closest('form'); let input = form.querySelector('input[name=quantity]'); input.value = parseInt(input.value)+1; form.submit();">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="item-actions">
                                        @if(Auth::check())
                                            @if(Auth::user()->inWishlist($item->product))
                                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-btn">
                                                        <i class="fas fa-heart text-danger"></i> Remove from Wishlist
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('wishlist.add', $item->product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="action-btn">
                                                        <i class="far fa-heart"></i> Save for Later
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="action-btn text-decoration-none">
                                                <i class="far fa-heart"></i> Save for Later
                                            </a>
                                        @endif
                                        
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn remove" 
                                                    onclick="return confirm('Remove {{ $item->product->name }} from cart?')">
                                                <i class="fas fa-trash-alt"></i> Remove
                                            </button>
                                        </form>
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
                            <span class="summary-amount">₹{{ number_format($subtotal ?? 0, 2) }}</span>
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
                            <span class="summary-amount total">₹{{ number_format($total ?? $subtotal ?? 0, 2) }}</span>
                        </div>
                        <a href="{{ route('checkout.address') }}" class="checkout-btn">Proceed to Checkout</a>
                        <a href="{{ route('home') }}" class="continue-shopping-btn">Continue Shopping</a>
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

<!-- Add CSS for the static styling -->
<style>
    :root {
        --primary-color: #2ecc71;
        --secondary-color: #1ddd6d;
        --text-color: #f8f9fa;
        --light-gray: #f8f9fa;
        --border-color: #e0e0e0;
    }

    .cart-section {
        padding: 60px 0;
        background-color: var(--light-gray);
    }

    .cart-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 40px;
        text-align: center;
    }

    .cart-items-wrapper {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .cart-item {
        display: flex;
        padding: 25px 0;
        border-bottom: 1px solid var(--border-color);
        align-items: flex-start;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 150px;
        height: 150px;
        flex-shrink: 0;
        margin-right: 25px;
        border-radius: 8px;
        overflow: hidden;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .item-image img:hover {
        transform: scale(1.05);
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 8px;
    }

    .item-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 10px;
    }

    .item-sku {
        font-size: 0.9rem;
        color: #666;
    }

    .item-rating {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .item-stars {
        color: #ffc107;
        font-size: 1rem;
    }

    .item-price {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .qty-label {
        font-weight: 600;
        color: var(--text-color);
    }

    .qty-input-group {
        display: flex;
        align-items: center;
    }

    .qty-btn {
        width: 35px;
        height: 35px;
        border: 1px solid var(--border-color);
        background: white;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .qty-btn:hover {
        background-color: var(--light-gray);
        border-color: var(--primary-color);
    }

    .qty-input {
        width: 60px;
        height: 35px;
        border: 1px solid var(--border-color);
        border-left: none;
        border-right: none;
        text-align: center;
        font-size: 1rem;
        outline: none;
    }

    .item-actions {
        display: flex;
        gap: 20px;
        margin-top: 15px;
    }

    .action-btn {
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.3s ease;
        padding: 5px 0;
    }

    .action-btn:hover {
        color: var(--primary-color);
    }

    .action-btn.remove:hover {
        color: #e74c3c;
    }

    .action-btn i {
        font-size: 1rem;
    }

    .cart-summary {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        position: sticky;
        top: 20px;
    }

    .summary-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .summary-row.total {
        font-size: 1.3rem;
        font-weight: 700;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid var(--border-color);
    }

    .summary-amount {
        font-weight: 600;
        color: var(--text-color);
    }

    .summary-amount.total {
        color: var(--primary-color);
        font-size: 1.5rem;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        padding: 15px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        margin-top: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .checkout-btn:hover {
        background-color: var(--secondary-color);
        color: white;
        text-decoration: none;
    }

    .continue-shopping-btn {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: white;
        color: var(--text-color);
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        margin-top: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .continue-shopping-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
        }
        
        .item-image {
            width: 100%;
            height: 200px;
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .item-actions {
            flex-wrap: wrap;
        }
        
        .cart-summary {
            margin-top: 30px;
        }
    }
</style>

@include('view.layout.footer')