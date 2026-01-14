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

        <div class="sub-category-grid">

            @foreach([
                ['img'=>'product1.jpg','title'=>'Gardening Tools'],
                ['img'=>'product2.jpg','title'=>'Plant Fertilizers'],
                ['img'=>'product3.jpg','title'=>'Pots & Planters'],
                ['img'=>'product4.jpg','title'=>'Watering Equipment'],
                ['img'=>'product5.jpg','title'=>'Garden Decor'],
                ['img'=>'product6.jpg','title'=>'Soil & Compost'],
                ['img'=>'product7.jpg','title'=>'Pest Control'],
                ['img'=>'product8.jpg','title'=>'Garden Lighting'],
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