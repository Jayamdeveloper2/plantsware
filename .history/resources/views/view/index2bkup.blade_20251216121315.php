@include('view.layout.header')

<style>
    .index-2-plant-categories-carousel {
        background: #fff;
        padding: 15px;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef2f6;

    }

    .index2-categories-card{
        background: transparent;
        box-shadow: none;
        border: none;
    }

</style>

<section class="plant-categories-section px-0">
    <div class="plant-categories-container">

        <div class="categories-carousel-container ">
            <!-- Carousel Navigation Buttons -->
            <!-- <button class="carousel-btn carousel-btn-prev" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>

            <button class="carousel-btn carousel-btn-next" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button> -->

            <!-- Carousel -->
            <div class="plant-categories-carousel index-2-plant-categories-carousel" id="plantCategoriesCarousel">
                <!-- Category 1 -->
                <div class="plant-category-item">
                    <a href="#" class="plant-category-card index2-categories-card">
                        <div class="category-image-container">
                            <div class="plant-category-image">
                                <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Indoor Plants">
                            </div>
                        </div>
                        <div class="plant-category-content">
                            <h3 class="plant-category-name">Gardern Products</h3>
                        </div>
                    </a>
                </div>

                <!-- Category 2 -->
                <div class="plant-category-item">
                    <a href="#" class="plant-category-card index2-categories-card">
                        <div class="category-image-container">
                            <div class="plant-category-image">
                                <img src="https://images.unsplash.com/photo-1485955900006-10f4d324d411?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Succulent Plants">
                            </div>
                        </div>
                        <div class="plant-category-content">
                            <h3 class="plant-category-name">Planted Aquarium</h3>
                        </div>
                    </a>
                </div>

                <!-- Category 3 -->
                <div class="plant-category-item">
                    <a href="#" class="plant-category-card index2-categories-card">
                        <div class="category-image-container index2-category-image-container">
                            <div class="plant-category-image">
                                <img src="https://images.unsplash.com/photo-1463320898484-cdee8141c787?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Garden Plants">
                            </div>
                        </div>
                        <div class="plant-category-content">
                            <h3 class="plant-category-name">Natural Products</h3>
                        </div>
                    </a>
                </div>

                <!-- Category 4 -->
                <div class="plant-category-item">
                    <a href="#" class="plant-category-card index2-categories-card">
                        <div class="category-image-container">
                            <span class="category-badge badge-new">NEW</span>
                            <div class="plant-category-image">
                                <img src="https://images.unsplash.com/photo-1426170042593-200f250dfdaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Aquatic Plants">
                            </div>
                        </div>
                        <div class="plant-category-content">
                            <h3 class="plant-category-name">Other Products</h3>
                        </div>
                    </a>
                </div>

                <!-- Category 5 -->
                <div class="plant-category-item">
                    <a href="#" class="plant-category-card index2-categories-card">
                        <div class="category-image-container">
                               <span class="category-badge badge-offer">OFFER</span>
                            <div class="plant-category-image">
                                <img src="https://images.unsplash.com/photo-1517191434949-5e90cd67d2b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Natural Plants">
                            </div>
                        </div>
                        <div class="plant-category-content">
                            <h3 class="plant-category-name">Offer Products</h3>
                        </div>
                    </a>
                </div>

                <!-- Category 6 -->
                <div class="plant-category-item">
                    <a href="#" class="plant-category-card index2-categories-card">
                        <div class="category-image-container">
                            <span class="category-badge badge-sale">Combo</span>
                            <div class="plant-category-image">
                                <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Flowering Plants">
                            </div>
                        </div>
                        <div class="plant-category-content">
                            <h3 class="plant-category-name">Combo Pack</h3>
                        </div>
                    </a>
                </div>


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
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <!-- <img src="assets/img2/slider/slider1.jpg" class="d-block w-100 img-fluid" alt="s1"> -->
                        <img src="{{ asset('uploads/img2/slider/11.png') }}" class="d-block w-100 img-fluid" alt="s1">
                        <div class="carousel-caption container silder_text">
                            <p class="arrival">Complete Care for Every Plant</p>
                            <h5 class="headding">From Soil to<br>Bloom Naturally</h5>
                            <a type="btn" class="shop-now">Shop Now</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/img2/slider/22.png') }}" class="d-block w-100 img-fluid" alt="s1">
                        <div class="carousel-caption container silder_text">
                            <p>Complete Care for Every Plant</p>
                            <h5 class="headding">Everything Your Plants<br>Need Naturally </h5>
                            <a type="btn" class="shop-now">Shop Now</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/img2/slider/33.png') }}" class="d-block w-100 img-fluid" alt="s1">
                        <div class="carousel-caption container silder_text">
                            <p>Complete Care for Every Plant</p>
                            <h5 class="headding">Plants Gonna Make<br> People Happy.</h5>
                            <a type="btn" class="shop-now">Shop Now</a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                    data-slide="prev"></a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                    data-slide="next"></a>
            </div>
        </div>
        <!-- col-md-9 main_slider -->
    </div>
    <!-- row -->
</div>
<!-- container mt-4 -->
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
<!-- container  -->
<!-- services end -->


<!-- 
<section class="bg-white-section product-category-bg">
    <div class="container-fluid px-4">

        <div class="section-title d-flex justify-content-between align-items-center">
            <h2>Shop By categories</h2>
            <div class="title-link">
                <a href="{{ url('categories') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="row g-4">
 
            <div class="col-12 col-md-6 col-lg-4">
                <a href="#" class="product-category-card">

                    <div class="product-plant-category-content">
                        <h3 class="product-category-heading">Garden Products</h3>
                        <p class="product-category-text">Premium tools, organic seeds & gardening essentials.</p>
                        <span class="product-category-btn">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>

                    <div class="product-category-img-box">
                        <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b"
                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'product-category-placeholder\' style=\'background:#6ea820;\'>Garden</div>';" />
                    </div>

                </a>
            </div>

           
            <div class="col-12 col-md-6 col-lg-4">
                <a href="#" class="product-category-card">

                    <div class="product-plant-category-content">
                        <h3 class="product-category-heading">Planted Aquarium</h3>
                        <p class="product-category-text">Aquatic plants, substrates & aquarium tools.</p>
                        <span class="product-category-btn">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>

                    <div class="product-category-img-box">
                        <img src="https://images.unsplash.com/photo-1524704654690-b56c05c78a00"
                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'product-category-placeholder\' style=\'background:#4a7856;\'>Aqua</div>';" />
                    </div>

                </a>
            </div>

           
            <div class="col-12 col-md-6 col-lg-4">
                <a href="#" class="product-category-card">

                    <div class="product-plant-category-content">
                        <h3 class="product-category-heading">Natural Products</h3>
                        <p class="product-category-text">Organic, chemical-free lifestyle essentials.</p>
                        <span class="product-category-btn">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>

                    <div class="product-category-img-box">
                        <img src="https://images.unsplash.com/photo-1533090161767-e6ffed986c88"
                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'product-category-placeholder\' style=\'background:#f5a623;\'>Natural</div>';" />
                    </div>

                </a>
            </div>

        </div>

    </div>
</section> -->


<!-- Section 1: New Arrivals -->
<section class="bg-white-section">
    <!-- Changed to container-fluid for full width -->
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>New Arrivals</h2>
            <div class="title-link">
                <a href="{{ url('categories') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                <!-- 10 Products -->
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container">
                            <a href="{{ url('product') }}">
                                <img
                                    src="{{ asset('assets/images/product/product1.jpg') }}" alt="perlite"
                                    class="product-image main-image"><img
                                    src="{{ asset('assets/images/product/product1.jpg') }}" alt="perlite"
                                    class="product-image hover-image"><span class="discount-badge">10% OFF</span>
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Perlite</h3>
                            <div class="product-price"><span class="original-price">₹195.00</span><span
                                    class="current-price">₹175.00</span></div>
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

<!-- Section 2: Garden Products -->
<section class="bg-light-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Garden Products</h2>
            <div class="title-link">
                <a href="">More <i class="fas fa-chevron-right"></i></a>
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

                <div class="swiper-slide">
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

                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product8.jpg') }}"
                                alt="watercan" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product8.jpg') }}"
                                alt="watercan" class="product-image hover-image"><span class="discount-badge">8%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Watering Can 5L</h3>
                            <div class="product-price"><span class="original-price">₹425.00</span><span
                                    class="current-price">₹390.00</span></div>
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
                                src="{{ asset('assets/images/product/product7.jpg') }}" alt="rake"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product7.jpg') }}" alt="rake"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Hand Rake</h3>
                            <div class="product-price"><span class="current-price">₹349.00</span></div>
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
                                src="{{ asset('assets/images/product/product6.jpg') }}" alt="hoe"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product6.jpg') }}" alt="hoe"
                                class="product-image hover-image"><span class="discount-badge">10% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Digging Hoe</h3>
                            <div class="product-price"><span class="original-price">₹495.00</span><span
                                    class="current-price">₹445.00</span></div>
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
                                src="{{ asset('assets/images/product/product5.jpg') }}" alt="fork"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product5.jpg') }}" alt="fork"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Garden Fork</h3>
                            <div class="product-price"><span class="current-price">₹549.00</span></div>
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
                                src="{{ asset('assets/images/product/product4.jpg') }}" alt="knife"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product4.jpg') }}" alt="knife"
                                class="product-image hover-image"><span class="discount-badge">7% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Soil Knife</h3>
                            <div class="product-price"><span class="original-price">₹275.00</span><span
                                    class="current-price">₹255.00</span></div>
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
                                src="{{ asset('assets/images/product/product3.jpg') }}" alt="shear"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product3.jpg') }}" alt="shear"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Hedge Shear</h3>
                            <div class="product-price"><span class="current-price">₹725.00</span></div>
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
                                src="{{ asset('assets/images/product/product2.jpg') }}"
                                alt="gloves" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product2.jpg') }}"
                                alt="gloves" class="product-image hover-image"><span class="discount-badge">15%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Work Gloves</h3>
                            <div class="product-price"><span class="original-price">₹199.00</span><span
                                    class="current-price">₹169.00</span></div>
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
                                src="{{ asset('assets/images/product/product1.jpg') }}"
                                alt="kneeler" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product1.jpg') }}"
                                alt="kneeler" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Garden Kneeler</h3>
                            <div class="product-price"><span class="current-price">₹1,099.00</span></div>
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


<section class="ad-banner">
    <div class="banner-content">
        <h1 class="big-title">Fresh Plant-Based Goodness</h1>
        <p class="small-title">Discover our organic, sustainable products for a healthier lifestyle</p>
        <a href="#" class="contact-btn">Shop Now <i class="fas fa-leaf"></i></a>
    </div>
</section>


<!-- Section 3: Planted Aquarium Products -->
<section class="bg-white-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Planted Aquarium Products</h2>
            <div class="title-link">
                <a href="">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product1.jpg') }}"
                                alt="javafern" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product1.jpg') }}"
                                alt="javafern" class="product-image hover-image"><span class="discount-badge">8%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Java Fern</h3>
                            <div class="product-price"><span class="original-price">₹350.00</span><span
                                    class="current-price">₹320.00</span></div>
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
                                src="{{ asset('assets/images/product/product2.jpg') }}"
                                alt="mossball" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product2.jpg') }}"
                                alt="mossball" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Marimo Moss Ball</h3>
                            <div class="product-price"><span class="current-price">₹299.00</span></div>
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
                                src="{{ asset('assets/images/product/product3.jpg') }}" alt="anubias"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product3.jpg') }}" alt="anubias"
                                class="product-image hover-image"><span class="discount-badge">10% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Anubias Barteri</h3>
                            <div class="product-price"><span class="original-price">₹450.00</span><span
                                    class="current-price">₹405.00</span></div>
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
                                alt="aquasoil" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product4.jpg') }}"
                                alt="aquasoil" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Premium Aqua Soil</h3>
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
                                src="{{ asset('assets/images/product/product5.jpg') }}" alt="co2"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product5.jpg') }}" alt="co2"
                                class="product-image hover-image"><span class="discount-badge">18% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">CO2 System</h3>
                            <div class="product-price"><span class="original-price">₹2,999.00</span><span
                                    class="current-price">₹2,459.00</span></div>
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
                                alt="weights" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product6.jpg') }}"
                                alt="weights" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Plant Weights</h3>
                            <div class="product-price"><span class="current-price">₹199.00</span></div>
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
                                src="{{ asset('assets/images/product/product7.jpg') }}" alt="fert"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product7.jpg') }}" alt="fert"
                                class="product-image hover-image"><span class="discount-badge">12% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Plant Fertilizer</h3>
                            <div class="product-price"><span class="original-price">₹549.00</span><span
                                    class="current-price">₹483.00</span></div>
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
                                alt="driftwood" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product8.jpg') }}"
                                alt="driftwood" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Natural Driftwood</h3>
                            <div class="product-price"><span class="current-price">₹799.00</span></div>
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
                                src="{{ asset('assets/images/product/product9.jpg') }}" alt="rocks"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product9.jpg') }}" alt="rocks"
                                class="product-image hover-image"><span class="discount-badge">9% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Aquarium Rocks</h3>
                            <div class="product-price"><span class="original-price">₹349.00</span><span
                                    class="current-price">₹317.00</span></div>
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
                                alt="scissors" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product10.jpg') }}"
                                alt="scissors" class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Plant Scissors</h3>
                            <div class="product-price"><span class="current-price">₹449.00</span></div>
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

