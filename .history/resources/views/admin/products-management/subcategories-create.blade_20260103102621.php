@extends('admin.layout')

@php
    // Try to get $category from session or request if not set
    if (!isset($category)) {
        $categoryId = request()->input('category') ?? request()->route('category');
        if ($categoryId) {
            $category = \App\Models\Category::find($categoryId);
        }
    }
    // Initialize $subcategories if not defined
    if (!isset($subcategories)) {
        $query = \App\Models\Subcategory::query();
        if (!empty($category)) {
            $query->where('category_id', $category->id);
        }
        if ($search = request('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        // Sorting
        $sort = request('sort', 'name');
        $direction = request('direction', 'asc');
        $allowedSorts = ['name', 'sort_order'];
        $sort = in_array($sort, $allowedSorts) ? $sort : 'name';
        $direction = $direction === 'desc' ? 'desc' : 'asc';
        $query->orderBy($sort, $direction);

        $perPage = intval(request('per_page', 20));
        $perPage = in_array($perPage, [10,25,50,100]) ? $perPage : 20;
        $subcategories = $query->paginate($perPage)->appends(request()->query());
    }
@endphp

@section('title', 'Subcategories - ' . ($category->name ?? 'Unknown Category'))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.products.management') }}" class="text-decoration-none text-muted">
        ← Back to Categories
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        Subcategories in "{{ $category->name ?? 'Unknown Category' }}"
    </h2>
    @if(!empty($category))
    <a href="{{ route('admin.subcategories.create', ['category' => $category->id]) }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Subcategory
    </a>
    @endif
</div>

<div class="card">
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

        <div class="d-flex justify-content-between mt-3">
            <div>Showing {{ $subcategories->firstItem() }} to {{ $subcategories->lastItem() }} of {{ $subcategories->total() }}</div>
            {{ $subcategories->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection