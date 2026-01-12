@extends('admin.layout')

@section('title', 'Edit Subcategory')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Subcategory</h2>
    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Subcategory Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subcategory->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $subcategory->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $subcategory->sort_order) }}">
                        <small class="text-muted">Lower numbers appear first. Default: 0</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Subcategory Image</label>
                        @if($subcategory->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $subcategory->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Subcategory</button>
                <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

