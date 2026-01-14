<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\HeaderFooterController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\LoginController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [FrontendProductController::class, 'show'])->name('product.show');
Route::get('products', [FrontendProductController::class, 'index'])->name('products.index');
Route::get('categories', [FrontendProductController::class, 'categories'])->name('categories');
Route::get('category/{slug}', [FrontendProductController::class, 'category'])->name('category.show');
Route::get('sub-category/{slug}', [FrontendProductController::class, 'subcategory'])->name('subcategory.show');
Route::get('blog', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [FrontendBlogController::class, 'show'])->name('blog.show');
Route::get('blog-categories', [FrontendBlogController::class, 'categories'])->name('blog.categories');
Route::get('blog-category/{slug}', [FrontendBlogController::class, 'category'])->name('blog.category.show');

// Cart Routes (Fixed grouping)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/update/{cart}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{cart}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
});
});

// Wishlist Routes
Route::prefix('wishlist')->name('wishlist.')->controller(CartController::class)->group(function () {
    Route::get('/', 'wishlist')->name('index');
    Route::post('/add/{product}', 'addToWishlist')->name('add');
    Route::delete('/remove/{product}', 'removeFromWishlist')->name('remove');
});

// Checkout Routes
Route::prefix('checkout')->name('checkout.')->controller(CheckoutController::class)->group(function () {
    Route::get('/address', 'address')->name('address');
    Route::post('/address', 'saveAddress')->name('saveAddress');
    Route::get('/', 'index')->name('index');
    Route::post('/place-order', 'placeOrder')->name('placeOrder');
    Route::get('/order/{order}/confirmation', 'confirmation')->name('confirmation');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
});

// Static pages (Removed duplicates)
Route::get('about', function () {
    return view('view.about');
})->name('about');

Route::get('privacy-policy', function () {
    return view('view.privacypolicy');
})->name('privacy-policy');

Route::get('terms-conditions', function () {
    return view('view.termsandconditions');
})->name('terms-conditions');

Route::get('refund-policy', function () {
    return view('view.refundpolicy');
})->name('refund-policy');

// Remove these duplicate routes (they conflict with controller routes):
// Route::get('cart', function () { ... }); // DUPLICATE - CONFLICT
// Route::get('wishlist', function () { ... }); // DUPLICATE - CONFLICT
// Route::get('login', function () { ... }); // DUPLICATE - CONFLICT

Route::get('user-dashboard', function () {
    return view('view.userdashboard');
})->name('user-dashboard')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (public)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
    });

    // Protected admin routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Products
        Route::resource('products', ProductController::class);
        
        // Orders
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        
        // Categories
        Route::resource('categories', CategoryController::class);
        
        // Subcategories
        Route::resource('subcategories', SubcategoryController::class);
        
        // Blogs
        Route::resource('blogs', BlogController::class);
       
        // Sliders
        Route::resource('sliders', SliderController::class);
        
        // Testimonials
        Route::resource('testimonials', TestimonialController::class);
        
        // Header Footer Settings
        Route::get('settings', [HeaderFooterController::class, 'index'])->name('settings');
        Route::post('settings', [HeaderFooterController::class, 'update'])->name('settings.update');

        // Products Management Custom Flow
        Route::get('products-management', [ProductManagementController::class, 'categories'])
            ->name('products.management');

        Route::get('categories/{category}/subcategories', [ProductManagementController::class, 'subcategories'])
            ->name('categories.subcategories');

        Route::get('categories/{category}/subcategories/create', [ProductManagementController::class, 'createSubcategory'])
            ->name('categories.subcategories.create');
            
        Route::post('categories/{category}/subcategories', [ProductManagementController::class, 'storeSubcategory'])
            ->name('categories.subcategories.store');

        Route::get('subcategories/{subcategory}/products', [ProductManagementController::class, 'products'])
            ->name('subcategories.products');
    });
});