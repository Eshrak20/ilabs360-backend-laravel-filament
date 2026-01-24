<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Banner Details')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('title')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->rows(4)
                            ->nullable(),
                    ]),
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('services')
                        ->moveFiles(false) 
                        ->imagePreviewHeight('150')   // ⭐ REQUIRED for preview
                        ->openable()                  // ⭐ allows preview modal
                        ->downloadable()
                        ->required()
                        ->columnSpanFull(),
                ]),

            Section::make('Status & Position')
                ->schema([

                    TextInput::make('position')
                        ->numeric()
                        ->unique(ignoreRecord: true)
                        ->required(),

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ]),
        ]);
    }
}
