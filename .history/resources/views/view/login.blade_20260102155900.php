@extends('layouts.app')



@section('content')
<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder">Login</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="login-page-container py-5">
    <div class="container">
        <div class="login-page-card shadow-lg rounded overflow-hidden">
            <div class="row g-0">
                <!-- Left Side Image -->
                <div class="col-lg-6 login-page-left d-none d-lg-block">
                    <img src="{{ asset('assets/images/product/product4.jpg') }}" alt="Login" class="img-fluid h-100 w-100" style="object-fit: cover;">
                </div>

                <!-- Right Side Form -->
                <div class="col-lg-6 login-page-right p-5">
                    <h2 class="login-page-title mb-2">Sign In</h2>
                    <p class="login-page-subtitle text-muted mb-4">Welcome back! Please enter your details</p>

                    <!-- Session Messages -->
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Google Login Button -->
                    <a href="{{ route('auth.google') }}" class="btn btn-outline-danger w-100 mb-3 py-3 d-flex align-items-center justify-content-center">
                        <i class="fab fa-google me-3"></i>
                        Continue with Google
                    </a>

                    <div class="login-page-divider my-4">
                        <span class="login-page-divider-text bg-white px-3">Or continue with email</span>
                    </div>

                    <!-- Email/Password Form -->
                    <form action="{{ route('login') }}" method="POST" class="login-page-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter your email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Enter your password" required>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Sign In
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('view.layout.footer')
