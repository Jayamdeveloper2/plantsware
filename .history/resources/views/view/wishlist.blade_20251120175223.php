@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">Product</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="gi-vendor-dashboard-card">
                <div class="gi-vendor-card-header">
                    <h5>My Wishlist</h5>
                    <div class="">
                        <a class="btn btn-outline-white" href="#">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
                <div class="gi-vendor-card-body">
                    <!-- Wishlist Items Table -->
                    <div class="gi-vendor-card-table">
                        <table class="table gi-table">
                            <thead>
                                <tr>
                                    <th scope="col">S. NO</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="wish-empt">
                                <tr class="pro-gl-content">
                                    <td scope="row"><span>1</span></td>
                                    <td>
                                        <img class="prod-img" src="{{ asset('assets/images/product/product3.jpg') }}" alt="Perlite">
                                    </td>
                                    <td><span>Perlite</span></td>
                                    <td><span>₹261.00</span></td>
                                    <td>
                                        <div class="tbl-btn">
                                            <a class="gi-btn-2 add-to-cart" href="#" title="Add To Cart">
                                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                            </a>
                                            <a class="gi-btn-1 gi-remove-wish btn" href="#" title="Remove From List">
                                                ×
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="pro-gl-content">
                                    <td scope="row"><span>2</span></td>
                                    <td>
                                        <img class="prod-img" src="{{ asset('assets/images/product/product4.jpg') }}" alt="Vermiculite">
                                    </td>
                                    <td><span>Vermiculite</span></td>
                                    <td><span>₹225.00</span></td>
                                    <td>
                                        <div class="tbl-btn">
                                            <a class="gi-btn-2 add-to-cart" href="#" title="Add To Cart">
                                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                            </a>
                                            <a class="gi-btn-1 gi-remove-wish btn" href="#" title="Remove From List">
                                                ×
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="pro-gl-content">
                                    <td scope="row"><span>3</span></td>
                                    <td>
                                        <img class="prod-img" src="{{ asset('assets/images/product/product6.jpg') }}" alt="Cocopeat">
                                    </td>
                                    <td><span>Cocopeat</span></td>
                                    <td><span>₹350.00</span></td>
                                    <td>
                                        <div class="tbl-btn">
                                            <a class="gi-btn-2 add-to-cart" href="#" title="Add To Cart">
                                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                            </a>
                                            <a class="gi-btn-1 gi-remove-wish btn" href="#" title="Remove From List">
                                                ×
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="pro-gl-content">
                                    <td scope="row"><span>4</span></td>
                                    <td>
                                        <img class="prod-img" src="{{ asset('assets/images/product/product7.jpg') }}" alt="LECA Clay Balls">
                                    <td><span>LECA Clay Balls</span></td>
                                    <td><span>₹280.00</span></td>
                                    <td>
                                        <div class="tbl-btn">
                                            <a class="gi-btn-2 add-to-cart" href="#" title="Add To Cart">
                                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                            </a>
                                            <a class="gi-btn-1 gi-remove-wish btn" href="#" title="Remove From List">
                                                ×
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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


<script>
    // Function to remove items from wishlist
    document.querySelectorAll('.gi-remove-wish').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const row = this.closest('tr');
            row.style.opacity = '0.5';
            row.style.transform = 'translateX(20px)';
            setTimeout(() => {
                row.remove();
                updateSerialNumbers();
            }, 300);
        });
    });

    // Function to update serial numbers after removal
    function updateSerialNumbers() {
        document.querySelectorAll('.pro-gl-content').forEach((row, index) => {
            row.querySelector('td:first-child span').textContent = index + 1;
        });
    }

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productName = this.closest('tr').querySelector('td:nth-child(3) span').textContent;

            // Add animation to the button
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);

            alert(`"${productName}" has been added to your cart!`);
        });
    });
</script>


@include('view.layout.footer')