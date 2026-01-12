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
    public function index()
    {
        $subcategories = Subcategory::with('category')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.products-management.subcategories', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products-management.subcategories-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'is_active'      => 'sometimes|boolean',
            'sort_order'     => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        // Ensure is_active is set (default to true if not sent)
        $validated['is_active'] = array_key_exists('is_active', $validated)
            ? $validated['is_active']
            : true;

        Subcategory::create($validated);

        return redirect()
            ->route('admin.products-management.subcategories')
            ->with('success', 'Subcategory created successfully');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products-management.subcategories-edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'is_active'      => 'sometimes|boolean',
            'sort_order'     => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image);
            }
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        // Ensure is_active is set (default to current value if not sent)
        $validated['is_active'] = array_key_exists('is_active', $validated)
            ? $validated['is_active']
            : $subcategory->is_active;

        $subcategory->update($validated);

        return redirect()
            ->route('admin.products-management.subcategories')
            ->with('success', 'Subcategory updated successfully');
    }

    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }
        $subcategory->delete();

        return redirect()
            ->route('admin.products-management.subcategories')
            ->with('success', 'Subcategory deleted successfully');
    }
}
