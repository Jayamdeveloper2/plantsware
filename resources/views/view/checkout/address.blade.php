@include('view.layout.header')

<div class="container py-5">
    <h1>Shipping Address</h1>
    
    <!-- Debug: Check if data is coming -->
    @php
        // Debug: Check what data is available
        // Remove this after debugging
        // dd(compact('savedAddress', 'cartItems'));
    @endphp
    
    @if(!$cartItems || $cartItems->isEmpty())
        <div class="alert alert-warning">
            Your cart is empty. <a href="{{ route('products.index') }}">Continue Shopping</a>
        </div>
    @else
        <form action="{{ route('checkout.saveAddress') }}" method="POST">
            @csrf
            
            <!-- Debug display (remove in production) -->
            @if(isset($savedAddress) && is_array($savedAddress))
                <div class="alert alert-info">
                    <small>Debug: Address data found with {{ count($savedAddress) }} fields</small>
                </div>
            @endif
            
            <div class="form-group mb-3">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" name="name" id="name" class="form-control" 
                       required value="{{ old('name', $savedAddress['name'] ?? '') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="address" class="form-label">Full Address *</label>
                <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', $savedAddress['address'] ?? '') }}</textarea>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="city" class="form-label">City *</label>
                    <input type="text" name="city" id="city" class="form-control" 
                           required value="{{ old('city', $savedAddress['city'] ?? '') }}">
                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="state" class="form-label">State *</label>
                    <input type="text" name="state" id="state" class="form-control" 
                           required value="{{ old('state', $savedAddress['state'] ?? '') }}">
                    @error('state')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="pincode" class="form-label">Pincode *</label>
                    <input type="text" name="pincode" id="pincode" class="form-control" 
                           required value="{{ old('pincode', $savedAddress['pincode'] ?? '') }}">
                    @error('pincode')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group mb-4">
                <label for="phone" class="form-label">Phone Number *</label>
                <input type="tel" name="phone" id="phone" class="form-control" 
                       required value="{{ old('phone', $savedAddress['phone'] ?? '') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('cart.index') }}" class="btn btn-secondary">Back to Cart</a>
                <button type="submit" class="btn btn-primary">Save & Proceed to Checkout</button>
            </div>
        </form>
    @endif
</div>

@include('view.layout.footer')