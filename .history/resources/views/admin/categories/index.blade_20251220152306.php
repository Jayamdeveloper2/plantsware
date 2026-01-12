@extends('admin.layout')

@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Category
    </a>
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
                        <th>Badge</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if($category->badge_type)
                                <span class="badge bg-info">{{ ucfirst($category->badge_type) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="6" class="text-center">No categories found. <a href="{{ route('admin.categories.create') }}">Create one</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection

