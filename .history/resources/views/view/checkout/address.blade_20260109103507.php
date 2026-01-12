@include('view.layout.header')

<div class="container py-5">
    <h1>Shipping Address</h1>
    <form action="{{ route('checkout.saveAddress') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $savedAddress['name'] ?? '') }}">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required value="{{ old('address', $savedAddress['address'] ?? '') }}">
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>City</label>
                <input type="text" name="city" class="form-control" required value="{{ old('city', $savedAddress['city'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label>State</label>
                <input type="text" name="state" class="form-control" required value="{{ old('state', $savedAddress['state'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label>Pincode</label>
                <input type="text" name="pincode" class="form-control" required value="{{ old('pincode', $savedAddress['pincode'] ?? '') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone', $savedAddress['phone'] ?? '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Save & Proceed to Checkout</button>
    </form>
</div>

@include('view.layout.footer')