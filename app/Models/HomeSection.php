<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'description',
        'image',
        'is_active',
        'position',
    ];

    protected $casts = ['section_key' => 'integer'];

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

    public function metrics()
    {
        return $this->hasMany(HomeMetric::class);
    }


}
