@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('home') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">Categories</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <!-- Side Menu for Categories with Filters -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="side-menu bg-white rounded shadow-sm p-3 sticky-top" style="top: 20px; z-index: 1; border: 1px solid #ddd;">
                    <h2 class="side-menu-title mb-3">Filters</h2>
                    
                    <!-- Price Range Filter -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">
                            Price Range
                            <span class="price-range-value" id="display-price-range">₹0 - ₹5000</span>
                        </h3>
                        <div class="filter-options d-flex align-items-center">
                            <input type="range" class="form-range flex-grow-1 me-2" min="0" max="10000" step="100" id="price-max" value="5000" style="width: 100%;">
                        </div>
                    </div>
                    
                    <!-- Discount Filter -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Discount</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="radio" name="discount" id="discount-all" class="filter-radio" value="all" checked>
                                <label for="discount-all" class="filter-label">
                                    All Discounts
                                    <span class="filter-count">(45)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="discount" id="discount-50" class="filter-radio" value="50">
                                <label for="discount-50" class="filter-label">
                                    50% and above
                                    <span class="filter-count">(8)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="discount" id="discount-30" class="filter-radio" value="30-50">
                                <label for="discount-30" class="filter-label">
                                    30% - 50%
                                    <span class="filter-count">(12)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="discount" id="discount-10" class="filter-radio" value="10-30">
                                <label for="discount-10" class="filter-label">
                                    10% - 30%
                                    <span class="filter-count">(18)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="discount" id="discount-below10" class="filter-radio" value="below10">
                                <label for="discount-below10" class="filter-label">
                                    Below 10%
                                    <span class="filter-count">(7)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Weight Filter -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Weight</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="checkbox" id="weight-100g" class="filter-checkbox" value="100g">
                                <label for="weight-100g" class="filter-label">
                                    Up to 100g
                                    <span class="filter-count">(6)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="weight-500g" class="filter-checkbox" value="500g">
                                <label for="weight-500g" class="filter-label">
                                    100g - 500g
                                    <span class="filter-count">(12)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="weight-1kg" class="filter-checkbox" value="1kg">
                                <label for="weight-1kg" class="filter-label">
                                    500g - 1kg
                                    <span class="filter-count">(15)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="weight-5kg" class="filter-checkbox" value="5kg">
                                <label for="weight-5kg" class="filter-label">
                                    1kg - 5kg
                                    <span class="filter-count">(8)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="weight-above5kg" class="filter-checkbox" value="above5kg">
                                <label for="weight-above5kg" class="filter-label">
                                    Above 5kg
                                    <span class="filter-count">(4)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Brand</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="checkbox" id="brand-organic" class="filter-checkbox" value="Organic Harvest">
                                <label for="brand-organic" class="filter-label">
                                    Organic Harvest
                                    <span class="filter-count">(10)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="brand-garden" class="filter-checkbox" value="Garden Pro">
                                <label for="brand-garden" class="filter-label">
                                    Garden Pro
                                    <span class="filter-count">(8)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="brand-green" class="filter-checkbox" value="Green Thumb">
                                <label for="brand-green" class="filter-label">
                                    Green Thumb
                                    <span class="filter-count">(12)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="brand-natural" class="filter-checkbox" value="Natural Growth">
                                <label for="brand-natural" class="filter-label">
                                    Natural Growth
                                    <span class="filter-count">(6)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="brand-premium" class="filter-checkbox" value="Premium Plant">
                                <label for="brand-premium" class="filter-label">
                                    Premium Plant
                                    <span class="filter-count">(9)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Ratings -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Customer Ratings</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="radio" name="rating" id="rating-4" class="filter-radio" value="4">
                                <label for="rating-4" class="filter-label">
                                    <span class="stars">
                                        ★★★★☆ & above
                                    </span>
                                    <span class="filter-count">(20)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="rating" id="rating-3" class="filter-radio" value="3">
                                <label for="rating-3" class="filter-label">
                                    <span class="stars">
                                        ★★★☆☆ & above
                                    </span>
                                    <span class="filter-count">(30)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="rating" id="rating-2" class="filter-radio" value="2">
                                <label for="rating-2" class="filter-label">
                                    <span class="stars">
                                        ★★☆☆☆ & above
                                    </span>
                                    <span class="filter-count">(40)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Availability</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="checkbox" id="in-stock" class="filter-checkbox" value="in-stock" checked>
                                <label for="in-stock" class="filter-label">
                                    In Stock
                                    <span class="filter-count">(40)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="out-of-stock" class="filter-checkbox" value="out-of-stock">
                                <label for="out-of-stock" class="filter-label">
                                    Out of Stock
                                    <span class="filter-count">(5)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="fast-delivery" class="filter-checkbox" value="fast-delivery">
                                <label for="fast-delivery" class="filter-label">
                                    Fast Delivery
                                    <span class="filter-count">(25)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Sort By</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="radio" name="sort" id="sort-popular" class="filter-radio" value="popularity" checked>
                                <label for="sort-popular" class="filter-label">Popularity</label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="sort" id="sort-price-low" class="filter-radio" value="price-low">
                                <label for="sort-price-low" class="filter-label">Price: Low to High</label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="sort" id="sort-price-high" class="filter-radio" value="price-high">
                                <label for="sort-price-high" class="filter-label">Price: High to Low</label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="sort" id="sort-new" class="filter-radio" value="newest">
                                <label for="sort-new" class="filter-label">Newest First</label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="sort" id="sort-discount" class="filter-radio" value="discount">
                                <label for="sort-discount" class="filter-label">Discount</label>
                            </div>
                            <div class="filter-item">
                                <input type="radio" name="sort" id="sort-rating" class="filter-radio" value="rating">
                                <label for="sort-rating" class="filter-label">Customer Rating</label>
                            </div>
                        </div>
                    </div>

                    <!-- Value Filter (Best Value, Premium, etc.) -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Value</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="checkbox" id="value-best" class="filter-checkbox" value="best">
                                <label for="value-best" class="filter-label">
                                    Best Value
                                    <span class="filter-count">(15)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="value-premium" class="filter-checkbox" value="premium">
                                <label for="value-premium" class="filter-label">
                                    Premium
                                    <span class="filter-count">(10)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="value-budget" class="filter-checkbox" value="budget">
                                <label for="value-budget" class="filter-label">
                                    Budget Friendly
                                    <span class="filter-count">(20)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Options -->
                    <div class="filter-section active mb-3">
                        <h3 class="filter-title d-flex justify-content-between align-items-center mb-2">Delivery Options</h3>
                        <div class="filter-options">
                            <div class="filter-item">
                                <input type="checkbox" id="delivery-free" class="filter-checkbox" value="free-delivery">
                                <label for="delivery-free" class="filter-label">
                                    Free Delivery
                                    <span class="filter-count">(35)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="delivery-same-day" class="filter-checkbox" value="same-day">
                                <label for="delivery-same-day" class="filter-label">
                                    Same Day Delivery
                                    <span class="filter-count">(12)</span>
                                </label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" id="delivery-next-day" class="filter-checkbox" value="next-day">
                                <label for="delivery-next-day" class="filter-label">
                                    Next Day Delivery
                                    <span class="filter-count">(28)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="filter-actions d-flex gap-2 mt-3">
                        <button class="btn-filter btn-apply flex-fill" id="apply-filters" type="button">Apply Filters</button>
                        <button class="btn-filter btn-reset flex-fill" id="reset-filters" type="button">Reset All</button>
                    </div>

                    <!-- Active Filters Display -->
                    <div class="active-filters mt-3 d-none" id="active-filters">
                        <h4 class="mb-2">Active Filters:</h4>
                        <div class="d-flex flex-wrap gap-2" id="active-filters-list">
                            <!-- Active filters will be added here dynamically -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Display Area -->
            <div class="col-lg-9 col-md-8">
                <div class="products-area">
                    <div class="products-header bg-white rounded p-3 mb-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h2 class="category-name mb-2 mb-md-0">{{ isset($category) ? $category->name : 'All Categories' }}</h2>

                            <div class="sort-options">
                                <select id="sort-products" class="form-select">
                                    <option value="default">Sort by: Default</option>
                                    <option value="name-asc">Name: A to Z</option>
                                    <option value="name-desc">Name: Z to A</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="products-grid row g-3" id="products-container">
                        @if(isset($category) && isset($products))
                            @forelse($products as $product)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                                <div class="product-card">
                                    <div class="product-image-container">
                                        <a href="{{ route('product.show', $product->slug) }}">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                    class="product-image main-image">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                    class="product-image hover-image">
                                            @else
                                                <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}"
                                                    class="product-image main-image">
                                                <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}"
                                                    class="product-image hover-image">
                                            @endif
                                            @if($product->sale_price && $product->discount_percentage > 0)
                                                <span class="discount-badge">{{ $product->discount_percentage }}% OFF</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        <div class="product-price">
                                            @if($product->sale_price)
                                                <span class="original-price">₹{{ number_format($product->price, 2) }}</span>
                                                <span class="current-price">₹{{ number_format($product->sale_price, 2) }}</span>
                                            @else
                                                <span class="current-price">₹{{ number_format($product->price, 2) }}</span>
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
                            <div class="col-12">
                                <p class="text-center">No products found in this category.</p>
                            </div>
                            @endforelse
                            @if(isset($products) && method_exists($products, 'links'))
                            <div class="col-12 mt-4">
                                {{ $products->links() }}
                            </div>
                            @endif
                        @else
                            @forelse($categories as $cat)
                                @if($cat->products && $cat->products->count() > 0)
                                    @foreach($cat->products->take(12) as $product)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                                        <div class="product-card">
                                            <div class="product-image-container">
                                                <a href="{{ route('product.show', $product->slug) }}">
                                                    @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                            class="product-image main-image">
                                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                            class="product-image hover-image">
                                                    @else
                                                        <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}"
                                                            class="product-image main-image">
                                                        <img src="{{ asset('assets/images/product/product1.jpg') }}" alt="{{ $product->name }}"
                                                            class="product-image hover-image">
                                                    @endif
                                                    @if($product->sale_price && $product->discount_percentage > 0)
                                                        <span class="discount-badge">{{ $product->discount_percentage }}% OFF</span>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title">{{ $product->name }}</h3>
                                                <div class="product-price">
                                                    @if($product->sale_price)
                                                        <span class="original-price">₹{{ number_format($product->price, 2) }}</span>
                                                        <span class="current-price">₹{{ number_format($product->sale_price, 2) }}</span>
                                                    @else
                                                        <span class="current-price">₹{{ number_format($product->price, 2) }}</span>
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
                                    @endforeach
                                @endif
                            @empty
                            <div class="col-12">
                                <p class="text-center">No categories or products found.</p>
                            </div>
                            @endforelse
                        @endif

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="product-card">
                                <div class="product-image-container">
                                    <a href="">
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

                        <!-- Add remaining 8 product cards with similar structure -->
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="product-card">
                                <div class="product-image-container"><img
                                        src="{{ asset('assets/images/product/product3.jpg') }}" alt="cocopeat"
                                        class="product-image main-image"><img
                                        src="{{ asset('assets/images/product/product3.jpg') }}" alt="cocopeat"
                                        class="product-image hover-image"><span class="discount-badge">5% OFF</span></div>
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


                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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

                        <!-- Add remaining 8 product cards with similar structure -->
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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



                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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

                        <!-- Add remaining 8 product cards with similar structure -->
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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


                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
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

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="product-card">
                                <div class="product-image-container"><img
                                        src="{{ asset('assets/images/product/product10.jpg') }}"
                                        alt="pruner" class="product-image main-image"><img
                                        src="{{ asset('assets/images/product/product10.jpg') }}"
                                        alt="pruner" class="product-image hover-image"><span class="discount-badge">12%
                                        OFF</span></div>
                                <div class="product-info">
                                    <h3 class="product-title">Professional Pruner</h3>
                                    <div class="product-price"><span class="original-price">₹850.00</span><span
                                            class="current-price">₹750.00</span></div>
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

                        <!-- Add remaining 8 product cards with similar structure -->
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="product-card">
                                <div class="product-image-container"><img
                                        src="{{ asset('assets/images/product/product9.jpg') }}"
                                        alt="spade" class="product-image main-image"><img
                                        src="{{ asset('assets/images/product/product9.jpg') }}"
                                        alt="spade" class="product-image hover-image"></div>
                                <div class="product-info">
                                    <h3 class="product-title">Garden Spade</h3>
                                    <div class="product-price"><span class="current-price">₹599.00</span></div>
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

                        <!-- Continue with remaining 7 products following the same pattern -->
                        <!-- ... -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const applyFiltersBtn = document.getElementById('apply-filters');
        const resetFiltersBtn = document.getElementById('reset-filters');
        const checkboxes = document.querySelectorAll('.filter-checkbox');

        // Apply filters
        applyFiltersBtn.addEventListener('click', function() {
            const selectedFilters = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const label = checkbox.nextElementSibling.textContent.trim();
                    selectedFilters.push(label);
                }
            });

            if (selectedFilters.length > 0) {
                console.log('Applied filters:', selectedFilters);
                alert(`Filters applied: ₹{selectedFilters.join(', ')}`);
            } else {
                alert('Please select at least one filter');
            }
        });

        // Reset filters
        resetFiltersBtn.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            document.getElementById('cat-garden').checked = true;
            console.log('Filters reset');
        });

        // Product actions functionality
        document.querySelectorAll('.btn-secondary').forEach(button => {
            button.addEventListener('click', function() {
                const product = this.closest('.product-card').querySelector('.product-title').textContent;
                alert(`₹{product} added to cart!`);
            });
        });

        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function() {
                const product = this.closest('.product-card').querySelector('.product-title').textContent;
                alert(`Buying now: ₹{product}`);
            });
        });

        document.querySelectorAll('.btn-wishlist').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                const product = this.closest('.product-card').querySelector('.product-title').textContent;

                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    icon.style.color = '#e53e3e';
                    alert(`₹{product} added to wishlist!`);
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    icon.style.color = '';
                    alert(`₹{product} removed from wishlist!`);
                }
            });
        });

        // Sort functionality
        document.getElementById('sort-products').addEventListener('change', function() {
            console.log(`Sorting by: ₹{this.value}`);
        });

        // Collapsible filter sections
        document.querySelectorAll('.filter-title').forEach(title => {
            title.addEventListener('click', function() {
                const section = this.parentElement;
                section.classList.toggle('active');
            });
        });
    });
</script>

@include('view.layout.footer')