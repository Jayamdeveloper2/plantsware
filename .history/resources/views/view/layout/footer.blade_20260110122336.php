<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- First Column: About -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>About Us</h5>
                <p>We are passionate about providing high-quality gardening products and solutions to help you create beautiful, thriving green spaces.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Second Column: Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('terms-conditions') }}">Terms & Conditions</a></li>
                    <li><a href="{{ url('refund-policy') }}">Refund Policy</a></li>

                </ul>
            </div>

            <!-- Third Column: Categories -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Categories</h5>
                <ul>
                    <li><a href="shop.html">Flowering Plants</a></li>
                    <li><a href="shop.html">Plant Seeds</a></li>
                    <li><a href="shop.html">Lucky Plants</a></li>
                    <li><a href="shop.html">Raisin Pots</a></li>
                    <li><a href="shop.html">Live Plants</a></li>
                    <li><a href="shop.html">Outdoor Plants</a></li>
                </ul>
            </div>

            <!-- Fourth Column: Address -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact Info</h5>

                <div class="contact-info">

                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <div class="contact-text">
                            <strong>Address</strong>
                            <p>Demo A - 2 Puffin Street, <br> Puffinville India, Surat</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <div class="contact-text">
                            <strong>Phone</strong>
                            <p>+91 12345 67890</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope mr-2"></i>
                        <div class="contact-text">
                            <strong>Email</strong>
                            <p>website@gmail.com</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">

                        <!-- Left Side -->
                        <p class="mb-2 mb-md-0">
                            &copy; 2025 Plantsware. All rights reserved.
                        </p>

                        <div class="footer-bottom-payment d-flex justify-content-center">
                            <div class="payment-link">
                                <img src="https://christianbooksworld.com/home/img/hero-bg/visa.png" alt="payment">
                            </div>
                            <div class="payment-link">
                                <img src="https://christianbooksworld.com/home/img/hero-bg/rupay.png" alt="payment">
                            </div>
                            <div class="payment-link">
                                <img src="https://christianbooksworld.com/home/img/hero-bg/gpay.png" alt="payment">
                            </div>
                            <div class="payment-link">
                                <img src="https://christianbooksworld.com/home/img/hero-bg/paytm.png" alt="payment">
                            </div>
                            <div class="payment-link">
                                <img src="https://christianbooksworld.com/home/img/hero-bg/upi.webp" alt="payment">
                            </div>
                        </div>

                        <!-- Right Side -->
                        <p class="mb-0">
                            <a href="#" class="text-dark"> Developed by Jayam Web Solutions</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- footer -->
<!-- footer end -->
<!-- scroll -->
<a href="#" id="scroll"></a>
<!-- jquery-3.4.1 -->
<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiperElements = document.querySelectorAll('.product-swiper');

        swiperElements.forEach(function(element) {
            new Swiper(element, {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,

                // ⭐ AUTOPLAY SETTINGS
                autoplay: {
                    delay: 99000, // Time between slides (2500ms = 2.5 seconds)
                    disableOnInteraction: false, // Keep autoplay after user swipes
                },

                pagination: {
                    el: element.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: element.querySelector('.swiper-button-next'),
                    prevEl: element.querySelector('.swiper-button-prev'),
                },

                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 20,
                    },
                },
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            speed: 600,
            grabCursor: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next1',
                prevEl: '.swiper-button-prev1',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize the carousel
        $('#plantCategoriesCarousel').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // Custom navigation buttons
        $('#prevBtn').click(function() {
            $('#plantCategoriesCarousel').slick('slickPrev');
        });

        $('#nextBtn').click(function() {
            $('#plantCategoriesCarousel').slick('slickNext');
        });
    });
</script>

</body>

</html>