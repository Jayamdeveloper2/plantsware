@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')
<div class="container-fluid">
    <!-- Top Stats -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col-lg-2 col-6 mb-3">
                            <h4 class="mb-0">{{ $stats['total'] }}</h4>
                            <small class="text-muted">Total Orders</small>
                        </div>
                        <div class="col-lg-2 col-6 mb-3">
                            <h4 class="mb-0 text-warning">{{ $stats['pending'] }}</h4>
                            <small class="text-muted">Pending</small>
                        </div>
                        <div class="col-lg-2 col-6 mb-3">
                            <h4 class="mb-0 text-info">{{ $stats['processing'] }}</h4>
                            <small class="text-muted">Processing</small>
                        </div>
                        <div class="col-lg-2 col-6 mb-3">
                            <h4 class="mb-0 text-primary">{{ $stats['shipped'] }}</h4>
                            <small class="text-muted">Shipped</small>
                        </div>
                        <div class="col-lg-2 col-6 mb-3">
                            <h4 class="mb-0 text-success">{{ $stats['delivered'] }}</h4>
                            <small class="text-muted">Delivered</small>
                        </div>
                        <div class="col-lg-2 col-6 mb-3">
                            <h4 class="mb-0 text-danger">{{ $stats['cancelled'] }}</h4>
                            <small class="text-muted">Cancelled</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Filters -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-4">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by order or customer..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-center">
                    <div class="btn-group">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary {{ !request('status') ? 'active' : '' }}">All</a>
                        <a href="?status=processing" class="btn btn-info {{ request('status') == 'processing' ? 'active' : '' }}">Processing</a>
                        <a href="?status=shipped" class="btn btn-primary {{ request('status') == 'shipped' ? 'active' : '' }}">Shipped</a>
                        <a href="?status=delivered" class="btn btn-success {{ request('status') == 'delivered' ? 'active' : '' }}">Delivered</a>
                        <a href="?status=cancelled" class="btn btn-danger {{ request('status') == 'cancelled' ? 'active' : '' }}">Cancelled</a>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <small>Show</small>
                    <select onchange="location = this.value" class="form-select d-inline w-auto ms-2">
                        <option value="?per_page=10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="?per_page=25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="?per_page=50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>SL NO</th>
                            <th>ORDER ID</th>
                            <th>USER NAME</th>
                            <th>MOBILE NO</th>
                            <th>ADDRESS</th>
                            <th>PAYMENT STATUS</th>
                            <th>ORDER STATUS</th>
                            <th>TOTAL AMOUNT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $index => $order)
                        <tr>
                            <td>{{ $orders->firstItem() + $index }}</td>
                            <td><strong>#{{ $order->order_number }}</strong></td>
                            <td>{{ $order->user?->name ?? 'Guest' }}</td>
                            <td>{{ $order->shipping_address['phone'] ?? 'N/A' }}</td>
                            <td class="small">
                                {{ $order->shipping_address['address'] ?? 'N/A' }}<br>
                                {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }}
                            </td>
                            <td>
                                <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $order->getStatusBadgeClass() }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>₹{{ number_format($order->total, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection