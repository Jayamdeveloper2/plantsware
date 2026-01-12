@extends('admin.layout')

@section('title', 'Product Management - Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Category
    </a>
</div>

<div class="card">
    <div class="card-body">
        <!-- Search & Filters -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('admin.products.management') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <form action="{{ route('admin.products.management') }}" method="GET" class="d-inline">
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
                            <a href="{{ route('admin.products.management', ['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'per_page' => request('per_page')]) }}" class="text-dark text-decoration-none">
                                Name
                                @if(request('sort') == 'name')
                                    <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </a>
                        </th>
                        <th>Badge</th>
                        <th>
                            <a href="{{ route('admin.products.management', ['sort' => 'sort_order', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'per_page' => request('per_page')]) }}" class="text-dark text-decoration-none">
                                Sort Order
                                @if(request('sort') == 'sort_order')
                                    <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light border d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 8px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>
                            @if($category->badge_type)
                                <span class="badge bg-info">{{ ucfirst($category->badge_type) }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $category->sort_order ?? 0 }}</td>
                        <td>
                            <a href="{{ route('admin.productsubcategories.index', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-primary">
                                View Subcategories →
                            </a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No categories found. <a href="{{ route('admin.categories.create') }}">Create one now</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries
            </div>
            {{ $categories->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection