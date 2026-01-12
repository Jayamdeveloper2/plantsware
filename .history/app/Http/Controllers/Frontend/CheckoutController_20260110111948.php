<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {
    // Show address form (from cart "Proceed to Checkout")
    public function address() {
        $cartItems = Cart::current()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Pre-fill address if user has one saved
        $savedAddress = [];
        
        // Check if user is logged in and has address
        if (Auth::check()) {
            $user = Auth::user();
            // Try different possible address fields
            if (!empty($user->address)) {
                if (is_string($user->address) && json_decode($user->address)) {
                    // Address stored as JSON string
                    $savedAddress = json_decode($user->address, true);
                } elseif (is_array($user->address)) {
                    // Address stored as array
                    $savedAddress = $user->address;
                } elseif (is_object($user->address)) {
                    // Address stored as object
                    $savedAddress = (array) $user->address;
                }
            }
            
            // Also check individual fields if they exist
            if (empty($savedAddress)) {
                $savedAddress = [
                    'name' => $user->name ?? '',
                    'address' => $user->address_line1 ?? $user->address ?? '',
                    'city' => $user->city ?? '',
                    'state' => $user->state ?? '',
                    'pincode' => $user->pincode ?? $user->zip_code ?? '',
                    'phone' => $user->phone ?? $user->mobile ?? '',
                ];
            }
        }
        
        // Also check session for previously entered address
        if (session()->has('shipping_address')) {
            $savedAddress = array_merge($savedAddress, session('shipping_address'));
        }

        return view('address', compact('cartItems', 'savedAddress'));
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

        // Save to session
        session(['shipping_address' => $validated]);
        
        // Optionally save to user profile if logged in
        if (Auth::check()) {
            Auth::user()->update([
                'address' => json_encode($validated),
                'name' => $validated['name'] ?? Auth::user()->name,
                'phone' => $validated['phone'] ?? Auth::user()->phone,
            ]);
        }

        return redirect()->route('checkout.index')->with('success', 'Address saved successfully!');
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
        return DB::transaction(function () use ($cartItems, $shippingAddress, $request) {
            $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $shipping = 0;
            $tax = 0;
            $total = $subtotal + $shipping + $tax;

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => auth()->id(),
                'shipping_address' => json_encode($shippingAddress),
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method ?? 'cod',
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
    
    public function confirmation(Order $order) {
        if ($order->user_id !== auth()->id()) abort(403);
        return view('view.order.confirmation', compact('order'));
    }
}