<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeBuilding extends Model
{
    protected $fillable = ['title', 'sub_title', 'total_area_built', 'total_commercial_spaces', 'total_residential_projects', 'year_of_excellence', 'image', 'videoID'];

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
