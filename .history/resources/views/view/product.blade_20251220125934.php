@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('home') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    @if($product->category)
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('category.show', $product->category->slug) }}" class="text-decoration-none">{{ $product->category->name }}</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    @endif
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">{{ $product->name }}</a></li>
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
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}">
                            @endif
                            @if($product->sale_price && $product->discount_percentage > 0)
                                <span class="product-page-badge-sale">-{{ $product->discount_percentage }}% OFF</span>
                            @endif
                        </div>
                        <div class="product-page-gallery-thumbs">
                            @if($product->image)
                            <div class="product-page-thumb active">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>
                            @endif
                            @if($product->gallery_images && count($product->gallery_images) > 0)
                                @foreach($product->gallery_images as $galleryImage)
                                <div class="product-page-thumb">
                                    <img src="{{ asset('storage/' . $galleryImage) }}" alt="{{ $product->name }}">
                                </div>
                                @endforeach
                            @else
                                @for($i = 2; $i <= 4; $i++)
                                <div class="product-page-thumb">
                                    <img src="{{ asset('assets/images/product/product' . $i . '.jpg') }}" alt="View {{ $i }}">
                                </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-page-info">
                        <h1>{{ $product->name }}</h1>

                        <!-- Rating -->
                        <div class="product-page-rating">
                            <div class="product-page-stars">
                                <span class="product-page-star"><i class="fas fa-star"></i></span>
                                <span class="product-page-star"><i class="fas fa-star"></i></span>
                                <span class="product-page-star"><i class="fas fa-star"></i></span>
                                <span class="product-page-star"><i class="fas fa-star"></i></span>
                                <span class="product-page-star"><i class="fas fa-star-half-alt"></i></span>
                            </div>
                            <span class="product-page-rating-text">4.8</span>
                            <span class="product-page-reviews-count">(324 reviews)</span>
                        </div>

                        <!-- Price -->
                        <div class="product-page-price">
                            @if($product->sale_price)
                                <span class="product-page-current-price">₹{{ number_format($product->sale_price, 2) }}</span>
                                <span class="product-page-original-price">₹{{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="product-page-current-price">₹{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="product-page-description">
                            {{ $product->description ?: $product->short_description }}
                        </p>

                        <!-- Size Option -->
                        <!-- <div class="product-page-option-group">
                            <label class="product-page-option-label">Size:</label>
                            <div class="product-page-option-values">
                                <button class="product-page-option-btn product-page-size-option">Small</button>
                                <button class="product-page-option-btn product-page-size-option active">Medium</button>
                                <button class="product-page-option-btn product-page-size-option">Large</button>
                                <button class="product-page-option-btn product-page-size-option">Extra Large</button>
                            </div>
                        </div> -->

                        <!-- Pot Color Option -->
                        <!-- <div class="product-page-option-group">
                            <label class="product-page-option-label">Pot Color:</label>
                            <div class="product-page-option-values">
                                <button class="product-page-option-btn active">White</button>
                                <button class="product-page-option-btn">Black</button>
                                <button class="product-page-option-btn">Terracotta</button>
                                <button class="product-page-option-btn">Gray</button>
                            </div>
                        </div> -->

                        <!-- Quantity Selector -->
                        <div class="product-page-quantity-selector d-flex align-items-center">
                            <label class="product-page-qty-label me-2">Quantity:</label>

                            <div class="product-page-qty-control d-flex align-items-center">
                                <button class="product-page-qty-btn">−</button>
                                <input type="text" class="product-page-qty-input" value="1">
                                <button class="product-page-qty-btn">+</button>
                            </div>

                            <!-- Wishlist Icon -->
                            <button class="wishlist-btn ms-3">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <!-- Action Buttons -->
                        <div class="product-page-action-buttons">
                            <button class="product-page-btn-add-cart">
                                <i class="fas fa-shopping-bag"></i>
                                Add to Cart
                            </button>
                            <button class="product-page-btn-wishlist">
                                Buy Now
                            </button>
                        </div>

                        <!-- Info Badges -->
                        <div class="product-page-info-badges">
                            <div class="product-page-info-badge">
                                <span class="product-page-badge-icon"><i class="fas fa-leaf"></i></span>
                                <span>100% Healthy Plant</span>
                            </div>
                            <div class="product-page-info-badge">
                                <span class="product-page-badge-icon"><i class="fas fa-shield-alt"></i></span>
                                <span>30-Day Guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<section class="bg-white-section">
    <!-- Changed to container-fluid for full width -->
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Related Products</h2>
            <div class="title-link">
                <a href="{{ url('categories') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($relatedProducts as $relatedProduct)
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container">
                            <a href="{{ route('product.show', $relatedProduct->slug) }}">
                                @if($relatedProduct->image)
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                                        class="product-image main-image">
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                                        class="product-image hover-image">
                                @else
                                    <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $relatedProduct->name }}"
                                        class="product-image main-image">
                                    <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $relatedProduct->name }}"
                                        class="product-image hover-image">
                                @endif
                                @if($relatedProduct->sale_price && $relatedProduct->discount_percentage > 0)
                                    <span class="discount-badge">{{ $relatedProduct->discount_percentage }}% OFF</span>
                                @endif
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                            <div class="product-price">
                                @if($relatedProduct->sale_price)
                                    <span class="original-price">₹{{ number_format($relatedProduct->price, 2) }}</span>
                                    <span class="current-price">₹{{ number_format($relatedProduct->sale_price, 2) }}</span>
                                @else
                                    <span class="current-price">₹{{ number_format($relatedProduct->price, 2) }}</span>
                                @endif
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-primary" data-tooltip="Buy Now">
                                    <span class="btn-text">Buy Now</span><i class="btn-icon fas fa-shopping-bag"></i>
                                </button>
                                <button class="btn btn-secondary" data-tooltip="Add to Cart">
                                    <span class="btn-text">Add to Cart</span><i class="btn-icon fas fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-wishlist" data-tooltip="Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="swiper-slide">
                    <p class="text-center">No related products available</p>
                </div>
                @endforelse

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container">
                            <a href="{{ url('product') }}">
                                <img
                                    src="{{ asset('assets/images/product/product2.jpg') }}"
                                    alt="vermiculite" class="product-image main-image">
                                <img
                                    src="{{ asset('assets/images/product/product2.jpg') }}"
                                    alt="vermiculite" class="product-image hover-image">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Vermiculite</h3>
                            <div class="product-price"><span class="current-price">₹699.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container">
                            <a href="">
                                <img
                                    src="{{ asset('assets/images/product/product3.jpg') }}" alt="cocopeat"
                                    class="product-image main-image"><img
                                    src="{{ asset('assets/images/product/product3.jpg') }}" alt="cocopeat"
                                    class="product-image hover-image"><span class="discount-badge">5% OFF</span>
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Cocopeat</h3>
                            <div class="product-price"><span class="original-price">₹370.00</span><span
                                    class="current-price">₹350.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product4.jpg') }}"
                                alt="cocohusk" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product4.jpg') }}"
                                alt="cocohusk" class="product-image hover-image"><span class="discount-badge">10%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Coco Husk</h3>
                            <div class="product-price"><span class="original-price">₹299.00</span><span
                                    class="current-price">₹269.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product5.jpg') }}"
                                alt="clayballs" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product5.jpg') }}"
                                alt="clayballs" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">LECA Clay Balls</h3>
                            <div class="product-price"><span class="current-price">₹4,000.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product6.jpg') }}"
                                alt="vermicompost" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product6.jpg') }}"
                                alt="vermicompost" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Vermicompost</h3>
                            <div class="product-price"><span class="current-price">₹499.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product7.jpg') }}"
                                alt="pottingmix" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product7.jpg') }}"
                                alt="pottingmix" class="product-image hover-image"><span class="discount-badge">15%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Premium Potting Mix</h3>
                            <div class="product-price"><span class="original-price">₹650.00</span><span
                                    class="current-price">₹550.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product8.jpg') }}"
                                alt="gardentools" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product8.jpg') }}"
                                alt="gardentools" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Gardening Tool Set</h3>
                            <div class="product-price"><span class="current-price">₹1,299.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product9.jpg') }}"
                                alt="plantfood" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product9.jpg') }}"
                                alt="plantfood" class="product-image hover-image"><span class="discount-badge">20%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Organic Plant Food</h3>
                            <div class="product-price"><span class="original-price">₹450.00</span><span
                                    class="current-price">₹360.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product10.jpg') }}"
                                alt="growbags" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product10.jpg') }}"
                                alt="growbags" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Fabric Grow Bags</h3>
                            <div class="product-price"><span class="current-price">₹899.00</span></div>
                            <div class="product-actions"><button class="btn btn-primary"
                                    data-tooltip="Buy Now"><span class="btn-text">Buy Now</span><i
                                        class="btn-icon fas fa-shopping-bag"></i></button><button
                                    class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button><button
                                    class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
    </div>
