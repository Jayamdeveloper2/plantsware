<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_link',
        'sort_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope: Only active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by sort_order (ascending)
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}