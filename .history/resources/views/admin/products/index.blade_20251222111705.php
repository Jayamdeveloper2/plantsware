@extends('admin.layout')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Product Management</h2>
    <div>
        <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#manageCategoriesModal">
            Manage Categories
        </button>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>{{ $product->sort_order }}</td>
                        <td>
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">No products found. <a href="{{ route('admin.products.create') }}">Create one</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $products->links() }}
        </div>
        <div class="modal fade" id="manageCategoriesModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Manage Categories & Subcategories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6>Add New Category</h6>
                            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Category Name" required>
                                </div>
                                <div class="col-md-3">
                                    <select name="badge_type" class="form-select form-select-sm">
                                        <option value="">No Badge</option>
                                        <option value="sale">Sale</option>
                                        <option value="new">New</option>
                                        <option value="offer">Offer</option>
                                        <option value="combo">Combo</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-sm">Add Category</button>
                                </div>
                            </form>
                        </div>
        
                        <hr>
        
                        <h6>Categories</h6>
                        <div class="accordion" id="categoriesAccordion">
                            @foreach(\App\Models\Category::orderBy('sort_order')->get() as $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $category->id }}">
                                        {{ $category->name }}
                                        @if($category->badge_type)
                                            <span class="badge bg-info ms-2">{{ ucfirst($category->badge_type) }}</span>
                                        @endif
                                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }} ms-2">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    data-bs-parent="#categoriesAccordion">
                                    <div class="accordion-body">
                                        <!-- Add Subcategory Form -->
                                        <form action="{{ route('admin.subcategories.store') }}" method="POST" class="mb-3">
                                            @csrf
                                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="name" class="form-control" placeholder="New Subcategory Name" required>
                                                <button type="submit" class="btn btn-outline-primary">Add Subcategory</button>
                                            </div>
                                        </form>
        
                                        <!-- List Subcategories -->
                                        <ul class="list-group list-group-flush">
                                            @foreach($category->subcategories()->orderBy('sort_order')->get() as $subcat)
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                {{ $subcat->name }}
                                                <span class="badge {{ $subcat->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $subcat->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </li>
                                            @endforeach
                                            @if($category->subcategories()->orderBy('sort_order')->count() == 0)
                                            <li class="text-muted small">No subcategories yet</li>
                                            @endif
                                            {{-- <li class="text-muted small">No subcategories yet</li> --}}
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Manage Categories Modal -->

@endsection

