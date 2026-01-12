// app/Http/Controllers/Frontend/CartController.php
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add to cart
    public function add(Request $request, Product $product)
{
    $quantity = max(1, $request->quantity ?? 1);

    // Check if product has enough stock
    if ($product->stock_quantity < $quantity) {
        return back()->with('error', "Sorry! Only {$product->stock_quantity} item(s) available in stock.");
    }

    // Check current cart quantity for this product
    $existingCartItem = Cart::current()
        ->where('product_id', $product->id)
        ->first();

    $currentQtyInCart = $existingCartItem ? $existingCartItem->quantity : 0;
    $newTotalQty = $currentQtyInCart + $quantity;

    if ($newTotalQty > $product->stock_quantity) {
        $available = $product->stock_quantity - $currentQtyInCart;
        if ($available <= 0) {
            return back()->with('error', "This product is out of stock!");
        }
        return back()->with('error', "You can only add {$available} more item(s). Only {$product->stock_quantity} in stock.");
    }

    // Add or update cart
    Cart::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'session_id' => auth()->check() ? null : session()->getId(),
            'product_id' => $product->id,
        ],
        ['quantity' => \DB::raw("quantity + {$quantity}")]
    );

    return back()->with('success', "Added {$quantity} × {$product->name} to cart!");
}

    // Show cart
    public function index()
    {
        $cartItems = Cart::current()
            ->with('product')
            ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal; // Add shipping/tax later

        return view('frontend.cart', compact('cartItems', 'subtotal', 'total'));
    }

    // Update quantity
    public function update(Request $request, Cart $cartItem)
{
    $this->authorizeCart($cartItem);

    $quantity = max(1, $request->quantity);

    if ($quantity > $cartItem->product->stock_quantity) {
        return back()->with('error', "Only {$cartItem->product->stock_quantity} item(s) available in stock.");
    }

    $cartItem->update(['quantity' => $quantity]);

    return back()->with('success', 'Cart updated successfully!');
}
    // Remove item
    public function remove(Cart $cart)
    {
        $this->authorizeCart($cart);

        $cart->delete();

        return back()->with('success', 'Item removed');
    }

    // Clear cart
    public function clear()
    {
        Cart::current()->delete();

        return back()->with('success', 'Cart cleared');
    }

    // Helper to check ownership
    protected function authorizeCart(Cart $cart)
    {
        if (auth()->check()) {
            if ($cart->user_id !== auth()->id()) abort(403);
        } else {
            if ($cart->session_id !== session()->getId()) abort(403);
        }
    }
}