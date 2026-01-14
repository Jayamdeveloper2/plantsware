<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    // public function index()
    // {
    //     $subcategories = Subcategory::with('category')->latest()->paginate(20);
    //     return view('admin.subcategories.index', compact('subcategories'));
    // }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products-management.subcategories-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        Subcategory::create($validated);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
        'sort_order' => 'nullable|integer',
    ]);

    $validated['slug'] = Str::slug($validated['name']);
    
    if ($request->hasFile('image')) {
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }
        $validated['image'] = $request->file('image')->store('subcategories', 'public');
    }

    $subcategory->update($validated);

    // Redirect back to the subcategories list of the (possibly changed) category
    return redirect()->route('admin.categories.subcategories.index', $validated['category_id'])
                     ->with('success', 'Subcategory updated successfully');
}

    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}
