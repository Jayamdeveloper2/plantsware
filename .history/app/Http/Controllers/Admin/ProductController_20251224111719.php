<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.products-management.products', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $subcategories = Subcategory::where('is_active', true)->get();
        return view('admin.products.create',  compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'stock_quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        Product::create($validated);

        if (isset($validated['subcategory_id'])) {
            return redirect()->route('admin.subcategories.products', $validated['subcategory_id'])->with('success', 'Product created successfully');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        // Get subcategories - filter by product's category if set, otherwise show all
        $subcategories = $product->category_id 
            ? Subcategory::where('category_id', $product->category_id)->where('is_active', true)->orderBy('sort_order')->get()
            : Subcategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'size' => 'nullable|string|max:50',
            'shape' => 'nullable|string|in:Circular,Rectangular,Square',  // Enforce options
            'material' => 'nullable|string|in:HDPE,Fabric,Non-woven',
            'color' => 'nullable|string|max:50',
            'gsm' => 'nullable|integer|min:0',
            'has_handles' => 'boolean',
            'uv_treated' => 'boolean',
            'shade_percentage' => 'nullable|string|max:50',
            'width_meters' => 'nullable|numeric|min:0',
            'length_meters' => 'nullable|numeric|min:0',
            'pack_quantity' => 'integer|min:1',
            'warranty_months' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            if ($product->gallery_images) {
                foreach ($product->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        $product->update($validated);

        return redirect()->route('admin.subcategories.products', $product->subcategory_id)->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
{
    // Optional: Check if product exists (extra safety)
    if (!$product->exists) {
        return redirect()->route('admin.products.management') // or 'admin.products.index'
            ->with('error', 'Product not found.');
    }

    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }
    if ($product->gallery_images) {
        foreach ($product->gallery_images as $image) {
            Storage::disk('public')->delete($image);
        }
    }

    $product->delete();

    // Redirect to a safe list page (hierarchical or flat)
    return redirect()->route('admin.products.management') // Main categories page
        ->with('success', 'Product deleted successfully');
}
}