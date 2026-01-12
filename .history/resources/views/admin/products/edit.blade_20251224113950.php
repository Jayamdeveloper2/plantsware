@extends('admin.layout')

@section('title', 'Edit Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Product</h2>
    <a href="{{ route('admin.subcategories.products', $product->subcategory_id) }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column: Main Details + Attributes -->
                <div class="col-md-8">

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                        <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sale_price" class="form-label">Sale Price</label>
                                <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}">
                                <small class="text-muted">Lower numbers appear first on frontend.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Product Attributes Section -->
                    <hr class="my-5">
                    <h4 class="mb-4">Product Attributes</h4>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" class="form-control" id="size" name="size" value="{{ old('size', $product->size) }}" placeholder="e.g., 12x12 inch or 10 Gallon">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="shape" class="form-label">Shape</label>
                                <select class="form-select" id="shape" name="shape">
                                    <option value="">Select Shape</option>
                                    <option value="Circular" {{ old('shape', $product->shape) == 'Circular' ? 'selected' : '' }}>Circular</option>
                                    <option value="Rectangular" {{ old('shape', $product->shape) == 'Rectangular' ? 'selected' : '' }}>Rectangular</option>
                                    <option value="Square" {{ old('shape', $product->shape) == 'Square' ? 'selected' : '' }}>Square</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="material" class="form-label">Material</label>
                                <select class="form-select" id="material" name="material">
                                    <option value="">Select Material</option>
                                    <option value="HDPE" {{ old('material', $product->material) == 'HDPE' ? 'selected' : '' }}>HDPE</option>
                                    <option value="Fabric" {{ old('material', $product->material) == 'Fabric' ? 'selected' : '' }}>Fabric</option>
                                    <option value="Non-woven" {{ old('material', $product->material) == 'Non-woven' ? 'selected' : '' }}>Non-woven</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $product->color) }}" placeholder="e.g., Green, Black">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="gsm" class="form-label">GSM (Thickness)</label>
                                <input type="number" class="form-control" id="gsm" name="gsm" value="{{ old('gsm', $product->gsm) }}" min="0" placeholder="e.g., 220">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="shade_percentage" class="form-label">Shade Percentage</label>
                                <input type="text" class="form-control" id="shade_percentage" name="shade_percentage" value="{{ old('shade_percentage', $product->shade_percentage) }}" placeholder="e.g., 50%, 75%">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3 form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="has_handles" name="has_handles" value="1" {{ old('has_handles', $product->has_handles) ? 'checked' : '' }}>
                                <label class="form-check-label" for="has_handles">Has Handles</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="uv_treated" name="uv_treated" value="1" {{ old('uv_treated', $product->uv_treated) ? 'checked' : '' }}>
                                <label class="form-check-label" for="uv_treated">UV Treated</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="pack_quantity" class="form-label">Pack Quantity</label>
                                <input type="number" class="form-control" id="pack_quantity" name="pack_quantity" value="{{ old('pack_quantity', $product->pack_quantity ?? 1) }}" min="1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="warranty_months" class="form-label">Warranty (months)</label>
                                <input type="number" class="form-control" id="warranty_months" name="warranty_months" value="{{ old('warranty_months', $product->warranty_months) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="width_meters" class="form-label">Width (meters) - for shade nets</label>
                                <input type="number" step="0.01" class="form-control" id="width_meters" name="width_meters" value="{{ old('width_meters', $product->width_meters) }}" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="length_meters" class="form-label">Length (meters) - for shade nets</label>
                                <input type="number" step="0.01" class="form-control" id="length_meters" name="length_meters" value="{{ old('length_meters', $product->length_meters) }}" min="0">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Images & Flags -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Main Product Image</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 200px; height: auto;">
                                <small class="text-muted d-block mt-1">Current image</small>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="mb-3">
                        <label for="gallery_images" class="form-label">Add More Gallery Images</label>
                        <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                        <small class="text-muted">Hold Ctrl/Cmd to select multiple. Existing gallery images remain unless deleted separately.</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Mark as Featured Product</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-5 text-end">
                <a href="{{ route('admin.subcategories.products', $product->subcategory_id) }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Dynamic subcategory filtering based on selected category (preserves current selection on edit)
    const allSubcategories = @json($subcategories);
    const currentCategoryId = "{{ old('category_id', $product->category_id) }}";
    const currentSubcategoryId = "{{ old('subcategory_id', $product->subcategory_id) }}";

    function populateSubcategories(categoryId) {
        const subcategorySelect = document.getElementById('subcategory_id');
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        const filtered = allSubcategories.filter(sub => sub.category_id == categoryId);

        filtered.forEach(sub => {
            const option = document.createElement('option');
            option.value = sub.id;
            option.textContent = sub.name;
            if (sub.id == currentSubcategoryId) option.selected = true;
            subcategorySelect.appendChild(option);
        });
    }

    // On page load: populate subcategories if category is already selected
    if (currentCategoryId) {
        populateSubcategories(currentCategoryId);
    }

    // On category change
    document.getElementById('category_id').addEventListener('change', function() {
        populateSubcategories(this.value);
    });
</script>
@endsection