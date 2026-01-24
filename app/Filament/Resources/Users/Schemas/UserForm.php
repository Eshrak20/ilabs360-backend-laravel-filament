<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($record) => $record === null),

                Select::make('role')
                    ->required()
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ]),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),

                Toggle::make('web_view')
                    ->label('Web View')
                    ->default(true),
            ]);
    }
}
