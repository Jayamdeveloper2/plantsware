<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cartItems = Cart::current()->with('product')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal; // You can add shipping/tax later

        // Update session counts for consistency
        $this->updateSessionCounts();

        return view('view.cart', compact('cartItems', 'subtotal', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        // Check stock availability
        if ($product->stock_quantity < $quantity) {
            return back()->with('error', "Only {$product->stock_quantity} item(s) left in stock!");
        }

        $existingItem = Cart::current()
            ->where('product_id', $product->id)
            ->first();

        $currentQuantity = $existingItem ? $existingItem->quantity : 0;
        $newTotalQuantity = $currentQuantity + $quantity;

        if ($newTotalQuantity > $product->stock_quantity) {
            $canAdd = $product->stock_quantity - $currentQuantity;
            return back()->with('error', "You can only add {$canAdd} more item(s) of this product.");
        }

        if ($existingItem) {
            // Update existing
            $existingItem->increment('quantity', $quantity);
        } else {
            // Create new
            Cart::create([
                'user_id'     => Auth::id(),
                'session_id'  => Auth::check() ? null : session()->getId(),
                'product_id'  => $product->id,
                'quantity'    => $quantity,
            ]);
        }

        // Update session count after add
        $this->updateSessionCounts();

        return back()->with('success', "{$quantity} × {$product->name} added to cart!");
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, Cart $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $quantity = max(1, (int) $request->input('quantity'));

        if ($quantity > $cartItem->product->stock_quantity) {
            return back()->with('error', "Only {$cartItem->product->stock_quantity} item(s) available.");
        }

        $cartItem->update(['quantity' => $quantity]);

        // Update session count after update
        $this->updateSessionCounts();

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove item from cart
     */
    public function remove(Cart $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        // Update session count after remove
        $this->updateSessionCounts();

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        Cart::current()->delete();

        // Update session count after clear
        $this->updateSessionCounts();

        return back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Add to wishlist (requires login)
     */
    public function addToWishlist(Product $product)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Please login to add items to your wishlist.');
        }

        Wishlist::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]
        );

        // Update session count after add
        $this->updateSessionCounts();

        return back()->with('success', "{$product->name} added to wishlist!");
    }

    /**
     * Remove from wishlist
     */
    public function removeFromWishlist(Product $product)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->delete();
        }

        // Update session count after remove
        $this->updateSessionCounts();

        return back()->with('success', 'Removed from wishlist.');
    }

    /**
     * Show wishlist page
     */
    public function wishlist()
    {
        $wishlistItems = Auth::check()
            ? Auth::user()->wishlist()->with('product')->get()
            : collect();

        // Update session counts for consistency
        $this->updateSessionCounts();

        return view('view.wishlist', compact('wishlistItems'));
    }

    /**
     * Helper: Authorize that the cart item belongs to current user/session
     */
    protected function authorizeCartItem(Cart $cartItem)
    {
        $isOwner = Auth::check()
            ? $cartItem->user_id === Auth::id()
            : $cartItem->session_id === session()->getId();

        if (!$isOwner) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Helper: Update session counts for cart and wishlist
     */
    protected function updateSessionCounts()
    {
        // Clear cache if you're using caching in middleware
        $sessionId = session()->getId();
        cache()->forget("cart_count_{$sessionId}");
        
        if (Auth::check()) {
            cache()->forget("wishlist_count_" . Auth::id());
        }

        // Cart count (sum of quantities, works for auth or guest)
        $cartCount = Cart::current()->sum('quantity') ?? 0;
        session(['cart_count' => $cartCount]);

        // Wishlist count (only for authenticated users)
        $wishlistCount = Auth::check() ? Auth::user()->wishlist()->count() ?? 0 : 0;
        session(['wishlist_count' => $wishlistCount]);
        
        // Share with all views
        view()->share('cartCount', $cartCount);
        view()->share('wishlistCount', $wishlistCount);
    }
}