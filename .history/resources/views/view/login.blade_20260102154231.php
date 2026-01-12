@include('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">login</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="login-page-container">
    <div class="container">
        <div class="login-page-card">
            <div class="row g-0">
                <!-- Left Side - Brand & Features -->
                <div class="col-lg-6 login-page-left">
                    <div class="login-page-content">
                         <img src="{{ asset('assets/images/product/product4.jpg') }}" alt="">
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-lg-6 login-page-right">
                    <div class="login-page-header">
                        <h2 class="login-page-title">Sign In</h2>
                        <p class="login-page-subtitle">Welcome back! Please enter your details</p>
                    </div>

                    <!-- Success Message -->
                    <div class="login-page-success" id="login-page-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <span id="login-page-success-text"></span>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="login-page-social-buttons">
                        <button class="login-page-social-btn login-page-google-btn" id="login-page-google-btn">
                            <i class="fab fa-google"></i>
                            Continue with Google
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="login-page-divider">
                        <span class="login-page-divider-text">Or continue with email</span>
                    </div>

                    <!-- Login Form -->
                    <form class="login-page-form" id="login-page-form">
                        <div class="login-page-form-group">
                            <label class="login-page-label" for="login-page-email">Email Address</label>
                            <div class="login-page-input-with-icon">
                                <i class="fas fa-envelope login-page-input-icon"></i>
                                <input type="email"
                                    class="login-page-input"
                                    id="login-page-email"
                                    placeholder="Enter your email"
                                    required>
                            </div>
                            <div class="login-page-error" id="login-page-email-error">
                                Please enter a valid email address
                            </div>
                        </div>

                        <div class="login-page-form-group">
                            <label class="login-page-label" for="login-page-password">Password</label>
                            <div class="login-page-input-with-icon">
                                <i class="fas fa-lock login-page-input-icon"></i>
                                <input type="password"
                                    class="login-page-input"
                                    id="login-page-password"
                                    placeholder="Enter your password"
                                    required>
                            </div>
                            <div class="login-page-error" id="login-page-password-error">
                                Password must be at least 6 characters
                            </div>
                        </div>

                        <div class="login-page-remember-forgot">
                            <a href="#" class="login-page-forgot-link">Forgot password?</a>
                        </div>

                        <button type="submit" class="login-page-submit-btn">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Sign In
                        </button>
                    </form>

                    <div class="login-page-signup-link">
                        Don't have an account? <a href="#">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('view.layout.footer')