@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')
<div class="container-fluid">
    <!-- Top Stats Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row text-center">
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0">{{ $stats['total'] ?? 420 }}</h4>
                            <small class="text-muted">Total Orders</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-warning">{{ $stats['pending'] ?? 345 }}</h4>
                            <small class="text-muted">Pending</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-primary">{{ $stats['shipped'] ?? 8 }}</h4>
                            <small class="text-muted">Shipped</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-info">{{ $stats['accepted'] ?? 8 }}</h4>
                            <small class="text-muted">Accepted</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-danger">{{ $stats['rejected'] ?? 67 }}</h4>
                            <small class="text-muted">Rejected</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-secondary">{{ $stats['returned'] ?? 0 }}</h4>
                            <small class="text-muted">Returned</small>
                        </div>
                    </div>
                    <div class="mt-2 small text-muted">
                        Returned Requested: {{ $stats['return_requested'] ?? 0 }} | 
                        Returned Approved: {{ $stats['return_approved'] ?? 0 }} | 
                        Returned Rejected: {{ $stats['return_rejected'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">All Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Customized Orders</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Action Buttons & Filters -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <button class="btn btn-warning btn-sm">Change Payment Status</button>
                </div>
                <div class="col-md-6 text-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm active">All</button>
                        <button type="button" class="btn btn-info btn-sm">Processing</button>
                        <button type="button" class="btn btn-primary btn-sm">Shipped</button>
                        <button type="button" class="btn btn-success btn-sm">Delivered</button>
                        <button type="button" class="btn btn-danger btn-sm">Cancelled</button>
                        <button type="button" class="btn btn-secondary btn-sm">Returned</button>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <form method="GET" class="d-inline">
                        <small class="me-2">Show</small>
                        <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm d-inline w-auto">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>
                </div>
            </div>

            <!-- Search -->
            <div class="row mb-3">
                <div class="col-md-4 offset-md-8">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
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
                            <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>{{ $order->user?->name ?? 'Guest' }}</td>
                            <td>{{ $order->shipping_address['phone'] ?? $order->user?->phone ?? 'N/A' }}</td>
                            <td class="small">
                                {{ $order->shipping_address['address'] ?? 'N/A' }},<br>
                                {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} - {{ $order->shipping_address['pincode'] ?? '' }}
                            </td>
                            <td>
                                <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : ($order->payment_status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
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
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="fas fa-file-invoice"></i> Invoice
                                </a>
                                @if($order->status == 'processing')
                                    <a href="#" class="btn btn-sm btn-primary">Ship</a>
                                @endif
                                @if(in_array($order->status, ['pending', 'processing']))
                                    <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                No orders found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} entries
                </div>
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection