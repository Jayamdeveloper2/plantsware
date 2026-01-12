@extends('admin.layout')

@section('title', 'Order #' . $order->order_number)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-muted">← Back to Orders</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h4>Order #{{ $order->order_number }}</h4>
                <span class="badge {{ $order->getStatusBadgeClass() }} fs-6">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="card-body">
                <h5>Ordered Items</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}" style="width:50px; height:50px; object-fit:cover;" class="me-2">
                                @endif
                                {{ $item->product_name }}
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>₹{{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <h5>Subtotal: ₹{{ number_format($order->subtotal, 2) }}</h5>
                    <h5>Shipping: ₹{{ number_format($order->shipping, 2) }}</h5>
                    <h5>Tax: ₹{{ number_format($order->tax, 2) }}</h5>
                    <h4>Total: ₹{{ number_format($order->total, 2) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header"><h5>Update Status</h5></div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select mb-3">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5>Customer & Shipping</h5></div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->user?->name ?? 'Guest' }}</p>
                <p><strong>Email:</strong> {{ $order->user?->email ?? 'N/A' }}</p>
                <hr>
                <p><strong>Shipping Address:</strong><br>
                    {{ $order->shipping_address['name'] ?? '' }}<br>
                    {{ $order->shipping_address['address'] ?? '' }}<br>
                    {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['pincode'] ?? '' }}<br>
                    {{ $order->shipping_address['state'] ?? '' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection