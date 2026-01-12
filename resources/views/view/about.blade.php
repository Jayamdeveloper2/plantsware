@include('view.layout.header')


<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">About</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="about-section">
    <div class="container">
        <h2 class="plantsware-section-title">About Us</h2>
        <div class="row">
            <!-- Right Side - Image -->
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ asset ('assets/images/about.jpg') }}" alt="PlantsWare - Bringing Nature to Your Home">
                </div>
            </div>

            <!-- Left Side - Content -->
            <div class="col-lg-6">

                <p class="about-text">PlantsWare is a dedicated plant and nature-focused company committed to bringing the beauty of greenery into every home and space. We specialize in offering high-quality plants and nature-inspired products that support healthy, vibrant environments.</p>

                <p class="about-text">Our collection includes carefully selected Garden Products to help customers create thriving outdoor and indoor green spaces, focusing on sustainability and natural beauty.</p>

                <p class="about-text">We provide premium Planted Aquarium Products with live aquatic plants and accessories for stunning aquascapes, making aquarium planting accessible to all experience levels.</p>

                <p class="about-text">Our Natural Products category features eco-friendly items sourced directly from nature, promoting wellness and sustainable living.</p>
            </div>
        </div>
    </div>
</section>


<section class="plantsware-why">
    <div class="container">
        <h2 class="plantsware-section-title">Why Choose PlantsWare?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="plantsware-feature">
                    <div class="plantsware-feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="plantsware-feature-title">Eco-Friendly Products</h3>
                    <p>All our products are carefully selected for their environmental sustainability and minimal ecological impact.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="plantsware-feature">
                    <div class="plantsware-feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="plantsware-feature-title">Premium Quality</h3>
                    <p>We source only the highest quality products that meet our rigorous standards for performance and durability.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="plantsware-feature">
                    <div class="plantsware-feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="plantsware-feature-title">Fast Shipping</h3>
                    <p>Free shipping on orders over ₹50. Most orders ship within 24 hours and arrive within 3-5 business days.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Newsletter -->
<section class="plantsware-cta">
    <div class="container">
        <div class="plantsware-cta-content">
            <h2 class="plantsware-cta-title">Ready to Transform Your Space?</h2>
            <p class="plantsware-cta-subtitle">Join thousands of satisfied customers who trust PlantsWare for all their gardening and natural product needs. Start your green journey today!</p>

            <div class="plantsware-cta-buttons">
                <a href="#" class="plantsware-cta-btn plantsware-cta-btn-primary">
                    <i class="fas fa-shopping-cart me-2"></i>Shop Now
                </a>
               
            </div>

           
        </div>
    </div>
</section>

@include('view.layout.footer')