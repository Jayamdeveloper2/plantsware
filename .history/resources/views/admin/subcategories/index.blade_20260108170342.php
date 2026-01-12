@extends('admin.layout')

@section('title', 'Subcategories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Subcategories</h2>
    {{-- <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Subcategory
    </a> --}}
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Sort Order</th>
                        {{-- <th>Status</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subcategories as $subcategory)
                    <tr>
                        <td>{{ $subcategory->id }}</td>
                        <td>
                            @if($subcategory->image)
                                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $subcategory->name }}</td>
                        <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
                        <td>{{ $subcategory->sort_order }}</td>
                        {{-- <td>
                            @if($subcategory->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td> --}}
                        <td>
                            <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="7" class="text-center">No subcategories found. 
                            <a href="{{ route('admin.subcategories.create') }}">Create one</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $subcategories->links() }}
        </div>
    </div>
</div>
@endsection

