<?php

namespace App\Filament\Resources\GalleryVideos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class GalleryVideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Video Details')
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

                    TextInput::make('video_id')
                        ->label('Video ID')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Store only platform video ID (YouTube / Vimeo etc.)'),
                ]),
        ]);
    }
}
