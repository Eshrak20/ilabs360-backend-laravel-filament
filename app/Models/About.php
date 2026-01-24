<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['who_we_are', 'mission', 'vission', 'banner'];

    public function getBannerAttribute($value)
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
