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

    // Example sections — adjust filters as needed
    $gardenProducts = Product::active()
        ->whereHas('category', fn($q) => $q->where('name', 'like', '%Garden%'))
        ->orWhereHas('subcategory', fn($q) => $q->where('name', 'like', '%Garden%'))
        ->take(12)->get();

    $aquariumProducts = Product::active()
        ->whereHas('category', fn($q) => $q->where('name', 'like', '%Aquarium%'))
        ->orWhereHas('subcategory', fn($q) => $q->where('name', 'like', '%Aquarium%'))
        ->take(12)->get();

    $naturalProducts = Product::active()
        ->whereHas('category', fn($q) => $q->where('name', 'like', '%Natural%'))
        ->orWhereHas('subcategory', fn($q) => $q->where('name', 'like', '%Natural%'))
        ->take(12)->get();

    $testimonials = Testimonial::active()->latest()->take(8)->get();
    $blogs = Blog::active()->latest()->take(6)->get();

    return view('viewindex', compact(
        'categories', 'sliders', 'newArrivals',
        'gardenProducts', 'aquariumProducts', 'naturalProducts',
        'testimonials', 'blogs'
    ));
}
}
