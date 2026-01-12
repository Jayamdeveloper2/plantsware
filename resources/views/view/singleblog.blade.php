@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('home') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('blog.categories') }}" class="text-decoration-none">Blogs</a></li>
                    @if(isset($blog) && $blog->category)
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="{{ route('blog.category.show', $blog->category->slug) }}" class="text-decoration-none">{{ $blog->category->name }}</a></li>
                    @endif
                    @if(isset($blog))
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">{{ $blog->title }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="py-4">
    <div class="container">
        <div class="row">
            <!-- Article Main -->
            <div class="col-lg-8">
                <!-- Article Header -->
                @if(isset($blog))
                <article class="single-blog-header">
                    @if($blog->category)
                        <span class="single-blog-category">{{ $blog->category->name }}</span>
                    @endif
                    <h1 class="single-blog-title">{{ $blog->title }}</h1>
                    <div class="single-blog-meta">
                        <div class="single-blog-meta-item">
                            <span class="single-blog-meta-item-label">By</span>
                            <span>{{ $blog->author_name ?? 'Admin' }}</span>
                        </div>
                        <div class="single-blog-meta-item">
                            <span class="single-blog-meta-item-label">Published</span>
                            <span>{{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
                        </div>
                    </div>
                </article>

                <!-- Featured Image -->
                @if($blog->image)
                <div class="single-blog-image">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                </div>
                @else
                <div class="single-blog-image">
                    <img src="{{ asset('assets/images/product/product5.jpg') }}" alt="{{ $blog->title }}">
                </div>
                @endif

                <!-- Article Body -->
                <div class="single-blog-body">
                    {!! $blog->content !!}
                @else
                <p>Blog not found.</p>
                @endif

                    <div class="single-blog-highlight-box">
                        <strong>Key Takeaway:</strong> Investing in quality garden products doesn't just make gardening easier—it can significantly improve plant health, increase yields, and make your gardening experience more enjoyable.
                    </div>

                    <h2>Essential Gardening Tools</h2>
                    <p>Having the right tools is fundamental to successful gardening. While you don't need every tool on the market, these basics will cover most gardening tasks:</p>

                    <h3>1. Hand Tools</h3>
                    <p>These are the workhorses of any garden shed:</p>
                    <ul>
                        <li><strong>Trowel:</strong> Essential for planting, transplanting, and weeding</li>
                        <li><strong>Hand Fork:</strong> Perfect for loosening soil and removing weeds</li>
                        <li><strong>Pruners:</strong> For trimming, deadheading, and harvesting</li>
                        <li><strong>Garden Gloves:</strong> Protect your hands from thorns, dirt, and chemicals</li>
                    </ul>

                    <h3>2. Long-Handled Tools</h3>
                    <p>For larger garden areas, these tools save time and effort:</p>
                    <ul>
                        <li><strong>Shovel:</strong> For digging holes and moving soil</li>
                        <li><strong>Garden Fork:</strong> Excellent for turning compost and aerating soil</li>
                        <li><strong>Rake:</strong> For leveling soil and clearing debris</li>
                        <li><strong>Hoe:</strong> Essential for weeding between rows</li>
                    </ul>

                    <h2>Soil and Fertilizer Products</h2>
                    <p>Healthy soil is the foundation of a successful garden. These products help create optimal growing conditions:</p>

                    <h3>1. Soil Amendments</h3>
                    <p>Improve your soil structure and fertility with these amendments:</p>
                    <ul>
                        <li><strong>Compost:</strong> Adds nutrients and improves soil texture</li>
                        <li><strong>Peat Moss:</strong> Helps retain moisture in sandy soils</li>
                        <li><strong>Perlite/Vermiculite:</strong> Improves drainage and aeration</li>
                        <li><strong>Lime:</strong> Adjusts soil pH for optimal plant growth</li>
                    </ul>

                    <h3>2. Fertilizers</h3>
                    <p>Provide essential nutrients for plant growth:</p>
                    <ul>
                        <li><strong>All-Purpose Granular Fertilizer:</strong> Slow-release nutrients for general use</li>
                        <li><strong>Liquid Fertilizer:</strong> Quick-acting nutrients for fast results</li>
                        <li><strong>Organic Options:</strong> Fish emulsion, bone meal, and kelp meal</li>
                        <li><strong>Specialty Fertilizers:</strong> Formulated for specific plants like tomatoes or roses</li>
                    </ul>

                    <h2>Watering and Irrigation Products</h2>
                    <p>Proper watering is crucial for plant health. These products help deliver water efficiently:</p>

                    <h3>1. Basic Watering Tools</h3>
                    <p>Start with these essentials:</p>
                    <ul>
                        <li><strong>Watering Can:</strong> For precise watering of containers and seedlings</li>
                        <li><strong>Garden Hose:</strong> Choose a durable, kink-resistant model</li>
                        <li><strong>Spray Nozzle:</strong> Provides different spray patterns for various tasks</li>
                        <li><strong>Watering Wand:</strong> Reaches hanging baskets and hard-to-access areas</li>
                    </ul>

                    <h3>2. Irrigation Systems</h3>
                    <p>For larger gardens or busy gardeners:</p>
                    <ul>
                        <li><strong>Soaker Hoses:</strong> Deliver water directly to plant roots with minimal evaporation</li>
                        <li><strong>Drip Irrigation:</strong> Highly efficient system for precise watering</li>
                        <li><strong>Sprinklers:</strong> Good for lawns and large garden areas</li>
                        <li><strong>Timers:</strong> Automate your watering schedule</li>
                    </ul>

                    <div class="single-blog-highlight-box">
                        <strong>Pro Tip:</strong> Water early in the morning to reduce evaporation and prevent fungal diseases. Deep, infrequent watering encourages stronger root systems.
                    </div>

                    <h2>Pest and Disease Control</h2>
                    <p>Protect your plants from common garden problems:</p>

                    <h3>1. Organic Solutions</h3>
                    <p>Environmentally friendly options for pest control:</p>
                    <ul>
                        <li><strong>Neem Oil:</strong> Effective against many common garden pests</li>
                        <li><strong>Insecticidal Soap:</strong> Controls soft-bodied insects like aphids</li>
                        <li><strong>Diatomaceous Earth:</strong> Natural powder that deters crawling insects</li>
                        <li><strong>Companion Plants:</strong> Marigolds, basil, and other plants that repel pests</li>
                    </ul>

                    <h3>2. Physical Barriers</h3>
                    <p>Prevent pests from reaching your plants:</p>
                    <ul>
                        <li><strong>Row Covers:</strong> Protect plants from insects and light frost</li>
                        <li><strong>Bird Netting:</strong> Keep birds away from fruits and berries</li>
                        <li><strong>Copper Tape:</strong> Deters slugs and snails</li>
                        <li><strong>Plant Cages/Stakes:</strong> Support plants and keep them off the ground</li>
                    </ul>

                    <h2>Conclusion</h2>
                    <p>Building a collection of essential garden products is an investment that pays off in healthier plants, higher yields, and more enjoyable gardening experiences. Start with the basics, then gradually add specialized products as your garden grows and your skills develop. Remember that quality matters—well-made tools and products will last for years and perform better than cheaper alternatives.</p>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Table of Contents -->
                <div class="single-blog-sidebar-widget">
                    <div class="single-blog-sidebar-title">Table of Contents</div>
                    <a href="#" class="single-blog-sidebar-link">Essential Gardening Tools</a>
                    <a href="#" class="single-blog-sidebar-link">Hand Tools</a>
                    <a href="#" class="single-blog-sidebar-link">Long-Handled Tools</a>
                    <a href="#" class="single-blog-sidebar-link">Soil and Fertilizer Products</a>
                    <a href="#" class="single-blog-sidebar-link">Watering and Irrigation Products</a>
                    <a href="#" class="single-blog-sidebar-link">Pest and Disease Control</a>
                </div>

                <!-- Related Category -->
                <div class="single-blog-sidebar-widget">
                    <div class="single-blog-sidebar-title">Related Contents</div>
                    <a href="#" class="single-blog-sidebar-link">Best Tools for Small Spaces</a>
                    <a href="#" class="single-blog-sidebar-link">Seasonal Garden Product Guide</a>
                    <a href="#" class="single-blog-sidebar-link">Budget-Friendly Garden Products</a>
                    <a href="#" class="single-blog-sidebar-link">Eco-Friendly Garden Supplies</a>
                </div>

            </div>
        </div>
    </div>
</section>




@include('view.layout.footer')