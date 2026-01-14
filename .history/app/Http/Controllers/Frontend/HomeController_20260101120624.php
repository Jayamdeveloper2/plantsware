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
    $sliders = Slider::ordered()->get();
    $newArrivals = Product::active()->latest()->take(12)->get();
    $gardenProducts = Product::active()->whereCategory('Garden')->take(12)->get();
    $aquariumProducts = Product::active()->whereCategory('Aquarium')->take(12)->get();
    $naturalProducts = Product::active()->whereCategory('Natural')->take(12)->get();
    $testimonials = Testimonial::active()->latest()->take(8)->get();
    $blogs = Blog::active()->latest()->take(6)->get();

    return view('frontend.home', compact(
        'categories', 'sliders', 'newArrivals',
        'gardenProducts', 'aquariumProducts', 'naturalProducts',
        'testimonials', 'blogs'
    ));
}
}
