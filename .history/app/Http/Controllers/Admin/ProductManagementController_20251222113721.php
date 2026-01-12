<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductManagementController extends Controller
{
    // Step 1: Show all categories
    public function categories()
    {
        $categories = Category::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.products-management.categories', compact('categories'));
    }

    // Step 2: Show subcategories of a category
    public function subcategories(Category $category)
    {
        $subcategories = $category->subcategories()->orderBy('sort_order')->paginate(20);
        return view('admin.products-management.subcategories', compact('category', 'subcategories'));
    }

    // Show form to add subcategory
    public function createSubcategory(Category $category)
    {
        return view('admin.products-management.subcategories-create', compact('category'));
    }

    // Store new subcategory
    public function storeSubcategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['category_id'] = $category->id;
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        Subcategory::create($validated);

        return redirect()->route('admin.categories.subcategories', $category)
            ->with('success', 'Subcategory created successfully');
    }

    // Step 3: Show products of a subcategory
    public function products(Subcategory $subcategory)
    {
        $products = $subcategory->products()
            ->with(['category', 'subcategory'])
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.products-management.products', compact('subcategory', 'products'));
    }
}