</section>

<script>
    // Gallery Thumbnail Functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Thumbnail click handler
        document.querySelectorAll('.product-page-thumb').forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Remove active class from all thumbs
                document.querySelectorAll('.product-page-thumb').forEach(t => {
                    t.classList.remove('active');
                });
                // Add active class to clicked thumb
                this.classList.add('active');

                // Update main image (in real implementation, you'd change the src)
                const mainImage = document.querySelector('.product-page-gallery-main img');
                const thumbImage = this.querySelector('img');
                mainImage.src = thumbImage.src.replace('150', '500');
            });
        });

        // Option button click handler
        document.querySelectorAll('.product-page-option-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const parent = this.closest('.product-page-option-values');
                parent.querySelectorAll('.product-page-option-btn').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Quantity selector functionality
        const qtyInput = document.querySelector('.product-page-qty-input');
        document.querySelectorAll('.product-page-qty-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let currentValue = parseInt(qtyInput.value);
                if (this.textContent === '+') {
                    qtyInput.value = currentValue + 1;
                } else if (this.textContent === '−' && currentValue > 1) {
                    qtyInput.value = currentValue - 1;
                }
            });
        });

        // Add to cart functionality
        document.querySelector('.product-page-btn-add-cart').addEventListener('click', function() {
            const quantity = qtyInput.value;
            alert(`Added ₹{quantity} Monstera Deliciosa to cart!`);
        });

        // Wishlist functionality
        document.querySelector('.product-page-btn-wishlist').addEventListener('click', function() {
            alert('Added to wishlist!');
        });
    });
</script>

@include('view.layout.footer')