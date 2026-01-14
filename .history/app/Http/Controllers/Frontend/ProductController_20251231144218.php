<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subcategory;
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
public function checkout(Request $request)
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Cart is empty');
    }

    $validated = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'pincode' => 'required',
    ]);

    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    $order = Order::create([
        'order_number' => Order::generateOrderNumber(),
        'user_id' => auth()->id(),
        'subtotal' => $total,
        'total' => $total,
        'status' => 'pending',
        'payment_status' => 'pending',
        'payment_method' => 'cash_on_delivery',
        'shipping_address' => json_encode($validated),
    ]);

    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'product_name' => $item['name'],
            'product_image' => $item['image'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'total' => $item['price'] * $item['quantity'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Order placed successfully! #' . $order->order_number);
}
}
