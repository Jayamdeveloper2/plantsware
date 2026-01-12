<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // The index method is intentionally left blank as per instructions.
    // If required in the future, it can be re-implemented.
    public function index()
    {
        $cartItems = Cart::current()->with('product')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal;

        $this->updateSessionCounts();

        return view('view.cart', compact('cartItems', 'subtotal', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($product->stock_quantity < $quantity) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => "Only {$product->stock_quantity} item(s) left in stock!"
                ], 400);
            }
            return back()->with('error', "Only {$product->stock_quantity} item(s) left in stock!");
        }

        $existingItem = Cart::current()->where('product_id', $product->id)->first();
        $currentQuantity = $existingItem ? $existingItem->quantity : 0;
        $newTotalQuantity = $currentQuantity + $quantity;

        if ($newTotalQuantity > $product->stock_quantity) {
            $canAdd = $product->stock_quantity - $currentQuantity;
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => "You can only add {$canAdd} more item(s) of this product."
                ], 400);
            }
            return back()->with('error', "You can only add {$canAdd} more item(s) of this product.");
        }

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
        } else {
            Cart::create([
                'user_id'     => Auth::id(),
                'session_id'  => Auth::check() ? null : session()->getId(),
                'product_id'  => $product->id,
                'quantity'    => $quantity,
            ]);
        }

        $this->updateSessionCounts();

        $cartCount = Cart::current()->sum('quantity') ?? 0;
        $cartItems = Cart::current()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$quantity} × {$product->name} added to cart!",
                'cart_count' => $cartCount,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($subtotal, 2)
            ]);
        }

        return back()->with('success', "{$quantity} × {$product->name} added to cart!");
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request,$id)
    {
        
        $this->authorizeCartItem($cartItem);

        $quantity = max(1, (int) $request->input('quantity'));

        // Load product if not loaded
        if (!$cartItem->relationLoaded('product')) {
            $cartItem->load('product');
        }

        if ($quantity > $cartItem->product->stock_quantity) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => "Only {$cartItem->product->stock_quantity} item(s) available."
                ], 400);
            }
            return back()->with('error', "Only {$cartItem->product->stock_quantity} item(s) available.");
        }

        $cartItem->update(['quantity' => $quantity]);

        $this->updateSessionCounts();

        // Calculate updated values
        $cartCount = Cart::current()->sum('quantity') ?? 0;
        $cartItems = Cart::current()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        $itemTotal = $cartItem->product->price * $quantity;

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully!',
                'cart_count' => $cartCount,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($subtotal, 2),
                'item_total' => number_format($itemTotal, 2),
                'quantity' => $quantity
            ]);
        }

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request, Cart $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $itemId = $cartItem->id;
        $cartItem->delete();

        $this->updateSessionCounts();

        $cartCount = Cart::current()->sum('quantity') ?? 0;
        $cartItems = Cart::current()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'cart_count' => $cartCount,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($subtotal, 2),
                'item_id' => $itemId
            ]);
        }

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Clear entire cart
     */
    public function clear(Request $request)
    {
        Cart::current()->delete();

        $this->updateSessionCounts();

        $cartCount = 0;
        $subtotal = 0;

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully!',
                'cart_count' => $cartCount,
                'subtotal' => '0.00',
                'total' => '0.00'
            ]);
        }

        return back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Add to wishlist (requires login)
     */
    public function addToWishlist(Request $request, Product $product)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to your wishlist.',
                    'login_url' => route('login')
                ], 401);
            }
            return back()->with('error', 'Please login to add items to your wishlist.');
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        $this->updateSessionCounts();
        $wishlistCount = Auth::user()->wishlist()->count() ?? 0;

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} added to wishlist!",
                'wishlist_count' => $wishlistCount
            ]);
        }

        return back()->with('success', "{$product->name} added to wishlist!");
    }

    /**
     * Remove from wishlist
     */
    public function removeFromWishlist(Request $request, Product $product)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to manage wishlist.'
                ], 401);
            }
            return back()->with('error', 'Please login to manage wishlist.');
        }

        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        $this->updateSessionCounts();
        $wishlistCount = Auth::user()->wishlist()->count() ?? 0;

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist.',
                'wishlist_count' => $wishlistCount
            ]);
        }

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
        $sessionId = session()->getId();
        cache()->forget("cart_count_{$sessionId}");

        if (Auth::check()) {
            cache()->forget("wishlist_count_" . Auth::id());
        }

        $cartCount = Cart::current()->sum('quantity') ?? 0;
        session(['cart_count' => $cartCount]);

        $wishlistCount = Auth::check() ? Auth::user()->wishlist()->count() ?? 0 : 0;
        session(['wishlist_count' => $wishlistCount]);

        view()->share('cartCount', $cartCount);
        view()->share('wishlistCount', $wishlistCount);
    }
}