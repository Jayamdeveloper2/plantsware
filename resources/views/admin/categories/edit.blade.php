@extends('admin.layout')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Category</h2>
    <a href="{{ route('admin.products.management') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="badge_type" class="form-label">Badge Type</label>
                                <select class="form-select" id="badge_type" name="badge_type">
                                    <option value="">None</option>
                                    <option value="sale" {{ old('badge_type', $category->badge_type) == 'sale' ? 'selected' : '' }}>Sale</option>
                                    <option value="new" {{ old('badge_type', $category->badge_type) == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="offer" {{ old('badge_type', $category->badge_type) == 'offer' ? 'selected' : '' }}>Offer</option>
                                    <option value="combo" {{ old('badge_type', $category->badge_type) == 'combo' ? 'selected' : '' }}>Combo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        @if($category->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    {{-- <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} onchange="document.getElementById('activeStatusLabel').innerText = this.checked ? 'Active' : 'Inactive';">
                            <label class="form-check-label" for="is_active">
                                <span id="activeStatusLabel">{{ old('is_active', true) ? 'Active' : 'Inactive' }}</span>
                            </label>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('admin.products.management') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

