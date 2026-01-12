@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')
<style>
    .order-status-btn {
        border: 1.5px solid transparent;
        background-color: #fff;
        color: #6c757d;
        font-weight: 500;
        border-radius: 6px;
        margin-right: 6px;
        margin-bottom: 6px;
        transition: all 0.2s;
        box-shadow: none;
    }
    .order-status-btn.active, .order-status-btn:focus {
        color: #fff !important;
    }
    .order-status-btn.status-all {
        border-color: #adb5bd;
        color: #495057;
        background: #adb5bd;
    }
    .order-status-btn.status-processing {
        border-color: #a48cff;
        color: #7e57c2;
        background: #f6f0ff;
    }
    .order-status-btn.status-processing.active,
    .order-status-btn.status-processing:focus {
        background: #a48cff !important;
        color: #fff !important;
        border-color: #a48cff !important;
    }

    .order-status-btn.status-shipped {
        border-color: #42a5f5;
        color: #1976d2;
        background: #e3f2fd;
    }
    .order-status-btn.status-shipped.active,
    .order-status-btn.status-shipped:focus {
        background: #42a5f5 !important;
        color: #fff !important;
        border-color: #42a5f5 !important;
    }

    .order-status-btn.status-delivered {
        border-color: #66bb6a;
        color: #388e3c;
        background: #e8f5e9;
    }
    .order-status-btn.status-delivered.active,
    .order-status-btn.status-delivered:focus {
        background: #66bb6a !important;
        color: #fff !important;
        border-color: #66bb6a !important;
    }

    .order-status-btn.status-cancelled {
        border-color: #ef9a9a;
        color: #e53935;
        background: #ffebee;
    }
    .order-status-btn.status-cancelled.active,
    .order-status-btn.status-cancelled:focus {
        background: #e57373 !important;
        color: #fff !important;
        border-color: #e57373 !important;
    }

    .order-status-btn.status-returned {
        border-color: #ffb74d;
        color: #ffa000;
        background: #fff8e1;
    }
    .order-status-btn.status-returned.active,
    .order-status-btn.status-returned:focus {
        background: #ffb74d !important;
        color: #fff !important;
        border-color: #ffb74d !important;
    }
