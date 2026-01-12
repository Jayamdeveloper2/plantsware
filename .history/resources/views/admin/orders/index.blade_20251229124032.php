@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>All Orders</h2>
</div>

<div class="card">
    <div class="card-body">
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by order number or customer..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <select name="status" onchange="location = this.value;" class="form-select">
                    <option value="{{ route('admin.orders.index') }}">All Status</option>
                    <option value="?status=pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="?status=processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="?status=shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="?status=delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="?status=cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3 text-end">
                <small class="text-muted">Total: {{ $orders->total() }} orders</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>{{ $order->user?->name ?? 'Guest' }}<br><small>{{ $order->user?->email ?? 'N/A' }}</small></td>
                        <td>{{ $order->items->count() }}</td>
                        <td>₹{{ number_format($order->total, 2) }}</td>
                        <td><span class="badge {{ $order->getStatusBadgeClass() }}">{{ ucfirst($order->status) }}</span></td>
                        <td><span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($order->payment_status) }}</span></td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4">No orders yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>
@endsection