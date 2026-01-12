<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        return view('view.products', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        return view('view.product', compact('product', 'relatedProducts'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)->with(['products' => function($query) {
            $query->where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc');
        }])->orderBy('sort_order')->get();
        return view('view.productcategory', compact('categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('view.category', compact('category', 'products'));
    }

    public function subcategory($slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $products = Product::where('subcategory_id', $subcategory->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('view.subcategory', compact('subcategory', 'products'));
    }

    public function addToCart(Request $request, Product $product)
{
    $cart = session('cart', []);

    $quantity = $request->input('quantity', 1);

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $quantity;
    } else {
        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->sale_price ?? $product->price,
            'quantity' => $quantity,
            'image' => $product->image,
            'slug' => $product->slug,
        ];
    }

    session(['cart' => $cart]);

    return back()->with('success', 'Product added to cart successfully!');
}

}
