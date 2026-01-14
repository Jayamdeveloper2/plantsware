<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $fillable = [
        // 'blog_category_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'author_name',
        'is_active',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

 public function blogCategory(): BelongsTo
{
    return $this->belongsTo(BlogCategory::class, 'blog_category_id');
}


/**
 * Many-to-many relationship with tags
 */
public function tags()
{
    return $this->belongsToMany(Tag::class);
}


// new code for img  13/01/2026
/**
 * Get the full public URL for the blog image
 */
public function getImageUrlAttribute()
{
    if (!$this->image) {
        return null; // or asset('images/no-image.jpg') for placeholder
    }

    // This converts 'blogs/xxx.jpg' → '/storage/blogs/xxx.jpg'
    return Storage::url($this->image);
}
//  end here 







    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Latest blogs (by published_at or created_at)
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')
                     ->orderBy('created_at', 'desc');
    }

    /**
     * Automatically generate slug from title on save
     */
    protected static function booted()
    {
        static::saving(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    /**
     * Optional: Relationship to category (if you have blog categories)
     */
    // public function category()
    // {
    //     return $this->belongsTo(BlogCategory::class);
    // }
}

 
