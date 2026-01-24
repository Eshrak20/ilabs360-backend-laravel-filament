<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        // Auto-create blank staff (profile)
        $user->staff()->create([
            'name'  => $user->name,
            'email' => $user->email,
        ]);
    }
    public function deleted(User $user): void
    {
        $user->staff()?->delete();
    }

    public function updated(User $user): void
    {
        $user->staff()?->update([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
