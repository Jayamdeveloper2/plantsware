<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CartController;
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

// Cart & Wishlist Routes
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add/{product}', 'add')->name('cart.add');
    Route::post('/cart/update/{cart}', 'update')->name('cart.update');
    Route::delete('/cart/remove/{cart}', 'remove')->name('cart.remove');
    Route::post('/cart/clear', 'clear')->name('cart.clear');

    Route::post('/wishlist/add/{product}', 'addToWishlist')->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', 'removeFromWishlist')->name('wishlist.remove');
    Route::get('/wishlist', 'wishlist')->name('wishlist');
});

// Social Login
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Static Pages
Route::view('about', 'view.about')->name('about');
Route::view('privacy-policy', 'view.privacypolicy')->name('privacy-policy');
Route::view('terms-conditions', 'view.termsandconditions')->name('terms-conditions');
Route::view('refund-policy', 'view.refundpolicy')->name('refund-policy');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Auth (Public)
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth.admin'])->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Products Management Hub
        Route::get('products-management', [ProductManagementController::class, 'categories'])
            ->name('products.management');

        // Show subcategories under a category
        Route::get('categories/{category}/subcategories', [ProductManagementController::class, 'subcategories'])
            ->name('categories.subcategories');

        // Products under a subcategory
        Route::get('subcategories/{subcategory}/products', [ProductManagementController::class, 'products'])
            ->name('subcategories.products');

        // === Standard Resource Routes ===

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        
        // IMPORTANT: Use resource route for subcategories
        Route::resource('subcategories', SubcategoryController::class);

        Route::resource('blogs', BlogController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('testimonials', TestimonialController::class);

        // Orders
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Header & Footer Settings
        Route::get('settings', [HeaderFooterController::class, 'index'])->name('settings');
        Route::post('settings', [HeaderFooterController::class, 'update'])->name('settings.update');
    });
});