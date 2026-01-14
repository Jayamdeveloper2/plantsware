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
                /* Professional, modern order table style */
                .orders-table-pro {
                    background: #fff;
                    border-radius: 14px;
                    overflow: hidden;
                    box-shadow: 0 2px 8px 0 rgba(60,60,60,0.08);
                }
                .orders-table-pro thead th {
                    background: #f7f8fa;
                    font-weight: 600;
                    color: #34395e;
                    border: none;
                    font-size: 0.97rem;
                    letter-spacing: .01em;
                    padding-top: 0.9rem;
                    padding-bottom: 0.9rem;
                }
                .orders-table-pro th, .orders-table-pro td {
                    vertical-align: middle !important;
                    border-bottom: 1px solid #eee !important;
                    font-size: 0.97rem;
                }
                .orders-table-pro tbody tr:last-child td {
                    border-bottom: none !important;
                }
                .orders-table-pro .text-truncate-2 {
                    max-width: 190px;
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                }
                .orders-table-pro .order-id {
                    color: #3658bf;
                    font-weight: 700;
                    letter-spacing: .01em;
                }
                .orders-table-pro .customer-name {
                    font-weight: 500;
                    color: #26304e;
                }
                .orders-table-pro .badge {
                    border-radius: 36px !important;
                    padding: 0.33em 0.9em;
                    font-size: 0.92em;
                    font-weight: 500;
                    letter-spacing: .01em;
                }
                .orders-table-pro .actions .btn {
                    min-width: 36px;
                    height: 32px;
                    padding: 0 0.4rem;
                    font-size: 15px;
                }
                .orders-table-pro .actions .btn + .btn {
                    margin-left: 0.25rem;
                }
                @media (max-width: 991px) {
                    .orders-table-pro .text-truncate-2 {max-width:120px;}
                }
            </style>
            <div class="table-responsive orders-table-wrapper">
                <table class="table table-borderless orders-table-pro mb-0">
                    <thead>
                        <tr class="align-middle text-center">
                            <th style="width:40px;">#</th>
                            <th style="min-width:115px;">Order No</th>
                            <th style="min-width:120px;">Customer</th>
                            <th style="min-width:115px;">Mobile</th>
                            <th style="min-width:180px;">Address</th>
                            <th style="min-width:120px;">Payment</th>
                            <th style="min-width:120px;">Order Status</th>
                            <th style="min-width:110px;">Total</th>
                            <th style="min-width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="align-middle text-center">
                            <td class="text-muted fw-medium">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="order-id">{{ $order->order_number }}</div>
                                <div class="small text-muted">#{{ $order->id }}</div>
                                <div class="small text-secondary">{{ $order->created_at->format('d M, Y') }}</div>
                            </td>
                            <td>
                                <div class="customer-name">{{ $order->user?->name ?? 'Guest' }}</div>
                                @if($order->user && $order->user->email)
                                <div class="small text-secondary text-truncate-2">
                                    <i class="fas fa-envelope me-1"></i>{{ $order->user->email }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <span>
                                    <i class="fas fa-phone-alt me-1 text-info"></i>
                                    {{ $order->shipping_address['phone'] ?? ($order->user?->phone ?? 'N/A') }}
                                </span>
                            </td>
                            <td class="text-start small text-truncate-2">
                                @php $addr = $order->shipping_address; @endphp
                                <div class="fw-semibold">{{ $addr['address'] ?? 'N/A' }}</div>
                                <div class="text-secondary">
                                    {{ $addr['city'] ?? '' }}@if(!empty($addr['city'])), @endif
                                    {{ $addr['state'] ?? '' }}
                                    @if(!empty($addr['pincode']))
                                        - {{ $addr['pincode'] }}
                                    @endif
                                </div>
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
                                    $pm = $order->payment_method ? strtoupper(str_replace('_', ' ', $order->payment_method)) : '';
                                @endphp
                                <span class="badge {{ $paymentBadge }}">
                                    {{ ucfirst($paymentStatus) }}
                                </span>
                                @if($pm)
                                    <div class="small text-muted mt-1">{{ $pm }}</div>
                                @endif
                            </td>
                            <td>
                                @php
                                    if (method_exists($order, 'getStatusBadgeClass')) {
                                        $badgeClass = $order->getStatusBadgeClass();
                                    } else {
                                        $badgeClass = [
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