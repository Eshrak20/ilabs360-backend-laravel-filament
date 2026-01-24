<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $fillable = ['project_id', 'image'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

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
