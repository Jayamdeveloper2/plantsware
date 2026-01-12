<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\HeaderFooter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $categories = Category::active()->ordered()->get();
    $sliders = Slider::active()->ordered()->get();
    $newArrivals = Product::active()->latest()->take(12)->get();

    // Fix 1: Filter by category name (through relationship)
    $gardenProducts = Product::active()
        ->whereHas('category', function ($query) {
            $query->where('name', 'like', '%Garden%');
        })
        ->orWhereHas('subcategory', function ($query) {
            $query->where('name', 'like', '%Garden%');
        })
        ->take(12)
        ->get();

    // Fix 2: Aquarium products
    $aquariumProducts = Product::active()
        ->whereHas('category', function ($query) {
            $query->where('name', 'like', '%Aquarium%');
        })
        ->orWhereHas('subcategory', function ($query) {
            $query->where('name', 'like', '%Aquarium%');
        })
        ->take(12)
        ->get();

    // Fix 3: Natural products
    $naturalProducts = Product::active()
        ->whereHas('category', function ($query) {
            $query->where('name', 'like', '%Natural%');
        })
        ->orWhereHas('subcategory', function ($query) {
            $query->where('name', 'like', '%Natural%');
        })
        ->take(12)
        ->get();

    $testimonials = Testimonial::active()->latest()->take(8)->get();
    $blogs = Blog::active()->latest()->take(6)->get();

    return view('view.in', compact(
        'categories', 'sliders', 'newArrivals',
        'gardenProducts', 'aquariumProducts', 'naturalProducts',
        'testimonials', 'blogs'
    ));
}
}
