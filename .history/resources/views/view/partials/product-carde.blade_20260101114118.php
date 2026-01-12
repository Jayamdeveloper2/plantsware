<div class="product-card h-100 d-flex flex-column">
    <div class="product-image-container position-relative">
        <a href="{{ route('product.show', $product->slug) }}">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/product/product1.jpg') }}"
                 alt="{{ $product->name }}" class="product-image main-image w-100 h-100 object-fit-cover">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/product/product1.jpg') }}"
                 alt="{{ $product->name }}" class="product-image hover-image w-100 h-100 object-fit-cover">
            @if($product->sale_price && $product->sale_price < $product->price)
                <span class="discount-badge">
                    {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                </span>
            @endif
        </a>
    </div>

    <div class="product-info mt-3 flex-grow-1 d-flex flex-column">
        <h3 class="product-title mb-2">
            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                {{ $product->name }}
            </a>
        </h3>

        <div class="product-price mb-3">
            @if($product->sale_price && $product->sale_price < $product->price)
                <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($product->price, 2) }}</span>
                <span class="current-price ms-2 fw-bold text-primary">₹{{ number_format($product->sale_price, 2) }}</span>
            @else
                <span class="current-price fw-bold">₹{{ number_format($product->price, 2) }}</span>
            @endif
        </div>

        <div class="product-actions mt-auto d-flex gap-2">
            @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-fill">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-sm w-100" disabled>Out of Stock</button>
            @endif

            <form action="{{ route('wishlist.add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="far fa-heart"></i>
                </button>
            </form>
        </div>
    </div>
</div>