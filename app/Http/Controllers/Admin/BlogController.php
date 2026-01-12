<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(20);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($validated);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($validated);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }
}
