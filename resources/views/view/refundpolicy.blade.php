@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">Refund Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="privacy-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">

                <!-- Refund Policy Section -->
                <div class="privacy-section">
                    <h2 class="mb-3">Refund Policy</h2>
                    <p class="privacy-text">At PlantsWare, we strive to provide healthy, high-quality plants and natural products. If you are not satisfied with your purchase, we are here to help. Please read our refund guidelines below.</p>
                </div>

                <!-- Section 1 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">1. Eligibility for Refunds</h2>
                    <p class="privacy-text">Refunds are eligible for damaged, defective, or incorrect items received.</p>
                    <ul class="privacy-list">
                        <li>Live plants must be reported within 24–48 hours of delivery with clear photos as proof of condition.</li>
                        <li>Natural products and garden items must be reported within 3 days of delivery.</li>
                        <li>Items must be unused and in original packaging (except for live plants).</li>
                    </ul>
                </div>

                <!-- Section 2 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">2. Non-Refundable Items</h2>
                    <ul class="privacy-list">
                        <li>Plants that deteriorate due to improper handling, incorrect care, or delays caused by the customer.</li>
                        <li>Products purchased on clearance or special promotions.</li>
                        <li>Items damaged after delivery.</li>
                    </ul>
                </div>

                <!-- Section 3 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">3. Replacement or Refund</h2>
                    <p class="privacy-text">Once your request is reviewed, we will either:</p>
                    <ul class="privacy-list">
                        <li>Send a replacement item, or</li>
                        <li>Issue a refund to your original payment method.</li>
                    </ul>
                    <p class="privacy-text">Refund processing times may vary depending on your bank or payment provider.</p>
                </div>

                <!-- Section 5 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">5. Shipping Costs</h2>
                    <p class="privacy-text">Return shipping costs may apply for non-defective items. For damaged or incorrect items, PlantsWare will cover the shipping fees.</p>
                </div>
            </div>
        </div>
    </div>
</section>



@include('view.layout.footer')