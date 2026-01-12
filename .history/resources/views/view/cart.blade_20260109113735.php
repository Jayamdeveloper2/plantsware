@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block fw-bold"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="d-inline-block fw-bold mx-2">/</li>
                    <li class="d-inline-block fw-bold">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main class="cart-section">
    <div class="container py-5">
        <h1 class="cart-title mb-4">Shopping Cart</h1>

        @if(isset($cartItems) && $cartItems->count() > 0)
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="cart-items-wrapper">
                        @foreach($cartItems as $item)
                            @if(isset($item->product))
                            <div class="cart-item mb-4 p-3 border rounded">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <div class="item-image">
                                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/images/product/product1.jpg') }}"
                                                 alt="{{ $item->product->name }}">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="item-details">
                                            <h3 class="item-name">{{ $item->product->name }}</h3>
                                            <div class="item-price">₹{{ number_format($item->product->price ?? 0, 2) }}</div>
                                            <div class="item-quantity d-flex align-items-center mt-2">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline me-3">
                                                    @csrf
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                            onclick="let input = this.parentNode.querySelector('input[name=quantity]'); if(parseInt(input.value) > 1){ input.value = parseInt(input.value)-1; this.form.submit(); }">−</button>
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                            class="form-control mx-2 text-center" style="width:60px;" onchange="this.form.submit();">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                            onclick="let input = this.parentNode.querySelector('input[name=quantity]'); input.value = parseInt(input.value)+1; this.form.submit();">+</button>
                                                    </div>
                                                </form>

                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Remove {{ $item->product->name }} from cart?')">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-4">
                    <div class="summary-card p-4 border rounded bg-light">
                        <h2 class="h4 mb-3">Order Summary</h2>
                        <div class="summary-row d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span class="summary-amount">₹{{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="summary-row d-flex justify-content-between">
                            <span>Shipping:</span>
                            <span class="summary-amount">Free</span>
                        </div>
                        <div class="summary-row d-flex justify-content-between">
                            <span>Tax:</span>
                            <span class="summary-amount">₹0.00</span>
                        </div>
                        <div class="summary-row total d-flex justify-content-between mt-3 pt-3 border-top">
                            <span>Total:</span>
                            <span class="summary-amount total">₹{{ number_format($total ?? $subtotal ?? 0, 2) }}</span>
                        </div>
                        <a href="{{ route('checkout.address') }}" class="checkout-btn btn btn-success w-100 mt-3">Proceed to Checkout</a>
                        <a href="{{ route('home') }}" class="continue-shopping-btn btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <h3>Your cart is empty</h3>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        @endif
    </div>
</main>

@include('view.layout.footer')