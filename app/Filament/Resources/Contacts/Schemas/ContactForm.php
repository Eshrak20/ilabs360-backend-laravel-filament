<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Contact Details')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255),
                    ]),

                    TextInput::make('phone')
                        ->maxLength(50),

                    TextInput::make('subject')
                        ->maxLength(255),

                    Textarea::make('message')
                        ->required()
                        ->rows(5)
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
