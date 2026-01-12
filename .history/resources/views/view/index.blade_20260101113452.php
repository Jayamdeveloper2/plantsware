@php
use Illuminate\Support\Str;
@endphp

@include('view.layout.header')

<!-- Categories Carousel -->
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
                    <p class="text-center w-100 py-5">No categories available</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Hero Slider -->
<div id="home_vertical_menu" class="menu_slider">
    <div class="row">
        <div class="col-lg-12 main_slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                @if($sliders->count() > 0)
                    <ol class="carousel-indicators">
                        @foreach($sliders as $index => $slider)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($sliders as $index => $slider)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                                <div class="carousel-caption silder_text">
                                    @if($slider->subtitle)<p class="arrival">{{ $slider->subtitle }}</p>@endif
                                    @if($slider->title)<h5 class="headding">{{ $slider->title }}</h5>@endif
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
                            <img src="{{ asset('uploads/img2/slider/11.png') }}" class="d-block w-100" alt="Default Slider">
                            <div class="carousel-caption silder_text">
                                <p class="arrival">Complete Care for Every Plant</p>
                                <h5 class="headding">From Soil to Bloom Naturally</h5>
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

<!-- Services -->
<div class="container-fluid py-5 bg-light">
    <div class="main_services">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6">
                <div class="service p-4">
                    <i class="fas fa-truck fa-3x text-success mb-3"></i>
                    <h6>Fast Delivery</h6>
                    <p class="text-muted">Fast shipping on all orders</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service p-4">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h6>Secure Payment</h6>
                    <p class="text-muted">100% Secure Payment</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service p-4">
                    <i class="fas fa-undo fa-3x text-warning mb-3"></i>
                    <h6>Easy Returns</h6>
                    <p class="text-muted">30-Day Return Policy</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service p-4">
                    <i class="fas fa-award fa-3x text-info mb-3"></i>
                    <h6>Quality Guarantee</h6>
                    <p class="text-muted">Premium Quality Products</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Arrivals -->
<section class="bg-white-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>New Arrivals</h2>
            <a href="{{ route('products.index') }}" class="title-link">More →</a>
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

<!-- Garden Products -->
<section class="bg-light-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Garden Products</h2>
            <a href="{{ route('products.index') }}" class="title-link">More →</a>
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
            <a href="{{ route('products.index') }}" class="title-link">More →</a>
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
            <a href="{{ route('products.index') }}" class="title-link">More →</a>
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
<section class="ad-banner py-5 text-center text-white" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/images/banner.jpg') }}') center/cover;">
    <h1 class="big-title">Fresh Plant-Based Goodness</h1>
    <p class="small-title">Discover our organic, sustainable products for a healthier lifestyle</p>
    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg mt-3">Shop Now <i class="fas fa-leaf"></i></a>
</section>

<!-- Testimonials -->
<div class="reviews-carousel py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Trusted by thousands</h2>
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                @forelse($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="review-card p-4 bg-white rounded shadow-sm text-center">
                            <div class="star-rating mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <p class="review-content">{{ $testimonial->content }}</p>
                            <h5 class="reviewer-name mt-3">{{ $testimonial->name }}</h5>
                            @if($testimonial->is_verified)
                                <small class="text-success"><i class="fas fa-check-circle"></i> Verified Buyer</small>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide text-center">
                        <p>No testimonials yet</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Blogs -->
<section class="bg-white-section py-5">
    <div class="container-fluid px-4">
        <div class="section-title d-flex justify-content-between align-items-center mb-4">
            <h2>Latest Blogs</h2>
            <a href="{{ route('blog.index') }}" class="title-link">More →</a>
        </div>
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card h-100 shadow-sm">
                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/images/blog/default.jpg') }}" alt="{{ $blog->title }}" class="w-100" style="height:200px; object-fit:cover;">
                        <div class="p-4">
                            <small class="text-muted">{{ $blog->published_at?->format('M d, Y') }}</small>
                            <h5 class="mt-2">{{ $blog->title }}</h5>
                            <p class="text-muted">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link">Read More →</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No blogs available</p>
            @endforelse
        </div>
    </div>
</section>

@include('view.layout.footer')