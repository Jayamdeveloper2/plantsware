@extends('admin.layout')

@section('title', 'Products Management')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
        ← Back to All Products
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

@include('admin.products.index')
@endsection