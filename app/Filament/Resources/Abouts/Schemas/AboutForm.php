<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('About Content')
                    ->schema([
                        Grid::make(2)->schema([

                            Textarea::make('who_we_are')
                                ->label('Who We Are')
                                ->rows(4)
                                ->columnSpanFull(),

                            Textarea::make('mission')
                                ->label('Our Mission')
                                ->rows(4)
                                ->columnSpanFull(),

                            Textarea::make('vission')
                                ->label('Our Vision')
                                ->rows(4)
                                ->columnSpanFull(),
                        ]),
                    ]),

                Section::make('Banner')
                    ->schema([
                        FileUpload::make('banner')
                            ->label('Banner Image')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('about')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
