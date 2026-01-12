@php
use Illuminate\Support\Str;
@endphp

@include('view.layout.header')

<!-- Categories Carousel Section -->
<section class="plant-categories-section">
    <div class="plant-categories-container">
        <div class="categories-carousel-container">
            <div class="plant-categories-carousel" id="plantCategoriesCarousel">
                @forelse($categories as $category)
                    <div class="plant-category-item">
                        <a href="{{ route('category.show', $category->slug) }}" class="plant-category-card">
                            <div class="category-image-container">
                                @if($category->badge_type)
                                    <span class="category-badge badge-{{ $category->badge_type }}">
                                        {{ strtoupper($category->badge_type) }}
                                    </span>
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
                    <div class="plant-category-item text-center py-5">
                        <p>No categories available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Hero Slider -->
<div id="home_vertical_menu" class="menu_slider">
    <div class="row">
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
                                        <a href="{{ $slider->button_link }}" class="shop-now">{{ $slider->button_text }}</a>
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
                                <a class="shop-now">Shop Now</a>
                            </div>
                        </div>
                    </div>
                @endif
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"></a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"></a>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="container-fluid">
    <div class="main_services py-5">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-1 rounded text-center p-4 shadow-sm">
                    <li class="ser-svg"><span class="icon-image"></span></li>
                    <li class="ser-t">
                        <h6>Fast Delivery</h6>
                        <span class="text-muted">Fast shipping on all orders</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-2 rounded text-center p-4 shadow-sm">
                    <li class="ser-svg"><span class="icon-image"></span></li>
                    <li class="ser-t">
                        <h6>Secure Payment</h6>
                        <span class="text-muted">100% Secure Payment</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-3 rounded text-center p-4 shadow-sm">
                    <li class="ser-svg"><span class="icon-image"></span></li>
                    <li class="ser-t">
                        <h6>Easy Returns</h6>
                        <span class="text-muted">30-Day Return Policy</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-12 m_service">
                <ul class="bg-white service service-4 rounded text-center p-4 shadow-sm">
                    <li class="ser-svg"><span class="icon-image"></span></li>
                    <li class="ser-t">
                        <h6>Quality Guarantee</h6>
                        <span class="text-muted">Premium Quality Products</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- New Arrivals Section -->
<section class="bg-white-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>New Arrivals</h2>
            <a href="{{ route('products.index') }}" class="title-link">More <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($newArrivals as $product)
                    <div class="swiper-slide">
                        @include('frontend.partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="swiper-slide text-center py-5">
                        <p>No new arrivals</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Garden Products Section -->
<section class="bg-light-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Garden Products</h2>
            <a href="{{ route('products.index') }}" class="title-link">More <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($gardenProducts as $product)
                    <div class="swiper-slide">
                        @include('frontend.partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="swiper-slide text-center py-5">
                        <p>No garden products</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Planted Aquarium Products -->
<section class="bg-white-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Planted Aquarium Products</h2>
            <a href="{{ route('products.index') }}" class="title-link">More <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($aquariumProducts as $product)
                    <div class="swiper-slide">
                        @include('frontend.partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="swiper-slide text-center py-5">
                        <p>No aquarium products</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Natural Products -->
<section class="bg-light-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Natural Products</h2>
            <a href="{{ route('products.index') }}" class="title-link">More <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @forelse($naturalProducts as $product)
                    <div class="swiper-slide">
                        @include('frontend.partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="swiper-slide text-center py-5">
                        <p>No natural products</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Banner -->
<section class="ad-banner py-5 text-white text-center">
    <div class="banner-content">
        <h1 class="big-title">Fresh Plant-Based Goodness</h1>
        <p class="small-title">Discover our organic, sustainable products for a healthier lifestyle</p>
        <a href="{{ route('products.index') }}" class="contact-btn btn btn-light btn-lg">Shop Now <i class="fas fa-leaf"></i></a>
    </div>
</section>

<!-- Testimonials -->
<div class="reviews-carousel py-5 bg-light">
    <div class="container">
        <div class="carousel-header text-center mb-4">
            <h2 class="section-title1">Trusted by thousands</h2>
            <a href="#" class="see-more">See more reviews</a>
        </div>
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                @forelse($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="review-card p-4 bg-white shadow-sm rounded">
                            <div class="reviewer-info d-flex align-items-center mb-3">
                                <div class="reviewer-name fw-bold">{{ $testimonial->name }}</div>
                                @if($testimonial->is_verified)
                                    <div class="verified-badge ms-3">
                                        <i class="fas fa-badge-check text-success"></i>
                                        <span>Verified Buyer</span>
                                    </div>
                                @endif
                            </div>
                            <div class="review-date mb-2 text-muted">
                                {{ $testimonial->date ? $testimonial->date->format('m/d/y') : $testimonial->created_at->format('m/d/y') }}
                            </div>
                            <div class="star-rating mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            @if($testimonial->title)
                                <h3 class="review-title h5">{{ $testimonial->title }}</h3>
                            @endif
                            <p class="review-content">{{ $testimonial->content }}</p>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide text-center py-5">
                        <p>No testimonials yet</p>
                    </div>
                @endforelse
            </div>
            <div class="carousel-nav d-flex justify-content-center mt-4 gap-3">
                <div class="nav-btn swiper-button-prev1"><i class="fas fa-chevron-left"></i></div>
                <div class="nav-btn swiper-button-next1"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Blogs Section -->
<section class="bg-white-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Latest Blogs</h2>
            <a href="{{ route('blog.index') }}" class="title-link">More <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card h-100 d-flex flex-column shadow-sm">
                        <div class="blog-card-image position-relative">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-100">
                            @else
                                <img src="{{ asset('assets/images/product/product11.jpg') }}" alt="{{ $blog->title }}" class="w-100">
                            @endif
                            @if($blog->category)
                                <span class="blog-card-category">{{ $blog->category->name }}</span>
                            @endif
                        </div>
                        <div class="blog-card-content p-4 flex-grow-1 d-flex flex-column">
                            <div class="blog-card-date text-muted mb-2">
                                {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                            </div>
                            <h3 class="blog-card-title h5 mb-3">{{ $blog->title }}</h3>
                            <p class="blog-card-excerpt text-muted flex-grow-1">
                                {{ $blog->excerpt ?: Str::limit(strip_tags($blog->content), 150) }}
                            </p>
                            <div class="blog-card-footer mt-auto d-flex justify-content-between align-items-center">
                                <span class="blog-card-author text-muted">{{ $blog->author_name ?? 'Admin' }}</span>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link">Read →</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>No blogs available</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@include('view.layout.footer')