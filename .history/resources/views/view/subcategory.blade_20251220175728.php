@include('view.layout.header')


<!-- Breadcrumb Section -->
<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('categories') }}" class="text-decoration-none">Categories</a></li>
                    @if(isset($subcategory) && $subcategory->category)
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('category.show', $subcategory->category->slug) }}" class="text-decoration-none">{{ $subcategory->category->name }}</a></li>
                    @endif
                    @if(isset($subcategory))
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">{{ $subcategory->name }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- ======================================================
   SECTION 1 - WHITE BG
======================================================-->
<section class="sub-category-section pt-0" style="background:var(--white);">
    <div class="container">

        <div class="sub-category-header-wrap">
            <h1 class="sub-category-title">{{ isset($subcategory) ? $subcategory->name : 'Subcategory' }}</h1>
            <span class="sub-category-count">Result: {{ isset($products) ? $products->total() : 0 }} products.</span>

            <p class="sub-category-description mt-3">
                {{ isset($subcategory) && $subcategory->description ? $subcategory->description : 'Browse our collection of products in this category.' }}
            </p>
        </div>

        @if(isset($products) && $products->count() > 0)
        <div class="products-grid row g-3 mt-4">
            @foreach($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
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
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
        @else
        <div class="sub-category-grid">
            <p class="text-center w-100">No products found in this subcategory.</p>
        </div>
        @endif

    </div>
</section>


<!-- ======================================================
   SECTION 2 - LIGHT ALT BG
======================================================-->
<section class="sub-category-section" style="background: var(--light-bg-color);">
    <div class="container">

   <div class="section-title">
            <h2>Top Selling Garden Products</h2>
            <div class="title-link">
                <a href="{{ url('categories') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="sub-category-grid">

            @foreach([
                ['img'=>'product3.jpg','title'=>'Premium Pruning Shears'],
                ['img'=>'product4.jpg','title'=>'Organic All-Purpose Fertilizer'],
                ['img'=>'product5.jpg','title'=>'Self-Watering Planters'],
                ['img'=>'product10.jpg','title'=>'Organic All-Purpose Fertilizer'],
            ] as $item)

            <a href="{{ url('categories') }}" class="sub-category-card">
                <div class="sub-category-img-box">
                    <img src="{{ asset('assets/images/product/'.$item['img']) }}" alt="{{ $item['title'] }}">
                </div>

                <h3 class="sub-category-card-title">{{ $item['title'] }}</h3>
            </a>

            @endforeach

        </div>

    </div>
</section>


<!-- ======================================================
   SECTION 3 - WHITE BG
======================================================-->
<section class="sub-category-section" style="background: var(--white);">
    <div class="container ">

      <div class="section-title">
            <h2>Best Offers Garden Products</h2>
            <div class="title-link">
                <a href="{{ url('categories') }}">More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="sub-category-grid">

            @foreach([
                ['img'=>'product6.jpg','title'=>'Gardening Tool Set','badge'=>'50% OFF'],
                ['img'=>'product7.jpg','title'=>'Garden Hose Reel','badge'=>'30% OFF'],
                ['img'=>'product8.jpg','title'=>'Plant Seeds Collection','badge'=>'BUY 2 GET 1 FREE'],
                ['img'=>'product9.jpg','title'=>'Garden Hose Reel','badge'=>'30% OFF'],
            ] as $item)

            <a href="{{ url('categories') }}" class="sub-category-card">
                <div class="sub-category-img-box">
                    <img src="{{ asset('assets/images/product/'.$item['img']) }}" alt="{{ $item['title'] }}">
                </div>

                <div class="sub-category-offer-badge">{{ $item['badge'] }}</div>

                <h3 class="sub-category-card-title">{{ $item['title'] }}</h3>
            </a>

            @endforeach

        </div>

    </div>
</section>



@include('view.layout.footer')