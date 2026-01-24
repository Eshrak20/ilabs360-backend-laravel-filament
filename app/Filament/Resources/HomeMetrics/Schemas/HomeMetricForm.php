<?php

namespace App\Filament\Resources\HomeMetrics\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomeMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Metric Details')
                ->schema([

                    Grid::make(2)->schema([

                        Select::make('home_section_id')
                            ->label('Home Section')
                            ->relationship('section', 'title')
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Metric Name')
                            ->maxLength(255),
                    ]),

                    TextInput::make('value')
                        ->label('Metric Value')
                        ->maxLength(255),

                ]),

        ]);
    }
}
