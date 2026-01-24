<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'position',
        'is_active'
    ];

    public function getImageAttribute($value)
    {
        if (! $value) {
            return null;
        }

        // Check if the request is from API (prefix or expects JSON)
        if (request()->is('api/*') || request()->expectsJson()) {
            return asset('storage/' . $value);
        }

        // For Filament or web usage
        return $value;
    }
}
