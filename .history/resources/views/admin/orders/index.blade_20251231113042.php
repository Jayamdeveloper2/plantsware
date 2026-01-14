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
                            <h4 class="mb-0">{{ $stats['total'] ?? 0 }}</h4>
                            <small class="text-muted">Total Orders</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-warning">{{ $stats['pending'] ?? 0 }}</h4>
                            <small class="text-muted">Pending</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-primary">{{ $stats['shipped'] ?? 0 }}</h4>
                            <small class="text-muted">Shipped</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-info">{{ $stats['processing'] ?? 0 }}</h4>
                            <small class="text-muted">Processing</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-success">{{ $stats['delivered'] ?? 0 }}</h4>
                            <small class="text-muted">Delivered</small>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-danger">{{ $stats['cancelled'] ?? 0 }}</h4>
                            <small class="text-muted">Cancelled</small>
                        </div>
                    </div>
                    <div class="row text-center mt-2">
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <h4 class="mb-0 text-secondary">{{ $stats['returned'] ?? 0 }}</h4>
                            <small class="text-muted">Returned</small>
                        </div>
                        <div class="col-lg-10 col-md-8 col-6 mb-3 text-start small text-muted d-flex align-items-center">
                            <span>
                                Returned Requested: {{ $stats['return_requested'] ?? 0 }} |
                                Returned Approved: {{ $stats['return_approved'] ?? 0 }} |
                                Returned Rejected: {{ $stats['return_rejected'] ?? 0 }}
                            </span>
                        </div>
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
                    <a class="nav-link {{ request('customized') ? '' : 'active' }}" href="{{ route('admin.orders.index', array_merge(request()->except('customized'))) }}">
                        All Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('customized') ? 'active' : '' }}" href="{{ route('admin.orders.index', array_merge(request()->all(), ['customized' => 1])) }}">
                        Customized Orders
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Action Buttons & Filters -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <!--
                        In a real implementation, this button should submit a form to trigger a payment status update,
                        likely opening a modal to select the order(s) and new payment status.
                    -->
                    <button type="button" class="btn btn-warning btn-sm" disabled title="Select orders to change payment status">Change Payment Status</button>
                </div>
                <div class="col-md-6 text-center">
                    <div class="btn-group" role="group">
                        @php
                            $statuses = [
                                '' => ['label' => 'All', 'class' => 'btn-secondary'],
                                'pending' => ['label' => 'Pending', 'class' => 'btn-warning'],
                                'processing' => ['label' => 'Processing', 'class' => 'btn-info'],
                                'shipped' => ['label' => 'Shipped', 'class' => 'btn-primary'],
                                'delivered' => ['label' => 'Delivered', 'class' => 'btn-success'],
                                'cancelled' => ['label' => 'Cancelled', 'class' => 'btn-danger'],
                                'returned' => ['label' => 'Returned', 'class' => 'btn-secondary'],
                            ];
                        @endphp
                        @foreach($statuses as $code => $meta)
                            <a href="{{ route('admin.orders.index', array_merge(request()->except('page'), $code ? ['status' => $code] : ['status' => null])) }}"
                               class="btn btn-sm {{ $meta['class'] }}{{ request('status') === $code || (empty(request('status')) && $code === '') ? ' active' : '' }}">
                                {{ $meta['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <form method="GET" class="d-inline">
                        @foreach(request()->except(['per_page', 'page']) as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <small class="me-2">Show</small>
                        <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm d-inline w-auto">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Search -->
            <div class="row mb-3">
                <div class="col-md-4 offset-md-8">
                    <form method="GET">
                        @foreach(request()->except(['search', 'page']) as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
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
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>{{ $order->user?->name ?? 'Guest' }}</td>
                            <td>
                                {{ $order->shipping_address['phone'] ?? ($order->user?->phone ?? 'N/A') }}
                            </td>
                            <td class="small">
                                {{ $order->shipping_address['address'] ?? 'N/A' }}
                                @if(!empty($order->shipping_address['address']))<br>@endif
                                {{ $order->shipping_address['city'] ?? '' }}
                                @if(!empty($order->shipping_address['city'])),@endif
                                {{ $order->shipping_address['state'] ?? '' }}
                                @if(!empty($order->shipping_address['pincode'])) - {{ $order->shipping_address['pincode'] }}@endif
                            </td>
                            <td>
                                @php
                                    $paymentStatus = $order->payment_status;
                                    $paymentBadge = [
                                        'paid' => 'bg-success',
                                        'pending' => 'bg-warning text-dark',
                                        'failed' => 'bg-danger',
                                        'refunded' => 'bg-info text-dark'
                                    ][$paymentStatus] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $paymentBadge }}">
                                    {{ ucfirst(str_replace('_', ' ', $paymentStatus)) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    if (method_exists($order, 'getStatusBadgeClass')) {
                                        $badgeClass = $order->getStatusBadgeClass();
                                    } else {
                                        $statusColor = [
                                            'pending' => 'bg-warning text-dark',
                                            'processing' => 'bg-info text-dark',
                                            'shipped' => 'bg-primary',
                                            'delivered' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            'returned' => 'bg-secondary'
                                        ][$order->status] ?? 'bg-secondary';
                                        $badgeClass = $statusColor;
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>₹{{ number_format($order->total, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info" title="View Order">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="#" class="btn btn-sm btn-success" title="View Invoice" disabled>
                                    <i class="fas fa-file-invoice"></i> Invoice
                                </a>
                                @if($order->status == 'processing')
                                    <a href="#" class="btn btn-sm btn-primary" disabled title="Ship order (not implemented)">Ship</a>
                                @endif
                                @if(in_array($order->status, ['pending', 'processing']))
                                    <a href="#" class="btn btn-sm btn-danger" disabled title="Cancel order (not implemented)">Cancel</a>
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