<!-- Section 4: Natural Products -->
<section class="bg-light-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Natural Products</h2>
            <div class="title-link">
                <a href="">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-image-container"><img
                                src="{{ asset('assets/images/product/product11.jpg') }}" alt="neemoil"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product11.jpg') }}" alt="neemoil"
                                class="product-image hover-image"><span class="discount-badge">15% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Organic Neem Oil</h3>
                            <div class="product-price"><span class="original-price">₹600.00</span><span
                                    class="current-price">₹510.00</span></div>
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
                                src="{{ asset('assets/images/product/product10.jpg') }}" alt="charcoal"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product10.jpg') }}" alt="charcoal"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Activated Charcoal</h3>
                            <div class="product-price"><span class="current-price">₹349.00</span></div>
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
                                src="{{ asset('assets/images/product/product9.jpg') }}" alt="bark"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product9.jpg') }}" alt="bark"
                                class="product-image hover-image"><span class="discount-badge">11% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Orchid Bark Mix</h3>
                            <div class="product-price"><span class="original-price">₹425.00</span><span
                                    class="current-price">₹378.00</span></div>
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
                                src="{{ asset('assets/images/product/product8.jpg') }}" alt="sand"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product8.jpg') }}" alt="sand"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Play Sand</h3>
                            <div class="product-price"><span class="current-price">₹249.00</span></div>
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
                                alt="peatmoss" class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product7.jpg') }}"
                                alt="peatmoss" class="product-image hover-image"><span class="discount-badge">14%
                                OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Premium Peat Moss</h3>
                            <div class="product-price"><span class="original-price">₹550.00</span><span
                                    class="current-price">₹473.00</span></div>
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
                                src="{{ asset('assets/images/product/product6.jpg') }}" alt="mulch"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product6.jpg') }}" alt="mulch"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Wood Mulch</h3>
                            <div class="product-price"><span class="current-price">₹399.00</span></div>
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
                                src="{{ asset('assets/images/product/product5.jpg') }}" alt="sulfur"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product5.jpg') }}" alt="sulfur"
                                class="product-image hover-image"><span class="discount-badge">9% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Organic Sulfur</h3>
                            <div class="product-price"><span class="original-price">₹325.00</span><span
                                    class="current-price">₹295.00</span></div>
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
                                src="{{ asset('assets/images/product/product4.jpg') }}" alt="lime"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product4.jpg') }}" alt="lime"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Garden Lime</h3>
                            <div class="product-price"><span class="current-price">₹299.00</span></div>
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
                                src="{{ asset('assets/images/product/product3.jpg') }}" alt="gypsum"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product3.jpg') }}" alt="gypsum"
                                class="product-image hover-image"><span class="discount-badge">13% OFF</span></div>
                        <div class="product-info">
                            <h3 class="product-title">Soil Gypsum</h3>
                            <div class="product-price"><span class="original-price">₹449.00</span><span
                                    class="current-price">₹391.00</span></div>
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
                                src="{{ asset('assets/images/product/product2.jpg') }}" alt="ash"
                                class="product-image main-image"><img
                                src="{{ asset('assets/images/product/product2.jpg') }}" alt="ash"
                                class="product-image hover-image"></div>
                        <div class="product-info">
                            <h3 class="product-title">Wood Ash</h3>
                            <div class="product-price"><span class="current-price">₹199.00</span></div>
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

