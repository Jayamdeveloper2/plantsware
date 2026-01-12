@extends('admin.layout')

@section('title', 'Products - ' . ($subcategory->name ?? 'All'))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.categories.subcategories', $subcategory->category) }}" class="text-decoration-none text-muted">
        ← Back to Subcategories
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products in "{{ $subcategory->name }}"</h2>
    <a href="{{ route('admin.products.create') }}?subcategory_id={{ $subcategory->id }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

@include('admin.products-management.products-table', ['products' => $products])
<!-- We'll create this partial next if needed, or just keep using index -->
@endsection