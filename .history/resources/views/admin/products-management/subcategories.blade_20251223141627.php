@extends('admin.layout')

@section('title', 'Subcategories - ' . $category->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
        ← Back to Categories
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Subcategories in "{{ $category->name }}"</h2>
    <a href="{{ route('admin.subcategories.create', ['category' => $category->id]) }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Subcategory
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Sort Order</th>
                    {{-- <th>Status</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subcategories as $subcategory)
                <tr>
                    <td>
                        @if($subcategory->image)
                            <img src="{{ asset('storage/' . $subcategory->image) }}" style="width: 60px; height: 60px; object-fit: cover;">
                        @endif
                    </td>
                    <td><strong>{{ $subcategory->name }}</strong></td>
                    <td>{{ $subcategory->sort_order }}</td>
                    {{-- <td>
                        <span class="badge {{ $subcategory->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td> --}}
                    <td>
                        <a href="{{ route('admin.subcategories.products', $subcategory) }}" class="btn btn-sm btn-outline-primary">
                            View Products &rarr;
                        </a>
                        <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-sm btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                    <td colspan="5" class="text-center">No subcategories yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $subcategories->links() }}
    </div>
</div>
@endsection