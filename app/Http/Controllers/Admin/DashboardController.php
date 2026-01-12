<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'blogs' => Blog::count(),
            'active_products' => Product::where('is_active', true)->count(),
        ];

        $recent_products = Product::latest()->take(5)->get();
        $recent_blogs = Blog::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_products', 'recent_blogs'));
    }
}
