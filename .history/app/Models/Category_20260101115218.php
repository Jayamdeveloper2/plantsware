<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    // Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordered categories (sort_order then name)
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    // Optional: If you have subcategories
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    // Optional: Products in this category
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
