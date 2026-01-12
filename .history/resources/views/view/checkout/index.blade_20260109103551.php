@include('view.layout.header')

<div class="container py-5">
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-md-8">
            <h3>Order Summary</h3>
            <table class="table">
                <thead>
                    <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->product->price, 2) }}</td>
                            <td>₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                <p>Subtotal: ₹{{ number_format($subtotal, 2) }}</p>
                <p>Shipping: ₹{{ number_format($shipping, 2) }}</p>
                <p>Tax: ₹{{ number_format($tax, 2) }}</p>
                <h4>Total: ₹{{ number_format($total, 2) }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Shipping Address</h3>
            <p>{{ $shippingAddress['name'] }}<br>
            {{ $shippingAddress['address'] }}<br>
            {{ $shippingAddress['city'] }}, {{ $shippingAddress['state'] }} - {{ $shippingAddress['pincode'] }}<br>
            Phone: {{ $shippingAddress['phone'] }}</p>
            <a href="{{ route('checkout.address') }}" class="btn btn-secondary">Edit Address</a>
        </div>
    </div>
    <form action="{{ route('checkout.placeOrder') }}" method="POST">
        @csrf
        <!-- Payment method selection (e.g., COD, Card) -->
        <div class="form-group">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control">
                <option value="cod">Cash on Delivery</option>
                <option value="card">Credit/Debit Card</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Place Order</button>
    </form>
</div>

@include('view.layout.footer')