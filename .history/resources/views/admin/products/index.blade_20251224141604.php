@extends('admin.layout')

@section('title', 'Products - ' . ($subcategory->name ?? 'All'))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.categories.subcategories', $subcategory->category) }}" class="text-decoration-none">
        ← Back to Subcategories
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products in "{{ $subcategory->name }}"</h2>
    <a href="{{ route('admin.products.create') }}?subcategory_id={{ $subcategory->id }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<div class="card">
    <div class="card-body">
        <!-- Search & Per Page Controls -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="{{ route('admin.subcategories.products', $subcategory) }}" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products by name..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <form method="GET" action="{{ route('admin.subcategories.products', $subcategory) }}" class="d-inline">
                    <label class="me-2 text-muted">Show</label>
                    <select name="per_page" onchange="this.form.submit()" class="form-select d-inline w-auto">
                        <option value="10" {{ request('per_page', 20) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 20) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 20) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page', 20) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <input type="hidden" name="direction" value="{{ request('direction') }}">
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>S.NO</th>
                        <th>Image</th>
                        <th>
                            <a href="{{ route('admin.subcategories.products', $subcategory) }}?sort=name&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&per_page={{ request('per_page') }}" class="text-dark text-decoration-none">
                                Name
                                @if(request('sort') == 'name')
                                    <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </a>
                        </th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>
                            <a href="{{ route('admin.subcategories.products', $subcategory) }}?sort=price&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&per_page={{ request('per_page') }}" class="text-dark text-decoration-none">
                                Price
                                @if(request('sort') == 'price')
                                    <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.subcategories.products', $subcategory) }}?sort=stock_quantity&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&per_page={{ request('per_page') }}" class="text-dark text-decoration-none">
                                Stock
                                @if(request('sort') == 'stock_quantity')
                                    <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.subcategories.products', $subcategory) }}?sort=sort_order&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&per_page={{ request('per_page') }}" class="text-dark text-decoration-none">
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
                    @forelse($products as $product)
                    <tr>
                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light border d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                    <i class="fas fa-image text-muted fa-lg"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="badge {{ $product->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->stock_quantity }}
                            </span>
                        </td>
                        <td>{{ $product->sort_order ?? 0 }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
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
                        <td colspan="9" class="text-center py-5 text-muted">
                            No products found in this subcategory.
                            <a href="{{ route('admin.products.create') }}?subcategory_id={{ $subcategory->id }}" class="d-block mt-2">
                                <i class="fas fa-plus"></i> Add your first product
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination & Info -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
            </div>
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection