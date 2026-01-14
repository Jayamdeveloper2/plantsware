@extends('admin.layout')

@section('title', 'Create Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Product</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="subcategory_id" class="form-label">Subcategory</label>
                                <select class="form-select" id="subcategory_id" name="subcategory_id">
                                    <option value="">Select Subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" data-category="{{ $subcategory->category_id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sale_price" class="form-label">Sale Price</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 0) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}">
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                        <small class="text-muted">Lower numbers appear first. Used for ordering products on frontend.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="gallery_images" class="form-label">Gallery Images</label>
                        <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured Product</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');
        const oldSubcategoryId = "{{ old('subcategory_id') }}";
        
        // Save all subcategory options for filtering
        const allSubcategoryOptions = Array.from(subcategorySelect.options)
            .filter(option => option.value !== "");

        function filterSubcategories() {
            const selectedCat = categorySelect.value;
            
            // Remove all options except the placeholder
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

            if(!selectedCat) {
                // If no category selected, restore all
                allSubcategoryOptions.forEach(option => {
                    subcategorySelect.appendChild(option.cloneNode(true));
                });
            } else {
                allSubcategoryOptions.forEach(option => {
                    if(option.getAttribute('data-category') == selectedCat) {
                        subcategorySelect.appendChild(option.cloneNode(true));
                    }
                });
            }

            // Try to restore old/selected subcategory
            if (oldSubcategoryId) {
                for (let i = 0; i < subcategorySelect.options.length; i++) {
                    if (subcategorySelect.options[i].value == oldSubcategoryId) {
                        subcategorySelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        // Apply on load in case old('category_id') is set
        filterSubcategories();

        categorySelect.addEventListener('change', function() {
            // Clear previous subcategory selection
            subcategorySelect.selectedIndex = 0;
            filterSubcategories();
        });
    });
</script>
@endsection
