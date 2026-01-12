<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $request->quantity;

        $cart = session('cart', []);

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
                'stock' => $product->stock_quantity,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Show cart page
     */
    public function index()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal; // You can add shipping/tax later

        return view('frontend.cart', compact('cart', 'subtotal', 'total'));
    }

    /**
     * Update quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
            return back()->with('success', 'Cart updated!');
        }

        return back()->with('error', 'Product not found in cart.');
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            return back()->with('success', 'Product removed from cart.');
        }

        return back()->with('error', 'Product not found.');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }
}