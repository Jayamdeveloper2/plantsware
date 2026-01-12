@extends('view.layout.header')

<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block"><a href="{{ route('home') }}">Home</a></li>
                    <li class="d-inline-block mx-2">/</li>
                    <li class="d-inline-block">Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <h1 class="mb-4">Shopping Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width:80px; height:80px; object-fit:cover;" class="me-3">
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $item['name'] }}</h6>
                                            @if($item['stock'] < 10)
                                                <small class="text-danger">Low stock: {{ $item['stock'] }} left</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>₹{{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="input-group" style="width:120px;">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">−</button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                                            <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Clear Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong>₹{{ number_format($total, 2) }}</strong>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h3>Your cart is empty</h3>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Start Shopping</a>
        </div>
    @endif
</div>

@include('view.layout.footer')