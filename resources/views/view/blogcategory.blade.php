@include('view.layout.header')


<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">Blogs</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="py-4">
    <div class="container">
        <div class="row">
            <!-- Blog Categories Grid -->
            <div class="col-12">
                <div class="blog-categories">
                    <div class="row g-4">
                        <!-- Category Card 1: Nutrition -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ url('blog') }}" class="category-card">
                                <div class="category-icon">
                                    <img src="{{asset('assets/images/product/product7.jpg')}}" alt="">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title">Nutrition</h3>
                                    <p class="category-description">Expert tips on plant-based nutrition, balanced diets, and nutritional science for optimal health.</p>
                                    <div class="category-meta">
                                        <span>Learn More →</span>
                                       
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Category Card 2: Recipes -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ url('blog') }}" class="category-card">
                                                              <div class="category-icon">
                                    <img src="{{asset('assets/images/product/product8.jpg')}}" alt="">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title">Recipes</h3>
                                    <p class="category-description">Delicious and easy-to-follow plant-based recipes from breakfast to dinner and everything in between.</p>
                                    <div class="category-meta">
                                        <span>Learn More →</span>
                                        
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Category Card 3: Wellness -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ url('blog') }}" class="category-card">
                                                                <div class="category-icon">
                                    <img src="{{asset('assets/images/product/product4.jpg')}}" alt="">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title">Wellness</h3>
                                    <p class="category-description">Holistic wellness practices, mental health, fitness, and mindfulness for a balanced lifestyle.</p>
                                    <div class="category-meta">
                                        <span>Learn More →</span>
                                        
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Category Card 4: Sustainability -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ url('blog') }}" class="category-card">
                                                               <div class="category-icon">
                                    <img src="{{asset('assets/images/product/product3.jpg')}}" alt="">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title">Sustainability</h3>
                                    <p class="category-description">Environmental impact, eco-friendly practices, and how to live sustainably on a plant-based diet.</p>
                                    <div class="category-meta">
                                        <span>Learn More →</span>
                                        
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Category Card 5: Lifestyle -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ url('blog') }}" class="category-card">
                                                               <div class="category-icon">
                                    <img src="{{asset('assets/images/product/product2.jpg')}}" alt="">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title">Lifestyle</h3>
                                    <p class="category-description">Personal stories, inspiration, and lifestyle tips from our community of plant-based enthusiasts.</p>
                                    <div class="category-meta">
                                        <span>Learn More →</span>
                                        
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Category Card 6: Science -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ url('blog') }}" class="category-card">
                                                                <div class="category-icon">
                                    <img src="{{asset('assets/images/product/product9.jpg')}}" alt="">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title">Science</h3>
                                    <p class="category-description">Latest research and scientific studies supporting plant-based nutrition and health benefits.</p>
                                    <div class="category-meta">
                                        <span>Learn More →</span>
                                       
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@include('view.layout.footer')