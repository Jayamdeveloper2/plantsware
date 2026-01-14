@include('view.layout.header')

<!-- Breadcrumb -->
<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder">
                        <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    @if($product->category)
                        <li class="d-inline-block font-weight-bolder">
                            <a href="{{ route('category.show', $product->category->slug) }}" class="text-decoration-none">{{ $product->category->name }}</a>
                        </li>
                        <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    @endif
                    <li class="d-inline-block font-weight-bolder">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="container-fluid product-page-container">
        <div class="product-page-section">
            <div class="row">
                <!-- Product Gallery -->
                <div class="col-lg-6">
                    <div class="product-page-gallery">
                        <div class="product-page-gallery-main position-relative">
                            <img id="mainProductImage" src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}" class="w-100">
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="product-page-badge-sale">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF</span>
                            @endif
                        </div>

                        <div class="product-page-gallery-thumbs mt-3 d-flex flex-wrap gap-2 justify-content-center">
                            <!-- Main Image Thumbnail -->
                            <div class="product-page-thumb active" data-src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/product/product1.jpg') }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}">
                            </div>

                            <!-- Gallery Images -->
                            @if($product->gallery_images && count($product->gallery_images) > 0)
                                @foreach($product->gallery_images as $galleryImage)
                                    <div class="product-page-thumb" data-src="{{ asset('storage/' . $galleryImage) }}">
                                        <img src="{{ asset('storage/' . $galleryImage) }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-page-info">
                        <h1>{{ $product->name }}</h1>

                        <!-- Rating (Static for now) -->
                        <div class="product-page-rating mb-3">
                            <div class="product-page-stars d-inline">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= 4 ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <span class="product-page-rating-text ms-2">4.8</span>
                            <span class="product-page-reviews-count">(324 reviews)</span>
                        </div>

                        <!-- Price -->
                        <div class="product-page-price mb-4">
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="product-page-current-price h3">₹{{ number_format($product->sale_price, 2) }}</span>
                                <span class="product-page-original-price ms-3 text-muted text-decoration-line-through">₹{{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="product-page-current-price h3">₹{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="product-page-description mb-4">
                            {{ $product->description ?: $product->short_description ?: 'No description available.' }}
                        </p>

                        <!-- Quantity Selector -->
                        <div class="product-page-quantity-selector d-flex align-items-center mb-4">
                            <label class="product-page-qty-label me-3 fw-bold">Quantity:</label>
                            <div class="product-page-qty-control d-flex align-items-center border rounded">
                                <button type="button" class="product-page-qty-btn border-0 bg-transparent px-3" onclick="updateQty(-1)">−</button>
                                <input type="number" id="quantityInput" name="quantity" class="product-page-qty-input border-0 text-center" value="1" min="1" readonly>
                                <button type="button" class="product-page-qty-btn border-0 bg-transparent px-3" onclick="updateQty(1)">+</button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="product-page-action-buttons d-flex gap-3 mb-4">
                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="quantity" id="cartQuantity" value="1">
                                <button type="submit" class="product-page-btn-add-cart btn btn-lg btn-primary d-flex align-items-center gap-2">
                                    <i class="fas fa-shopping-bag"></i>
                                    Add to Cart
                                </button>
                            </form>

                            <!-- Wishlist Form -->
                            <form action="{{ route('wishlist.add', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="product-page-btn-wishlist btn btn-lg btn-outline-danger d-flex align-items-center gap-2">
                                    <i class="far fa-heart"></i>
                                    Add to Wishlist
                                </button>
                            </form>
                        </div>

                        <!-- Info Badges -->
                        <div class="product-page-info-badges d-flex gap-4">
                            <div class="product-page-info-badge d-flex align-items-center gap-2">
                                <span class="product-page-badge-icon"><i class="fas fa-leaf text-success"></i></span>
                                <span>100% Healthy Plant</span>
                            </div>
                            <div class="product-page-info-badge d-flex align-items-center gap-2">
                                <span class="product-page-badge-icon"><i class="fas fa-shield-alt text-primary"></i></span>
                                <span>30-Day Guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<section class="bg-light py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Related Products</h2>
            <a href="{{ route('products.index') }}" class="title-link">More <i class="fas fa-chevron-right"></i></a>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($relatedProducts as $relatedProduct)
                    <div class="swiper-slide">
                        <div class="product-card h-100 d-flex flex-column">
                            <div class="product-image-container position-relative">
                                <a href="{{ route('product.show', $relatedProduct->slug) }}">
                                    <img src="{{ $relatedProduct->image ? asset('storage/' . $relatedProduct->image) : asset('assets/images/product/product1.jpg') }}"
                                         alt="{{ $relatedProduct->name }}"
                                         class="product-image main-image w-100 h-100 object-fit-cover">
                                    <img src="{{ $relatedProduct->image ? asset('storage/' . $relatedProduct->image) : asset('assets/images/product/product1.jpg') }}"
                                         alt="{{ $relatedProduct->name }}"
                                         class="product-image hover-image w-100 h-100 object-fit-cover">
                                    @if($relatedProduct->sale_price && $relatedProduct->sale_price < $relatedProduct->price)
                                        <span class="discount-badge">{{ round((($relatedProduct->price - $relatedProduct->sale_price) / $relatedProduct->price) * 100) }}% OFF</span>
                                    @endif
                                </a>
                            </div>
                            <div class="product-info mt-3 flex-grow-1 d-flex flex-column">
                                <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                                <div class="product-price mt-auto">
                                    @if($relatedProduct->sale_price && $relatedProduct->sale_price < $relatedProduct->price)
                                        <span class="original-price">₹{{ number_format($relatedProduct->price, 2) }}</span>
                                        <span class="current-price ms-2">₹{{ number_format($relatedProduct->sale_price, 2) }}</span>
                                    @else
                                        <span class="current-price">₹{{ number_format($relatedProduct->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="product-actions mt-3 d-flex gap-2">
                                    <form action="{{ route('cart.add', $relatedProduct) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-primary flex-fill">Add to Cart</button>
                                    </form>
                                    <form action="{{ route('wishlist.add', $relatedProduct) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide text-center py-5">
                        <p>No related products available</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gallery Thumbnail Click
        document.querySelectorAll('.product-page-thumb').forEach(thumb => {
            thumb.addEventListener('click', function () {
                document.querySelectorAll('.product-page-thumb').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const newSrc = this.getAttribute('data-src');
                document.getElementById('mainProductImage').src = newSrc;
            });
        });

        // Quantity Update
        window.updateQty = function(change) {
            const input = document.getElementById('quantityInput');
            let value = parseInt(input.value);
            value = value + change;
            if (value < 1) value = 1;
            input.value = value;
            document.getElementById('cartQuantity').value = value;
        };
    });
</script>

@include('view.layout.footer')