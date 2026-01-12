<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'rating',
        'title',
        'content',
        'is_verified',
        'is_active',
        'date',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'date' => 'date',
    ];
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Latest testimonials
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('date', 'desc')
                     ->orderBy('created_at', 'desc');
    }
}

