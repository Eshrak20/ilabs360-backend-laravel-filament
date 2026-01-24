<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model
{

    protected $fillable = [
        // Core
        'project_name',
        'slug',
        'project_type',
        'project_category',
        'status',

        // Descriptions
        'short_description',
        'description',

        // Tech Stack
        'frontend_tech',
        'backend_tech',
        'database_tech',
        'tools',

        // Client Info
        'client_name',
        'client_company',
        'client_review',
        'client_rating',

        // Media
        'banner',
        'thumbnail',
        'gallery_images',
        'project_video',
        'live_url',
        'github_url',

        // Timeline
        'start_date',
        'handover_date',

        // SEO
        'seo_title',
        'seo_description',
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
    protected $casts = [
        'gallery_images' => 'array',
        'start_date'     => 'date',
        'handover_date'  => 'date',
        'client_rating' => 'integer',
    ];

    public function gallery()
    {
        return $this->hasMany(ProjectGallery::class);
    }
}
