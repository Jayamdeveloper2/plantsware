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
                        <a href="{{ route('checkout.address') }}" class="checkout-btn">Proceed to Checkout</a><br>
                        
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


@include('view.layout.footer')