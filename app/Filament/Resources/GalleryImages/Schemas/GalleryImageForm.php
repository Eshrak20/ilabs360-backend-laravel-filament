<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class GalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Image Details')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('place')
                            ->maxLength(255),
                    ]),

                    Textarea::make('description')
                        ->rows(3)
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('gallery-images')
                        ->required()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
