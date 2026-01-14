@extends('admin.layout')

@section('title', 'Products - ' . ($subcategory->name ?? ''))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.categories.subcategories', ['category' => $subcategory->category_id]) }}" class="text-decoration-none">
        ← Back to Subcategories
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products in "{{ $subcategory->name }}"</h2>
    <a href="{{ route('admin.products.create') }}?subcategory_id={{ $subcategory->id }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

@include('admin.products.index') {{-- Reuse your existing products table, but it will only show filtered products via controller --}}
@endsection