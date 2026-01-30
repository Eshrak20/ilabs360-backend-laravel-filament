<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use Illuminate\Support\Facades\Auth;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ✅ Name: admin + user can edit
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // ❌ Email: admin only
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->visible(fn() => Auth::user()?->role === 'admin'),

                // ✅ Password: admin + user (optional on edit)
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn($record) => $record === null),

                // ❌ Role: admin only
                Select::make('role')
                    ->required()
                    ->options([
                        'admin' => 'Admin',
                        'user'  => 'User',
                    ])
                    ->visible(fn() => Auth::user()?->role === 'admin'),

                // ❌ Active toggle: admin only
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->visible(fn() => Auth::user()?->role === 'admin'),

                // ❌ Web view: admin only
                Toggle::make('web_view')
                    ->label('Web View')
                    ->default(true)
                    ->visible(fn() => Auth::user()?->role === 'admin'),
            ]);
    }
}
