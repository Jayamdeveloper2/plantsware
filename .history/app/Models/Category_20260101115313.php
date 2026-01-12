<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'badge_type', // sale, new, offer, combo
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
}

