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
    $categories = Category::orderBy('sort_order')->orderBy('name')->get();
    return view('admin.products-management.subcategories-create', compact('category', 'categories','su'));
}

    // Store new subcategory
    public function storeSubcategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Always trust the form's category_id
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        Subcategory::create($validated);

        // Redirect using the category selected in the form
        $redirectCategory = Category::findOrFail($validated['category_id']);
        return redirect()->route('admin.categories.subcategories', ['category' => $redirectCategory->id])
            ->with('success', 'Subcategory created successfully');
    }

    // Step 3: Show products of a subcategory
    public function products(Subcategory $subcategory)
{
    $perPage = request('per_page', 20);
    $search = request('search');

    $products = $subcategory->products()
        ->with(['category', 'subcategory'])
        ->when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy(
            request('sort', 'sort_order'),
            request('direction', 'asc')
        )
        ->paginate($perPage)
        ->appends(request()->query());

    return view('admin.products-management.products', compact('subcategory', 'products'));
}
}