<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'badge_type', // sale, new, offer, combo
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope: Only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by sort_order then name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
                     ->orderBy('name', 'asc');
    }

    /**
     * Relationship: Products belonging to this category
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relationship: Subcategories belonging to this category
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
}