<!---------------------------------------------------------- testimonials ------------------------------------------------------->
<div class="reviews-carousel">
    <div class="carousel-header">
        <h2 class="section-title1 text-center">Trusted by thousands</h2>
        <div class="see-more">See more reviews</div>
    </div>

    <!-- Swiper -->
    <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="review-card">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Emma J.</div>
                        <div class="verified-badge">
                            <i class="fas fa-badge-check"></i>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                    <div class="review-date">11/07/25</div>
                    <div class="star-rating">
                        <!-- 5 stars -->
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                    </div>
                    <h3 class="review-title">Very happy with all of</h3>
                    <p class="review-content">
                        Very happy with all of my new plants. Prices were good, delivery was fast, and the plants
                        are gorgeous.
                    </p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="review-card">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Stephen J.</div>
                        <div class="verified-badge">
                            <i class="fas fa-badge-check"></i>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                    <div class="review-date">11/06/25</div>
                    <div class="star-rating">
                        <!-- 5 stars -->
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                    </div>
                    <h3 class="review-title">Great shipping, packaged with care</h3>
                    <p class="review-content">
                        Great shipping, packaged with care. Plant arrived perfect with no disturbance or damage.
                    </p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="review-card">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Graciela R.</div>
                        <div class="verified-badge">
                            <i class="fas fa-badge-check"></i>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                    <div class="review-date">11/04/25</div>
                    <div class="star-rating">
                        <!-- 5 stars -->
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                    </div>
                    <h3 class="review-title">It arrived quickly</h3>
                    <p class="review-content">
                        It arrived quickly. And everything was packed well.
                    </p>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="swiper-slide">
                <div class="review-card">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Jackie P.</div>
                        <div class="verified-badge">
                            <i class="fas fa-badge-check"></i>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                    <div class="review-date">11/04/25</div>
                    <div class="star-rating">
                        <!-- 5 stars -->
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                    </div>
                    <h3 class="review-title">Always great quality plants</h3>
                    <p class="review-content">
                        Always great quality plants, beautifully packed, speedy delivery.
                    </p>
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="swiper-slide">
                <div class="review-card">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Agnieszka S.</div>
                        <div class="verified-badge">
                            <i class="fas fa-badge-check"></i>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                    <div class="review-date">11/03/25</div>
                    <div class="star-rating">
                        <!-- 5 stars -->
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                    </div>
                    <h3 class="review-title">Great service, quick and safe</h3>
                    <p class="review-content">
                        Great service, quick and safe delivery of healthy plant.
                    </p>
                </div>
            </div>

            <!-- Slide 6 -->
            <div class="swiper-slide">
                <div class="review-card">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Lovely B.</div>
                        <div class="verified-badge">
                            <i class="fas fa-badge-check"></i>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                    <div class="review-date">11/02/25</div>
                    <div class="star-rating">
                        <!-- 5 stars -->
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                        <i class="fas fa-star star"></i>
                    </div>
                    <h3 class="review-title">Fabulous! I will be buying more</h3>
                    <p class="review-content">
                        Fabulous! I will be buying more. The quality is exceptional and delivery was prompt.
                    </p>
                </div>
            </div>
        </div>


    </div>

    <!-- Navigation -->
    <div class="carousel-nav">
        <div class="nav-btn swiper-button-prev1">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="nav-btn swiper-button-next1">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
</div>
<!---------------------------------------------------------- testimonials ---------------------------------------------------------->


<section class="bg-light-section">
    <div class="container-fluid px-4">
        <div class="section-title">
            <h2>Blogs</h2>
            <div class="title-link">
                <a href="">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="col-12">
            <div class="blog-grid">
                <div class="row g-4">

                    <!-- Blog Card 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('assets/images/product/product11.jpg') }}" alt="Indoor plant care">
                                <span class="blog-card-category">Plant Care</span>
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-card-date">Nov 15, 2024</div>
                                <h3 class="blog-card-title">10 Essential Tips to Keep Indoor Plants Healthy</h3>
                                <p class="blog-card-excerpt">
                                    Learn the fundamental watering, lighting, and soil requirements that help indoor plants grow stronger and greener.
                                </p>
                                <div class="blog-card-footer">
                                    <span class="blog-card-author">Sophia Green</span>
                                    <a href="#" class="read-more-link">Read →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Card 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('assets/images/product/product10.jpg') }}" alt="Herb garden">
                                <span class="blog-card-category">Home Gardening</span>
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-card-date">Nov 14, 2024</div>
                                <h3 class="blog-card-title">Grow Your Own Kitchen Herbs Easily at Home</h3>
                                <p class="blog-card-excerpt">
                                    Basil, mint, rosemary, and more—discover how to grow flavorful herbs using simple containers and minimal sunlight.
                                </p>
                                <div class="blog-card-footer">
                                    <span class="blog-card-author">Daniel Brooks</span>
                                    <a href="#" class="read-more-link">Read →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Card 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('assets/images/product/product9.jpg') }}" alt="Air purifying plants">
                                <span class="blog-card-category">Wellness</span>
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-card-date">Nov 13, 2024</div>
                                <h3 class="blog-card-title">Top 7 Air-Purifying Plants for a Healthier Home</h3>
                                <p class="blog-card-excerpt">
                                    Improve indoor air quality naturally with Snake Plants, Peace Lilies, Jade Plants, and more. See which ones suit your space best.
                                </p>
                                <div class="blog-card-footer">
                                    <span class="blog-card-author">Ava Mitchell</span>
                                    <a href="#" class="read-more-link">Read →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</section>




@include('view.layout.footer')