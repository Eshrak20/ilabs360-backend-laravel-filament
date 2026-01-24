<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'platform',
        'url',
        'icon',
        'position',
        'is_active',
    ];

    // public function getIconAttribute($value)
    // {
    //     if (! $value) {
    //         return null;
    //     }

    //     // Check if the request is from API (prefix or expects JSON)
    //     if (request()->is('api/*') || request()->expectsJson()) {
    //         return asset('storage/' . $value);
    //     }

    //     // For Filament or web usage
    //     return $value;
    // }
}
