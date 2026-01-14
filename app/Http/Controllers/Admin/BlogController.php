<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $blogs = Blog::with('blogCategory') // Note: use blogCategory (relation name)
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10); // 10 or 20 — your choice

        return view('admin.blogs.index', compact('blogs', 'search'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            // 'blog_category_id'  => 'nullable|exists:blog_categories,id',
            'content'           => 'required|string',
            'excerpt'           => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_name'       => 'nullable|string|max:255',
            'is_active'         => 'boolean',
            'published_at'      => 'nullable|date',
            'tags'              => 'nullable|array',
            'tags.*'            => 'exists:tags,id',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Set default author if not provided
        // $validated['author_name'] = $validated['author_name'] ?? auth()->user()?->name ?? 'Admin';

        // Set default publish date if not provided
        $validated['published_at'] = $validated['published_at'] ?? now();

        // Default active status
        $validated['is_active'] = $validated['is_active'] ?? true;
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }
        
        // Create the blog — this line saves ALL validated fields
        $blog = Blog::create($validated);

        // Attach tags
        if ($request->has('tags')) {
            $blog->tags()->sync($request->input('tags'));
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog)
    {
        $blog->load(['blogCategory', 'tags']);

        // Simple related posts (sharing at least one tag)
        $related = Blog::whereHas('tags', function ($q) use ($blog) {
                $q->whereIn('tags.id', $blog->tags->pluck('id'));
            })
            ->where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->latest()
            ->limit(3)
            ->get();

        return view('admin.blogs.show', compact('blog', 'related'));
    }

    public function edit(Blog $blog)
    {
        $blog->load('tags'); // Important for pre-selecting tags

        $categories = BlogCategory::where('is_active', true)->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            // 'blog_category_id'  => 'nullable|exists:blog_categories,id',
            'content'           => 'required|string',
            'excerpt'           => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_name'       => 'nullable|string|max:255',
            'is_active'         => 'boolean',
            'published_at'      => 'nullable|date',
            'tags'              => 'nullable|array',
            'tags.*'            => 'exists:tags,id',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($validated);

        // Sync tags (will remove old ones not in new list)
        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully!');
    }


    // To show embedded img 
// In BlogController.php
public function ckeditorUpload(Request $request)
{
    $request->validate([
        'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $file = $request->file('upload');
    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('blogs/ckeditor', $filename, 'public');

    return response()->json([
        'uploaded' => true,
        'url' => Storage::url($path)
    ]);
}
    // end

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->tags()->detach(); // Clean up pivot table
        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully!');
    }
}