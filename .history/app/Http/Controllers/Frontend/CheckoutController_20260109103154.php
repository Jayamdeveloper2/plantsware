<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller {
    // Show address form (from cart "Proceed to Checkout")
    public function address() {
        $cartItems = Cart::current()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Pre-fill address if user has one saved (e.g., from user profile)
        $user = auth()->user();
        $savedAddress = $user->address ?? null; // Assume User model has 'address' JSON field or relation

        return view('view.checkout.address', compact('cartItems', 'savedAddress'));
    }

    // Save address and redirect to checkout
    public function saveAddress(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
        ]);

        // Save to session or user profile
        session(['shipping_address' => $validated]);
        // Optionally save to user: auth()->user()->update(['address' => json_encode($validated)]);

        return redirect()->route('checkout');
    }

    // Show checkout/review page
    public function index() {
        $cartItems = Cart::current()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $shippingAddress = session('shipping_address');
        if (!$shippingAddress) {
            return redirect()->route('checkout.address')->with('error', 'Please provide shipping address.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $shipping = 0; // Fixed or calculate
        $tax = 0; // Fixed or calculate
        $total = $subtotal + $shipping + $tax;

        return view('view.checkout.index', compact('cartItems', 'shippingAddress', 'subtotal', 'shipping', 'tax', 'total'));
    }

    // Place order (confirm and save)
    public function placeOrder(Request $request) {
        $cartItems = Cart::current()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $shippingAddress = session('shipping_address');
        if (!$shippingAddress) {
            return redirect()->route('checkout.address')->with('error', 'Please provide shipping address.');
        }

        // Validate stock again
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock_quantity) {
                return back()->with('error', "Insufficient stock for {$item->product->name}.");
            }
        }

        // Create order in transaction
        return DB::transaction(function () use ($cartItems, $shippingAddress) {
            $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $shipping = 0;
            $tax = 0;
            $total = $subtotal + $shipping + $tax;

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => auth()->id(),
                'shipping_address' => $shippingAddress,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending', // Update after payment
                'payment_method' => $request->payment_method ?? 'cod', // e.g., 'cod', 'card'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_image' => $item->product->image,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'total' => $item->product->price * $item->quantity,
                ]);

                // Reduce stock
                $item->product->decrement('stock_quantity', $item->quantity);
            }

            // Clear cart
            Cart::current()->delete();
            session()->forget('shipping_address');

            return redirect()->route('order.confirmation', $order)->with('success', 'Order placed successfully!');
        });
    }
}
