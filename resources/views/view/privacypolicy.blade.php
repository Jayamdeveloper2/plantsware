@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none"></a>Privacy Policy</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="privacy-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Introduction -->
                <div class="privacy-section">
                    <h2 class="mb-3">Terms and Conditions</h2>
                    <p class="privacy-text">At PlantsWare, we are committed to protecting your privacy and ensuring that your personal information is handled safely and responsibly. This Privacy Policy explains how we collect, use, and protect the information you provide when you visit our website or purchase our products.</p>
                </div>

                <!-- Section 1 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">1. Information We Collect</h2>
                    <p class="privacy-text">We may collect personal information such as your name, email address, phone number, shipping address, and payment details when you place an order or create an account.</p>
                    <p class="privacy-text">We may also collect non-personal information, including browser type, device information, and website usage data for analytics and improvement.</p>
                </div>

                <!-- Section 2 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">2. How We Use Your Information</h2>
                    <p class="privacy-text">Your information is used to:</p>
                    <ul class="privacy-list">
                        <li>Process orders and manage your account</li>
                        <li>Provide customer support and respond to inquiries</li>
                        <li>Improve our products and website experience</li>
                        <li>Send important updates and order notifications</li>
                        <li>Send promotional messages (you can unsubscribe at any time)</li>
                    </ul>
                </div>

                <!-- Section 3 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">3. Sharing of Information</h2>
                    <p class="privacy-text">PlantsWare does not sell or rent your personal information. We may share necessary data with trusted service providers such as:</p>
                    <ul class="privacy-list">
                        <li>Payment processors for secure transactions</li>
                        <li>Delivery partners for order fulfillment</li>
                        <li>Analytics tools to improve our services</li>
                    </ul>
                    <p class="privacy-text">These partners are required to protect your information and use it only for the agreed purposes.</p>
                </div>

                <!-- Section 4 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">4. Data Protection & Security</h2>
                    <p class="privacy-text">We use secure systems and encryption measures to safeguard your personal information. While we strive to protect all data, no online transmission is completely secure; however, we take every reasonable step to ensure the safety of your information.</p>
                </div>

                <!-- Section 5 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">5. Cookies & Tracking Technologies</h2>
                    <p class="privacy-text">Our website may use cookies to improve user experience, analyze traffic, and remember your preferences. You can control or disable cookies through your browser settings, but doing so may affect some website features.</p>
                </div>

                <!-- Section 6 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">6. Your Rights</h2>
                    <p class="privacy-text">You have the right to:</p>
                    <ul class="privacy-list">
                        <li>Access, update, or request deletion of your personal information</li>
                        <li>Opt out of marketing communications at any time</li>
                        <li>Request information about how your data is being used</li>
                    </ul>
                    <p class="privacy-text">To exercise these rights, please contact us using the information below.</p>
                </div>

                <!-- Section 7 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">7. Third-Party Links</h2>
                    <p class="privacy-text">Our website may contain links to third-party sites. PlantsWare is not responsible for the privacy practices or content of these external websites.</p>
                </div>

                <!-- Section 8 -->
                <div class="privacy-section">
                    <h2 class="privacy-section-title">8. Changes to This Policy</h2>
                    <p class="privacy-text">We may update this Privacy Policy occasionally. Any changes will be posted on this page with the updated date.</p>
                </div>

            </div>
        </div>
    </div>
</section>


@include('view.layout.footer')