@extends('admin.layout')

@section('title', 'Add Subcategory to ' . $category->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.products.management') }}" class="btn btn-secondary">
        ← Back to Categories
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h2 class="mb-4">Add Subcategory</h2>
        <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- Category select (show for reference, preselect current category) --}}
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category *</label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $category->id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Name --}}
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Subcategory Name *</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control"
                        value="{{ old('sort_order', 0) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Subcategory Image</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            {{-- Active toggle --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                    value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Create Subcategory</button>
        </form>
    </div>
</div>
@endsection