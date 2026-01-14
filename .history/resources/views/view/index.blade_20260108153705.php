{{-- DO NOT add or use PHP namespace or use statements in Blade templates --}}
{{-- Instead of `use Illuminate\Support\Str;`, call Str methods via the global helper/class --}}

@include('view.layout.header')

<section class="plant-categories-section">
    <div class="plant-categories-container">
        <div class="categories-carousel-container">
            <!-- Carousel Navigation Buttons (Disabled) -->
            <!-- 
            <button class="carousel-btn carousel-btn-prev" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-btn carousel-btn-next" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button> 
            -->
            <!-- Carousel -->
            <div class="plant-categories-carousel" id="plantCategoriesCarousel">
                @forelse($categories as $category)
                    <div class="plant-category-item">
                        <a href="{{ route('category.show', $category->slug) }}" class="plant-category-card">
                            <div class="category-image-container">
                                @if($category->badge_type)
                                    <span class="category-badge badge-{{ $category->badge_type }}">{{ \Illuminate\Support\Str::upper($category->badge_type) }}</span>
                                @endif
                                <div class="plant-category-image">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="{{ $category->name }}">
                                    @endif
                                </div>
                            </div>
                            <div class="plant-category-content">
                                <h3 class="plant-category-name">{{ $category->name }}</h3>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="plant-category-item">
                        <p class="text-center">No categories available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- vertical menu and slider -->
<div id="home_vertical_menu" class="menu_slider ">
    <div class="row ">
        <!-- col-md-3 vertical_menu -->
        <div class="col-lg-12 col-md-12 main_slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                @if($sliders->count() > 0)
                <ol class="carousel-indicators">
                    @foreach($sliders as $index => $slider)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($sliders as $index => $slider)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100 img-fluid" alt="{{ $slider->title }}">
                        <div class="carousel-caption container silder_text">
                            @if($slider->subtitle)
                                <p class="arrival">{{ $slider->subtitle }}</p>
                            @endif
                            @if($slider->title)
                                <h5 class="headding">{{ $slider->title }}</h5>
                            @endif
                            @if($slider->button_text && $slider->button_link)
                                <a href="{{ $slider->button_link }}" type="btn" class="shop-now">{{ $slider->button_text }}</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('uploads/img2/slider/11.png') }}" class="d-block w-100 img-fluid" alt="Default">
                        <div class="carousel-caption container silder_text">
                            <p class="arrival">Complete Care for Every Plant</p>
                            <h5 class="headding">From Soil to<br>Bloom Naturally</h5>
                            <a type="btn" class="shop-now">Shop Now</a>
                        </div>
                    </div>
                </div>
                @endif
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"></a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"></a>
            </div>
        </div>
        <!-- col-md-9 main_slider -->
    </div>
    <!-- row -->
</div>
<!-- vertical menu and slider end -->

<!-- services -->
<div class="container-fluid">
    <div class="main_services">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 m_service ">
                <ul class="bg-white service service-1 rounded text-center  animate__animated animate__fadeInUp"
                    data-wow-duration="0.8s" data-wow-delay="0.1s">
                    <li class="ser-svg d-lg-inline-block d-md-block  align-middle">
                        <span class="icon-image"></span>
                    </li>
                    <li class="ser-t d-lg-inline-block d-md-block  align-middle text-left">
                        <h6>Fast Delivery</h6>
                        <span class="mb-0 text-muted">Fast shipping on all orders</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-2 rounded text-center  animate__animated animate__fadeInUp"
                    data-wow-duration="0.8s" data-wow-delay="0.2s">
                    <li class="ser-svg d-lg-inline-block d-md-block align-middle">
                        <span class="icon-image"></span>
                    </li>
                    <li class="ser-t d-lg-inline-block d-md-block align-middle text-left">
                        <h6>secure payment</h6>
                        <span class="mb-0 text-muted">100% Secure Payment</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-3 rounded text-center  animate__animated animate__fadeInUp"
                    data-wow-duration="0.8s" data-wow-delay="0.3s">
                    <li class="ser-svg d-lg-inline-block d-md-block align-middle">
                        <span class="icon-image"></span>
                    </li>
                    <li class="ser-t d-lg-inline-block d-md-block align-middle  text-left">
                        <h6>Easy Returns</h6>
                        <span class="mb-0 text-muted">30-Day Return Policy</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-4 rounded text-center  animate__animated animate__fadeInUp"
                    data-wow-duration="0.8s" data-wow-delay="0.4s">
                    <li class="ser-svg d-lg-inline-block d-md-block align-middle">
                        <span class="icon-image"></span>
                    </li>
                    <li class="ser-t d-lg-inline-block d-md-block align-middle  text-left">
                        <h6>Quality Guarantee</h6>
                        <span class="mb-0 text-muted">Premium Quality Products</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- main_services -->
</div>
<!-- services end -->

<!-- Section 1: New Arrivals (Add to Cart Button Functional) -->
<section class="bg-white-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>New Arrivals</h2>
            <div class="title-link">
                <a href="{{ url('categories') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($newArrivals as $product)
                <div class="swiper-slide">
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
                                    <span class="btn-text">Buy Now</span>
                                    <i class="btn-icon fas fa-shopping-bag"></i>
                                </button>
                                <form class="add-to-cart-form d-inline-block" method="POST" action="{{ route('cart.add', $product->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" data-tooltip="Add to Cart">
                                        <span class="btn-text">Add to Cart</span>
                                        <i class="btn-icon fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                                <button class="btn btn-wishlist" data-tooltip="Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="swiper-slide">
                    <p class="text-center">No products available</p>
                </div>
                @endforelse

                <!-- Example Static Products, not editable at this time. -->
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
                            <div class="product-actions">
                                <button class="btn btn-primary" data-tooltip="Buy Now">
                                    <span class="btn-text">Buy Now</span>
                                    <i class="btn-icon fas fa-shopping-bag"></i>
                                </button>
                                <button class="btn btn-secondary" data-tooltip="Add to Cart">
                                    <span class="btn-text">Add to Cart</span>
                                    <i class="btn-icon fas fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-wishlist" data-tooltip="Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ... other static products ... -->
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container">
                            <a href="">
                                <img src="{{ asset('assets/images/product/product3.jpg') }}" alt="cocopeat"
                                    class="product-image main-image">
                                <img src="{{ asset('assets/images/product/product3.jpg') }}" alt="cocopeat"
                                    class="product-image hover-image">
                                <span class="discount-badge">5% OFF</span>
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Cocopeat</h3>
                            <div class="product-price"><span class="original-price">₹370.00</span><span
                                    class="current-price">₹350.00</span></div>
                            <div class="product-actions">
                                <button class="btn btn-primary" data-tooltip="Buy Now"><span class="btn-text">Buy Now</span>
                                    <i class="btn-icon fas fa-shopping-bag"></i></button>
                                <button class="btn btn-secondary" data-tooltip="Add to Cart"><span class="btn-text">Add
                                        to Cart</span><i class="btn-icon fas fa-shopping-cart"></i></button>
                                <button class="btn btn-wishlist" data-tooltip="Wishlist"><i
                                        class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ... more static product slides can be here ... -->
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Section 2: Garden Products -->
<section class="bg-light-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Garden Products</h2>
            <div class="title-link">
                <a href="{{ route('products.index') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
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
                <!-- ... rest of the static "Garden Products" slides unchanged ... -->
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Other sections unchanged, keep as before -->
<section class="ad-banner">
    <div class="banner-content">
        <h1 class="big-title">Fresh Plant-Based Goodness</h1>
        <p class="small-title">Discover our organic, sustainable products for a healthier lifestyle</p>
        <a href="#" class="contact-btn">Shop Now <i class="fas fa-leaf"></i></a>
    </div>
</section>
@include('view.layout.footer')

<!-- Show notification after Add to Cart (shows Bootstrap alert for 2s) -->
<div id="cart-alert-container" style="position: fixed; z-index: 99999; left: 50%; transform: translateX(-50%); top: 20px; display: none;">
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="cart-added-alert" style="min-width: 250px;">
        Product added to cart!
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            setTimeout(function() {
                var alertContainer = document.getElementById('cart-alert-container');
                if (alertContainer) {
                    alertContainer.style.display = 'block';
                    setTimeout(function() {
                        alertContainer.style.display = 'none';
                    }, 2000);
                }
            }, 200);
        });
    });
});
</script>