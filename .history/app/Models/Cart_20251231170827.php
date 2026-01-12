// app/Models/Cart.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for current user or session
    public function scopeCurrent($query)
    {
        if (auth()->check()) {
            return $query->where('user_id', auth()->id());
        }

        return $query->where('session_id', session()->getId());
    }
}