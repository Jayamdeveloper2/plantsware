<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class UpdateCartCounts
{
    public function handle(Request $request, Closure $next)
    {
        // Cart count
        session(['cart_count' => Cart::current()->sum('quantity') ?? 0]);

        // Wishlist count (auth only)
        session(['wishlist_count' => Auth::check() ? Auth::user()->wishlist()->count() ?? 0 : 0]);

        return $next($request);
    }
}