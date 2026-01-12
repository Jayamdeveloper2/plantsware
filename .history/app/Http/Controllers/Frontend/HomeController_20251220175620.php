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
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $sliders = Slider::where('is_active', true)->orderBy('sort_order')->get();
        $newArrivals = Product::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->take(10)->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->take(10)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(6)->get();
        $blogs = Blog::where('is_active', true)->latest()->take(3)->get();
        $headerFooter = HeaderFooter::first();

        return view('view.index', compact('categories', 'sliders', 'newArrivals', 'featuredProducts', 'testimonials', 'blogs', 'headerFooter'));
    }
}
