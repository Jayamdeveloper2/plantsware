<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->take(3)
            ->get();
        
        return view('view.singleblog', compact('blog', 'relatedBlogs'));
    }

    public function categories()
    {
        $categories = BlogCategory::where('is_active', true)->with('blogs')->get();
        return view('view.blogcategory', compact('categories'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $blogs = Blog::where('blog_category_id', $category->id)->where('is_active', true)->paginate(12);
        return view('view.blogcategory', compact('category', 'blogs'));
    }
}
