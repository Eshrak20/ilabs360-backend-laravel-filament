<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Testimonial Details')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Select::make('star')
                            ->label('Rating')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->default(5)
                            ->required(),

                        TextInput::make('company_name')
                            ->label('Company Name')
                            ->maxLength(255),

                        TextInput::make('company_title')
                            ->label('Company Title / Designation')
                            ->maxLength(255),

                        FileUpload::make('company_image')   // New field
                            ->label('Company Picture')
                            ->image()
                            ->disk('public')
                            ->directory('testimonials/company'),
                    ]),


                    TextInput::make('short_description')
                        ->maxLength(255),

                    Textarea::make('description')
                        ->rows(4)
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('testimonials')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
