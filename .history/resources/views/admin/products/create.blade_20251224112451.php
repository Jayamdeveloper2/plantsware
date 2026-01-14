@extends('admin.layout')

@section('title', 'Create Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Product</h2>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
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
                                <select class="form-select" id="category_id" name="category_id">
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
                                        <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
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
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sale_price" class="form-label">Sale Price</label>
                                <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 0) }}">
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

                <!-- After existing fields like price, sale_price, etc. -->

<h4 class="mt-4">Product Attributes</h4>
<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            <label for="size" class="form-label">Size</label>
            <input type="text" class="form-control" id="size" name="size" value="{{ old('size', $product->size ?? '') }}" placeholder="e.g., 10 Gallon">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="shape" class="form-label">Shape</label>
            <select class="form-select" id="shape" name="shape">
                <option value="">Select Shape</option>
                <option value="Circular" {{ old('shape', $product->shape ?? '') == 'Circular' ? 'selected' : '' }}>Circular</option>
                <option value="Rectangular" {{ old('shape', $product->shape ?? '') == 'Rectangular' ? 'selected' : '' }}>Rectangular</option>
                <option value="Square" {{ old('shape', $product->shape ?? '') == 'Square' ? 'selected' : '' }}>Square</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="material" class="form-label">Material</label>
            <select class="form-select" id="material" name="material">
                <option value="">Select Material</option>
                <option value="HDPE" {{ old('material', $product->material ?? '') == 'HDPE' ? 'selected' : '' }}>HDPE</option>
                <option value="Fabric" {{ old('material', $product->material ?? '') == 'Fabric' ? 'selected' : '' }}>Fabric</option>
                <option value="Non-woven" {{ old('material', $product->material ?? '') == 'Non-woven' ? 'selected' : '' }}>Non-woven</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $product->color ?? '') }}" placeholder="e.g., Green">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            <label for="gsm" class="form-label">GSM (Thickness)</label>
            <input type="number" class="form-control" id="gsm" name="gsm" value="{{ old('gsm', $product->gsm ?? '') }}" min="0">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3 form-check mt-4">
            <input type="checkbox" class="form-check-input" id="has_handles" name="has_handles" value="1" {{ old('has_handles', $product->has_handles ?? 0) ? 'checked' : '' }}>
            <label class="form-check-label" for="has_handles">Has Handles</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3 form-check mt-4">
            <input type="checkbox" class="form-check-input" id="uv_treated" name="uv_treated" value="1" {{ old('uv_treated', $product->uv_treated ?? 0) ? 'checked' : '' }}>
            <label class="form-check-label" for="uv_treated">UV Treated</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="shade_percentage" class="form-label">Shade Percentage</label>
            <input type="text" class="form-control" id="shade_percentage" name="shade_percentage" value="{{ old('shade_percentage', $product->shade_percentage ?? '') }}" placeholder="e.g., 50%">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            <label for="width_meters" class="form-label">Width (meters)</label>
            <input type="number" step="0.01" class="form-control" id="width_meters" name="width_meters" value="{{ old('width_meters', $product->width_meters ?? '') }}" min="0">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="length_meters" class="form-label">Length (meters)</label>
            <input type="number" step="0.01" class="form-control" id="length_meters" name="length_meters" value="{{ old('length_meters', $product->length_meters ?? '') }}" min="0">
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
            <input type="number" class="form-control" id="warranty_months" name="warranty_months" value="{{ old('warranty_months', $product->warranty_months ?? '') }}" min="0">
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

                    {{-- <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div> --}}
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
    // Store all subcategories for filtering
    const allSubcategories = @json($subcategories);
    
    // Filter subcategories based on selected category
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategorySelect = document.getElementById('subcategory_id');
        
        // Clear existing options except the first one
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
        
        // Filter and add subcategories for the selected category
        const filteredSubcategories = allSubcategories.filter(sub => sub.category_id == categoryId);
        
        filteredSubcategories.forEach(subcategory => {
            const option = document.createElement('option');
            option.value = subcategory.id;
            option.textContent = subcategory.name;
            subcategorySelect.appendChild(option);
        });
    });
</script>
@endsection

