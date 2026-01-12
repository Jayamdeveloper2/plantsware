<!DOCTYPE html>
<html lang="en">

<head>
    <title>Plantly</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/fav-icon.png') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.fancybox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/media.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CDN Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>

<body>
    <div class="preloader"></div>
    <!-- header area -->
    <header>
        <div class="topbar-outer py-2 d-lg-block d-none">
            <div>
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-4 topbar_left">
                        <ul>
                            <li class="text-center">
                                <span class="fw-bold">Rooted in Nature, Grown with Love</span>
                            </li>
                        </ul>
                    </div>
                    <!--
                    <div class="col-lg-7 col-md-8 col-sm-8 text-xs-right topbar_right text-right">
                        ...
                    </div>
                    -->
                </div>
            </div>
        </div>
        <!-- header-top -->
        <div class="header-top py-2 border-bottom shadow-sm">
            <div class="header-top-container">
                <div class="row header_row">
                    <div class="col-xl-3 col-lg-3 col-6 head-logo pl-md-0">
                        <div class="text-left header-top-left pt-2">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/logo-1.png') }}" class="img-responsive img" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-6 head-search">
                        <div class="d-flex navbar">
                            <!-- Search Bar -->
                            <div class="input-class text-left col-12 col-md-12 col-lg-7 order-2 order-lg-1">
                                <div class="between-header border border-danger rounded mb-0 head-left">
                                    <div class="d-flex align-items-stretch w-100" style="gap: 0;">
                                        <input type="text" placeholder="Search Products" class="form-control flex-grow-1" aria-label="search" aria-describedby="button-addon2">
                                        <button type="button" class="btn btn-danger text-uppercase font-weight-normal flex-shrink-0">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Account / Cart / Wishlist -->
                            <div class="col-xl-5 col-lg-5 head-right text-right order-1 order-lg-2">
                                <ul class="top_cart">
                                    <!-- Wishlist -->
                                    <li class="dropdown d-inline-block my-cart md_acco">
                                        <a href="{{ url('wishlist') }}" class="cart-qty">
                                            <span class="price_cart d-md-inline-block align-middle font-weight-bolder">2</span>
                                            <span class="dropdown-toggle Price-amount" role="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Wishlist
                                            </span>
                                        </a>
                                    </li>
                                    <!-- Cart -->
                                    <li class="dropdown d-inline-block my-cart md_acco">
                                        <a href="{{ url('cart') }}" class="cart-qty">
                                            <span class="price_cart d-md-inline-block align-middle font-weight-bolder">2</span>
                                            <span class="dropdown-toggle Price-amount" role="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Cart
                                            </span>
                                        </a>
                                    </li>
                                    <!-- My Account -->
                                    <li class="dropdown right1 md_acc md_acco">
                                        <span class="account-block"></span>
                                        <span class="dropdown-toggle my_account" role="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            My account
                                        </span>
                                        <span class="dropdown-menu r_menu dropdown-menu-right">
                                            <a class="dropdown-item font-weight-bolderer" href="{{ url('login') }}">Login</a>
                                            <a class="dropdown-item font-weight-bolderer" href="">Register</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- head-search -->
                </div>
            </div>
        </div>
        <!-- header-top py-2 border-bottom shadow-sm -->
        <div class="header_bottom shadow-sm rounded d-md-block d-sm-block d-lg-block sticky-top">
            <div>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <!-- Toggler for mobile/tablet -->
                        <button class="navbar-toggler d-lg-none d-md-block d-sm-block" type="button" id="menuToggle" aria-label="Open Menu">
                            <span class="navbar-toggler-icon">☰</span>
                        </button>
                        <ul class="main-menu navbar">
                            <button class="close-menu" id="closeMenu" aria-label="Close Menu">×</button>
                            <!-- Home -->
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="dropdown mega_menu m1 level-1 font-weight-bolderer">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Garden Products&nbsp;<span class="ml-1"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu w-100 p-3">
                                    <div class="row">
                                        <!-- COLUMN 1: Soil & Amendments -->
                                        <div class="col-lg-4 col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mb-2">Fertilizers & Soil Amendments</li>
                                                <li><a href="#">Perlite</a></li>
                                                <li><a href="#">Vermiculite</a></li>
                                                <li><a href="#">Cocopeat</a></li>
                                                <li><a href="#">Coco Husk</a></li>
                                                <li><a href="#">LECA Clay Balls</a></li>
                                                <li><a href="#">Vermicompost</a></li>
                                                <li><a href="#">Charcoal</a></li>
                                                <li><a href="#">Pine Bark</a></li>
                                                <li><a href="#">Lime Powder</a></li>
                                                <li><a href="#">Epsom Salt</a></li>
                                                <li><a href="#">Rice Husk</a></li>
                                            </ul>
                                        </div>
                                        <!-- COLUMN 2: Grow Bags -->
                                        <div class="col-lg-4 col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mb-2">Grow Bags – HDPE Circular</li>
                                                <li><a href="#">6x6 Inch</a></li>
                                                <li><a href="#">9x9 Inch</a></li>
                                                <li><a href="#">12x12 Inch</a></li>
                                                <li><a href="#">12x15 Inch</a></li>
                                                <li><a href="#">15x12 Inch</a></li>
                                                <li><a href="#">15x15 Inch</a></li>
                                                <li><a href="#">18x6 Inch</a></li>
                                                <li><a href="#">18x9 Inch</a></li>
                                                <li><a href="#">18x18 Inch</a></li>
                                                <li><a href="#">24x6 Inch</a></li>
                                                <li><a href="#">24x24 Inch</a></li>
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Grow Bags – HDPE Rectangular</li>
                                                <li><a href="#">18x12x12 Inch</a></li>
                                                <li><a href="#">18x12x9 Inch</a></li>
                                                <li><a href="#">24x12x9 Inch</a></li>
                                                <li><a href="#">24x12x12 Inch</a></li>
                                                <li><a href="#">24x24x12 Inch</a></li>
                                                <li><a href="#">24x24x18 Inch</a></li>
                                            </ul>
                                        </div>
                                        <!-- COLUMN 3: Tools, Nets, Pebbles, Toys, Drip Irrigation -->
                                        <div class="col-lg-4 col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mb-2">Shade & Nets</li>
                                                <li><a href="#">30% Shade</a></li>
                                                <li><a href="#">50% Shade</a></li>
                                                <li><a href="#">75% Shade</a></li>
                                                <li><a href="#">90% Shade</a></li>
                                                <li><a href="#">Creeper Net</a></li>
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Tools</li>
                                                <li><a href="#">Trowel</a></li>
                                                <li><a href="#">Hand Fork</a></li>
                                                <li><a href="#">Rake</a></li>
                                                <li><a href="#">Hand Cultivator</a></li>
                                                <li><a href="#">Hand Weeder</a></li>
                                                <li><a href="#">Hedge Shear</a></li>
                                                <li><a href="#">Pruning Shear</a></li>
                                                <li><a href="#">Watering Can</a></li>
                                                <li><a href="#">Pressure Sprayer</a></li>
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Pebbles</li>
                                                <li><a href="#">Polished</a></li>
                                                <li><a href="#">Unpolished</a></li>
                                                <li><a href="#">Marble Chips</a></li>

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Toys</li>
                                                <li><a href="#">Resin</a></li>
                                                <li><a href="#">Plastic</a></li>
                                                <li><a href="#">Wooden</a></li>

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Others</li>
                                                <li><a href="#">Artificial Grass</a></li>
                                                <li><a href="#">Drip Irrigation</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </ul>
                            </li>

                            <li class="dropdown mega_menu m1 level-1 font-weight-bolderer">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    Planted Aquarium Products <span class="ml-1"><i class="fa fa-angle-down"></i></span>
                                </a>

                                <ul class="dropdown-menu w-100 p-3" style="min-width: 570px !important;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#">Aqua Soil</a></li>
                                                <li><a href="#">CO2 Kit</a></li>
                                                <li><a href="#">Filter Media</a></li>
                                                <li><a href="#">Filter</a></li>
                                            </ul>
                                        </div>

                                        <div class="col-lg-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#">Light</a></li>
                                                <li><a href="#">Aqua Scaping Tools</a></li>
                                                <li><a href="#">Aquarium Motor Pump</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </ul>
                            </li>

                            <li class="dropdown mega_menu mega-menu-2 m1 level-1 font-weight-bolderer">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    Natural Products <span class="ml-1"><i class="fa fa-angle-down"></i></span>
                                </a>

                                <ul class="dropdown-menu w-100 p-3">
                                    <div class="row">

                                        <!-- Column 1 -->
                                        <div class="col-lg-6">
                                            <ul class="list-unstyled">
                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mb-2">Palm Products</li>
                                                <li><a href="#">Palm Jaggery</a></li>
                                                <li><a href="#">Palm Sugar Candy</a></li>

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Sugar Products</li>
                                                <li><a href="#">Sugarcane Jaggery</a></li>
                                                <li><a href="#">Brown Sugar</a></li>

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Rice</li>
                                                <li><a href="#">Karuppu Kavuni</a></li>
                                                <li><a href="#">Mapillai Samba</a></li>
                                                <li><a href="#">Bamboo Rice</a></li>
                                                <li><a href="#">Seeraga Samba</a></li>
                                                <li><a href="#">Poongar</a></li>
                                                <li><a href="#">Thuyamalli</a></li>
                                            </ul>
                                        </div>

                                        <!-- Column 2 -->
                                        <div class="col-lg-6">
                                            <ul class="list-unstyled">

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mb-2">Millet</li>
                                                <li><a href="#">Finger Millet</a></li>
                                                <li><a href="#">Pearl Millet</a></li>
                                                <li><a href="#">Foxtail Millet</a></li>
                                                <li><a href="#">Barnyard Millet</a></li>
                                                <li><a href="#">Proso Millet</a></li>
                                                <li><a href="#">Sorghum</a></li>

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Nuts</li>
                                                <li><a href="#">Cashew</a></li>
                                                <li><a href="#">Badam</a></li>
                                                <li><a href="#">Pista</a></li>

                                                <li class="h_title text-uppercase font-weight-bolder border-bottom mt-3 mb-2">Seeds</li>
                                                <li><a href="#">Sunflower</a></li>
                                                <li><a href="#">Cucumber</a></li>
                                                <li><a href="#">Watermelon</a></li>
                                                <li><a href="#">Pumpkin</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </ul>
                            </li>

                            <li><a href="{{url ('about') }}">About Plantsware</a></li>

                            <!-- Contact Us -->
                            <li><a href="{{ url('blog-categories')}}">Blog</a></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- header_bottom shadow-sm rounded  -->
    </header>
    <!-- header -->
    <!-- header area end -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    // TOGGLE MENU OPEN
    const menuToggle = document.getElementById('menuToggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            document.querySelector(".main-menu").classList.add("show");
        });
    }

    // TOGGLE MENU CLOSE
    const closeMenu = document.getElementById('closeMenu');
    if (closeMenu) {
        closeMenu.addEventListener('click', function() {
            document.querySelector(".main-menu").classList.remove("show");
        });
    }

    // Sticky Navigation
    const headerBottom = document.querySelector('.header_bottom');
    const headerTop = document.querySelector('.header-top');
    const topbarOuter = document.querySelector('.topbar-outer');

    // Function to toggle sticky class
    function toggleStickyNav() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // When to make sticky (adjust 100 to your preference)
        if (scrollTop > 100) {
            headerBottom.classList.add('sticky-nav');
            document.body.classList.add('sticky-nav-active');

            // Hide header-top when sticky
            if (headerTop) {
                headerTop.style.opacity = '0';
                headerTop.style.transition = 'opacity 0.3s ease';
            }
        } else {
            headerBottom.classList.remove('sticky-nav');
            document.body.classList.remove('sticky-nav-active');

            // Show header-top when not sticky
            if (headerTop) {
                headerTop.style.display = '';
                setTimeout(() => {
                    headerTop.style.opacity = '1';
                }, 10);
            }
        }
    }

    // Initial check
    toggleStickyNav();

    // Listen to scroll events
    window.addEventListener('scroll', toggleStickyNav);

    // Adjust on resize
    window.addEventListener('resize', toggleStickyNav);

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const mainMenu = document.querySelector('.main-menu');
        
        if (!event.target.closest('.navbar-toggler') &&
            !event.target.closest('.main-menu') &&
            mainMenu.classList.contains('show')) {
            mainMenu.classList.remove('show');
        }
    });
});
</script>