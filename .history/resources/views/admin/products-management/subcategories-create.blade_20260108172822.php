@extends('admin.layout')

@section('title', $category ? 'Subcategories - ' . $category->name : 'Create New Subcategory')

@section('content')
<div class="mb-4">
    <a href="{{ $category 
        ? route('admin.categories.subcategories', $category) 
        : route('admin.products.management') }}" 
       class="text-decoration-none text-muted">
        ← Back to {{ $category ? $category->name : 'Categories' }}
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        @if($category)
            Subcategories in "{{ $category->name }}"
        @else
            Create New Subcategory
        @endif
    </h2>

    <div>
        @if($category)
            <a href="{{ route('admin.categories.subcategories.create', $category) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Subcategory
            </a>
        @else
            <span class="text-muted">Select a category first to add a subcategory</span>
        @endif
    </div>
</div>

{{-- Only show the subcategories list table when we have $subcategories (i.e., inside a category) --}}
@if(isset($subcategories))
<div class="card mb-4">
    <div class="card-body">
        <!-- Search & Per Page -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search subcategories..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <form method="GET" class="d-inline">
                    <label class="me-2">Show</label>
                    <select name="per_page" onchange="this.form.submit()" class="form-select d-inline w-auto">
                        <option value="10" {{ request('per_page', 20) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 20) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 20) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page', 20) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>
                            <a href="?sort=name&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&per_page={{ request('per_page') }}" class="text-dark text-decoration-none">
                                Name
                                @if(request('sort') == 'name') <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i> @endif
                            </a>
                        </th>
                        <th>
                            <a href="?sort=sort_order&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&per_page={{ request('per_page') }}" class="text-dark text-decoration-none">
                                Sort Order
                                @if(request('sort') == 'sort_order') <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i> @endif
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subcategories as $subcategory)
                    <tr>
                        <td>
                            @if($subcategory->image)
                                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light border d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 8px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $subcategory->name }}</strong></td>
                        <td>{{ $subcategory->sort_order ?? 0 }}</td>
                        <td>
                            <a href="{{ route('admin.subcategories.products', $subcategory) }}" class="btn btn-sm btn-outline-primary">
                                View Products →
                            </a>
                            <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subcategory?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No subcategories yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subcategories->hasPages())
        <div class="d-flex justify-content-between mt-3">
            <div>Showing {{ $subcategories->firstItem() }} to {{ $subcategories->lastItem() }} of {{ $subcategories->total() }}</div>
            {{ $subcategories->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endif

{{-- Create Form - Always shown --}}
<div class="card">
    <div class="card-header">
        <h5>{{ $category ? 'Add New Subcategory' : 'Create New Subcategory' }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ $category 
            ? route('admin.categories.subcategories.store', $category) 
            : route('admin.subcategories.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    @if(!$category)
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Parent Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <div class="alert alert-info">
                            Subcategory will be added under <strong>{{ $category->name }}</strong>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="sort_order" value="{{ old('sort_order') }}">
                        <small class="text-muted">Lower numbers appear first (default: 0)</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ $category ? 'Add Subcategory' : 'Create Subcategory' }}
                </button>
                <a href="{{ $category ? route('admin.categories.subcategories', $category) : route('admin.products.management') }}" 
                   class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection