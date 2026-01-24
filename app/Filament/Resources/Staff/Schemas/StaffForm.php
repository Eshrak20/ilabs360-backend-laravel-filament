<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /* =======================
             | Basic Information
             ======================= */
            Section::make('Basic Information')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('designation')
                            ->required(),

                        TextInput::make('department'),

                        TextInput::make('age')
                            ->numeric()
                            ->minValue(18)
                            ->maxValue(80),
                    ]),
                ]),

            /* =======================
             | Company Details
             ======================= */
            Section::make('Company Details')
                ->schema([
                    Grid::make(3)->schema([
                        Select::make('employment_type')
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                                'Intern' => 'Intern',
                            ]),

                        TextInput::make('years_in_company')
                            ->numeric()
                            ->minValue(0),

                        DatePicker::make('joining_date'),
                    ]),
                ]),

            /* =======================
             | Skills & Bio
             ======================= */
            Section::make('Skills & Profile')
                ->schema([
                    TagsInput::make('skills')
                        ->placeholder('Laravel, React, DevOps'),

                    RichEditor::make('bio')
                        ->columnSpanFull(),
                ]),

            /* =======================
             | Contact Information
             ======================= */
            Section::make('Contact Information')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('email')->email(),
                        TextInput::make('phone'),
                        TextInput::make('whatsapp_number'),
                    ]),

                    Grid::make(4)->schema([
                        TextInput::make('facebook_url')->url(),
                        TextInput::make('linkedin_url')->url(),
                        TextInput::make('github_url')->url(),
                        TextInput::make('portfolio_url')->url(),
                    ]),
                ]),

            /* =======================
             | Media
             ======================= */
            Section::make('Profile Photo')
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('staff')
                        ->imageEditor()
                        ->imageCropAspectRatio('1:1')
                        ->maxSize(2048),
                ]),

            /* =======================
             | Status & Ordering
             ======================= */
            Section::make('Status & Ordering')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('position')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),

                        Toggle::make('is_active')
                            ->default(true),
                    ]),
                ]),
        ]);
    }
}
