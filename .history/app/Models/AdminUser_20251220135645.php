<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_user';

    protected $fillable = [
        'name',
        'username',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Set the password attribute (hash it automatically when setting)
     */
    public function setPasswordAttribute($value)
    {
        // Only hash if the value is not already hashed
        if (!empty($value) && !str_starts_with($value, '$2y$') && !str_starts_with($value, '$2a$') && !str_starts_with($value, '$2b$')) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }
}

