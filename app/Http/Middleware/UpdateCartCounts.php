<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class UpdateCartCounts
{
    public function handle(Request $request, Closure $next)
    {
        // Only update for non-ajax GET requests (performance optimization)
        if ($request->isMethod('get') && !$request->ajax()) {
            
            // Cart count - cache for 5 minutes to reduce DB queries
            $cartCount = cache()->remember('cart_count_' . session()->getId(), 300, function () {
                return Cart::current()->sum('quantity') ?? 0;
            });
            session(['cart_count' => $cartCount]);
            
            // Wishlist count (auth only) - cache for 5 minutes
            if (Auth::check()) {
                $wishlistCount = cache()->remember('wishlist_count_' . Auth::id(), 300, function () {
                    return Auth::user()->wishlist()->count() ?? 0;
                });
                session(['wishlist_count' => $wishlistCount]);
            } else {
                session(['wishlist_count' => 0]);
            }
        } else {
            // For non-GET requests, ensure sessions exist (initialize if missing)
            if (!session()->has('cart_count')) {
                session(['cart_count' => 0]);
            }
            if (!session()->has('wishlist_count')) {
                session(['wishlist_count' => 0]);
            }
        }
        
        return $next($request);
    }
}