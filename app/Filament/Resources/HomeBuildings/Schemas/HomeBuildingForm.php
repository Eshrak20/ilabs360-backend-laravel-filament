<?php

namespace App\Filament\Resources\HomeBuildings\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class HomeBuildingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | BASIC INFORMATION
                |--------------------------------------------------------------------------
                */
                Section::make('Home Building Information')
                    ->schema([
                        Grid::make(2)->schema([

                            TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('sub_title')
                                ->label('Sub Title')
                                ->required()
                                ->maxLength(255),
                        ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | STATISTICS / COUNTERS
                |--------------------------------------------------------------------------
                */
                Section::make('Statistics & Achievements')
                    ->schema([
                        Grid::make(2)->schema([

                            TextInput::make('total_area_built')
                                ->label('Total Area Built')
                                ->placeholder('e.g. 10+'),

                            TextInput::make('total_commercial_spaces')
                                ->label('Total Commercial Spaces')
                                ->placeholder('e.g. 80+'),
                        ]),

                        Grid::make(2)->schema([

                            TextInput::make('total_residential_projects')
                                ->label('Total Residential Projects')
                                ->placeholder('e.g. 120+'),

                            TextInput::make('year_of_excellence')
                                ->label('Years of Excellence')
                                ->placeholder('e.g. 25+'),
                        ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | IMAGE / MEDIA
                |--------------------------------------------------------------------------
                */
                Section::make('Display Image')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disk('public')
                            ->directory('home_buildings')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | Video
                |--------------------------------------------------------------------------
                */
                Section::make('Display Video')
                    ->schema([
                        TextInput::make('videoID')
                            ->label('Video ID')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