</style>
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
                    
                    <div class="d-inline-flex flex-wrap" role="group">
                        @php
                            $statuses = [
                                '' => ['label' => 'All', 'class' => 'status-all'],
                                'processing' => ['label' => 'Processing', 'class' => 'status-processing'],
                                'shipped' => ['label' => 'Shipped', 'class' => 'status-shipped'],
                                'delivered' => ['label' => 'Delivered', 'class' => 'status-delivered'],
                                'cancelled' => ['label' => 'Cancelled', 'class' => 'status-cancelled'],
                                'returned' => ['label' => 'Returned', 'class' => 'status-returned'],
                            ];
                            $currentStatus = request('status') ?: '';
                        @endphp
                        @foreach($statuses as $code => $meta)
                            <a href="{{ route('admin.orders.index', array_merge(request()->except('page'), $code ? ['status' => $code] : ['status' => null])) }}"
                               class="order-status-btn btn btn-sm {{ $meta['class'] }}{{ $currentStatus === $code ? ' active' : '' }}">
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
            <style>
                .orders-pro-table th, .orders-pro-table td {
                    vertical-align: middle !important;
                }
                .orders-pro-table thead th {
                    white-space: nowrap;
                }
                .orders-pro-table .text-truncate {
                    max-width: 180px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                }
                .orders-pro-table .order-badge {
                    font-size: 0.9rem;
                    border-radius: 50rem !important;
                    padding: 0.35em 0.9em;
                }
                .orders-pro-table .pro-action-btns .btn {
                    min-width: 32px;
                }
            </style>
            <div class="table-responsive rounded-3 shadow-sm border">
                <table class="table orders-pro-table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr class="align-middle text-center">
                            <th scope="col" style="width:44px;">#</th>
                            <th scope="col">Order&nbsp;Number</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Shipping Address</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="min-width:110px;">Total</th>
                            <th scope="col" style="min-width:130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="text-center align-middle">
                                <td>
                                    <span class="text-muted">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">{{ $order->order_number }}</span>
                                    <div class="text-muted small">#{{ $order->id }}</div>
                                    <div class="text-muted small">Placed: {{ $order->created_at->format('d M, Y') }}</div>
                                </td>
                                <td>
                                    @if($order->user)
                                        <span class="fw-semibold text-dark">
                                            {{ $order->user->name }}
                                        </span>
                                        <div class="small text-muted text-truncate">{{ $order->user->email }}</div>
                                    @else
                                        <span class="badge bg-secondary order-badge">Guest</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-wrap">{{ $order->shipping_address['phone'] ?? ($order->user?->phone ?? 'N/A') }}</span>
                                    @php $mobileEmail = $order->user?->email ?? null; @endphp
                                    @if($mobileEmail)
                                        <div class="text-muted small text-truncate">{{ $mobileEmail }}</div>
                                    @endif
                                </td>
                                <td class="text-start small">
                                    @php $addr = $order->shipping_address; @endphp
                                    <div>
                                        <span class="fw-semibold">{{ $addr['address'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="text-muted">
                                        {{ $addr['city'] ?? '' }}@if(!empty($addr['city'])), @endif
                                        {{ $addr['state'] ?? '' }}
                                        @if(!empty($addr['pincode'])) - {{ $addr['pincode'] }}@endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $paymentStatus = $order->payment_status;
                                        $paymentBadges = [
                                            'paid' => 'bg-success',
                                            'pending' => 'bg-warning text-dark',
                                            'failed' => 'bg-danger',
                                            'refunded' => 'bg-info text-dark'
                                        ];
                                        $pBadge = $paymentBadges[$paymentStatus] ?? 'bg-secondary';
                                        $paymentLabel = ucfirst(str_replace('_', ' ', $paymentStatus));
                                        $methodLabel = strtoupper(str_replace('_', ' ', $order->payment_method ?? ''));
                                    @endphp
                                    <span class="badge order-badge {{ $pBadge }}">
                                        {{ $paymentLabel }}
                                    </span>
                                    @if($order->payment_method)
                                        <div class="text-muted small mt-1">{{ $methodLabel }}</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        if (method_exists($order, 'getStatusBadgeClass')) {
                                            $oStatusBadge = $order->getStatusBadgeClass();
                                        } else {
                                            $oStatusBadge = [
                                                'pending' => 'bg-warning text-dark',
                                                'processing' => 'bg-info text-dark',
                                                'shipped' => 'bg-primary',
                                                'delivered' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                'returned' => 'bg-secondary'
                                            ][$order->status] ?? 'bg-secondary';
                                        }
                                    @endphp
                                    <span class="badge order-badge {{ $oStatusBadge }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                    <div class="small text-muted mt-1">Items: <b>{{ $order->items_count ?? ($order->items->count() ?? '-') }}</b></div>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">₹{{ number_format($order->total, 2) }}</span>
                                    <div class="text-muted small">
                                        <span class="me-1">Subtotal: ₹{{ number_format($order->subtotal, 2) }}</span>
                                        @if($order->tax > 0)
                                            <span class="me-1">Tax: ₹{{ number_format($order->tax, 2) }}</span>
                                        @endif
                                        @if($order->shipping > 0)
                                            <span>Shipping: ₹{{ number_format($order->shipping, 2) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex pro-action-btns gap-1 justify-content-center">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-primary btn-sm" title="View Order">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-secondary btn-sm" title="View Invoice" disabled>
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                        @if($order->status === 'processing')
                                            <a href="#" class="btn btn-outline-primary btn-sm" disabled title="Ship order (not implemented)">
                                                <i class="fas fa-shipping-fast"></i>
                                            </a>
                                        @endif
                                        @if(in_array($order->status, ['pending', 'processing']))
                                            <a href="#" class="btn btn-outline-danger btn-sm" disabled title="Cancel order (not implemented)">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                    <span>No orders found.</span>
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