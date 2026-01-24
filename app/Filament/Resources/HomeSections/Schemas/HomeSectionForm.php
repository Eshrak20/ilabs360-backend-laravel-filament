<?php

namespace App\Filament\Resources\HomeSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class HomeSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Section Details')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('section_key')
                            ->label('Section Key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('title')
                            ->maxLength(255),
                    ]),

                    TextInput::make('subtitle')
                        ->maxLength(255),

                    Textarea::make('description')
                        ->rows(4)
                        ->columnSpanFull(),

                   FileUpload::make('image')
                       ->image()
                       ->disk('public')
                       ->directory('home-sections')
                       ->required()
                       ->columnSpanFull(),
                ]),

            Section::make('Status & Position')
                ->schema([

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),

                    TextInput::make('position')
                        ->numeric()
                        ->default(1)
                        ->minValue(1),
                ]),
        ]);
    }
}
