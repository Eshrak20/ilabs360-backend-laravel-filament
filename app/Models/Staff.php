<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'user_id',

        // Basic info
        'name',
        'age',
        'designation',
        'department',
        'employment_type',
        'years_in_company',
        'joining_date',

        // Profile & skills
        'bio',
        'description',
        'skills',

        // Contact
        'email',
        'phone',
        'whatsapp_number',

        // Social & professional links
        'facebook_url',
        'linkedin_url',
        'github_url',
        'portfolio_url',

        // Media & status
        'image',
        'position',
        'is_active',
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
    protected $casts = [
        'skills' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
