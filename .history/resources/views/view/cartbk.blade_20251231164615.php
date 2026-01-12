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

            <div class="row" id="cartContent">
                <!-- ============ CART ITEMS ============ -->
                <div class="col-lg-8">
                    <div class="cart-items-wrapper">
                        <!-- ITEM 1 -->
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="{{ asset ('assets/images/product/product1.jpg') }}" alt="Monstera Plant">
                            </div>
                            <div class="item-details">
                                <h3 class="item-name">Monstera Deliciosa - Large</h3>
                                <div class="item-meta">
                                    <span class="item-sku">SKU: MON-001</span>
                                    <div class="item-rating">
                                        <span class="item-stars">★★★★★</span>
                                        <span>(128 reviews)</span>
                                    </div>
                                </div>
                                <div class="item-price">₹45.99</div>
                                <div class="quantity-controls">
                                    <span class="qty-label">Quantity:</span>
                                    <div class="qty-input-group">
                                        <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                                        <input type="text" class="qty-input" value="2" readonly>
                                        <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                                    </div>
                                </div>
                                <div class="item-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)">
                                        <i class="far fa-heart"></i> Save for Later
                                    </button>
                                    <button class="action-btn remove" onclick="removeItem(this)">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ITEM 2 -->
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="{{ asset ('assets/images/product/product5.jpg') }}" alt="Golden Pothos">
                            </div>
                            <div class="item-details">
                                <h3 class="item-name">Golden Pothos - Medium</h3>
                                <div class="item-meta">
                                    <span class="item-sku">SKU: POT-002</span>
                                    <div class="item-rating">
                                        <span class="item-stars">★★★★☆</span>
                                        <span>(95 reviews)</span>
                                    </div>
                                </div>
                                <div class="item-price">₹24.99</div>
                                <div class="quantity-controls">
                                    <span class="qty-label">Quantity:</span>
                                    <div class="qty-input-group">
                                        <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                                        <input type="text" class="qty-input" value="1" readonly>
                                        <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                                    </div>
                                </div>
                                <div class="item-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)">
                                        <i class="far fa-heart"></i> Save for Later
                                    </button>
                                    <button class="action-btn remove" onclick="removeItem(this)">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ITEM 3 -->
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="{{ asset ('assets/images/product/product2.jpg') }}" alt="Snake Plant">
                            </div>
                            <div class="item-details">
                                <h3 class="item-name">Snake Plant - Small</h3>
                                <div class="item-meta">
                                    <span class="item-sku">SKU: SNK-003</span>
                                    <div class="item-rating">
                                        <span class="item-stars">★★★★★</span>
                                        <span>(156 reviews)</span>
                                    </div>
                                </div>
                                <div class="item-price">₹18.99</div>
                                <div class="quantity-controls">
                                    <span class="qty-label">Quantity:</span>
                                    <div class="qty-input-group">
                                        <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                                        <input type="text" class="qty-input" value="1" readonly>
                                        <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                                    </div>
                                </div>
                                <div class="item-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)">
                                        <i class="far fa-heart"></i> Save for Later
                                    </button>
                                    <button class="action-btn remove" onclick="removeItem(this)">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============ CART SUMMARY ============ -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h2 class="summary-title">Order Summary</h2>
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span class="summary-amount">₹179.95</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span class="summary-amount">₹12.99</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span class="summary-amount">₹15.44</span>
                        </div>
                        <div class="summary-row">
                            <span>Discount:</span>
                            <span class="summary-amount" style="color: var(--primary-color);">-₹0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span class="summary-amount total">₹208.38</span>
                        </div>
                        <button class="checkout-btn" onclick="checkout()">Proceed to Checkout</button>
                        <button class="continue-shopping-btn" onclick="continueShopping()">Continue Shopping</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


@include('view.layout.footer')