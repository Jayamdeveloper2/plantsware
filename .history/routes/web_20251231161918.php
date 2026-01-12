<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
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

use League\CommonMark\Extension\Attributes\Node\Attributes;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [FrontendProductController::class, 'show'])->name('product.show');
Route::get('products', [FrontendProductController::class, 'index'])->name('products.index');
Route::get('categories', [FrontendProductController::class, 'categories'])->name('categories');
Route::get('category/{slug}', [FrontendProductController::class, 'category'])->name('category.show');
Route::get('sub-category/{slug}', [FrontendProductController::class, 'subcategory'])->name('subcategory.show');
Route::get('blog/{slug}', [FrontendBlogController::class, 'show'])->name('blog.show');
Route::get('blog-categories', [FrontendBlogController::class, 'categories'])->name('blog.categories');
Route::get('blog-category/{slug}', [FrontendBlogController::class, 'category'])->name('blog.category.show');
Route::controller(FrontendCartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add/{product}', 'add')->name('cart.add');
    Route::post('/cart/update', 'update')->name('cart.update');
    Route::delete('/cart/remove/{id}', 'remove')->name('cart.remove');
    Route::post('/cart/clear', 'clear')->name('cart.clear');
});
// Static pages
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
Route::get('cart', function () {
    return view('view.cart');
})->name('cart');
Route::get('wishlist', function () {
    return view('view.wishlist');
})->name('wishlist');
Route::get('login', function () {
    return view('view.login');
})->name('login');
Route::get('user-dashboard', function () {
    return view('view.userdashboard');
})->name('user-dashboard');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (public)
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(['auth.admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Products
        Route::resource('products', ProductController::class);
        
        // Orders
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
    


        // Categories
        Route::resource('categories', CategoryController::class);
        
        // Subcategories
        Route::resource('subcategories', SubcategoryController::class);

        // //Attributes
        // Route::resource('attributes', AttributesController::class);
        
        // Blogs
        Route::resource('blogs', BlogController::class);
       
        // Sliders
        Route::resource('sliders', SliderController::class);
        
        // Testimonials
        Route::resource('testimonials', TestimonialController::class);
        
        // Header Footer Settings
        Route::get('settings', [HeaderFooterController::class, 'index'])->name('settings');
        Route::post('settings', [HeaderFooterController::class, 'update'])->name('settings.update');

        // --- Products Management Custom Flow ---
        // Main Products Management Hub - shows categories
        Route::get('products-management', [ProductManagementController::class, 'categories'])
            ->name('products.management');

        // Subcategories for a specific category
        Route::get('categories/{category}/subcategories', [ProductManagementController::class, 'subcategories'])
            ->name('categories.subcategories');

        // Add new subcategory (create form)
        Route::get('categories/{category}/subcategories/create', [ProductManagementController::class, 'createSubcategory'])
            ->name('categories.subcategories.create');
        Route::post('categories/{category}/subcategories', [ProductManagementController::class, 'storeSubcategory'])
            ->name('categories.subcategories.store');

        // Products for a specific subcategory
        Route::get('subcategories/{subcategory}/products', [ProductManagementController::class, 'products'])
            ->name('subcategories.products');

        // Orders Management
       
            Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        });
    });