<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Site Information')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('site_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('site_tagline')
                            ->maxLength(255),
                    ]),
                ]),

            Section::make('Branding')
                ->schema([
                    Grid::make(3)->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings'),

                        FileUpload::make('logo_dark')
                            ->image()
                            ->disk('public')
                            ->directory('settings'),

                        FileUpload::make('favicon')
                            ->image()
                            ->disk('public')
                            ->directory('settings'),
                    ]),
                ]),

            Section::make('Contact Information')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('primary_phone'),
                        TextInput::make('secondary_phone'),
                        TextInput::make('primary_email')
                            ->email(),
                    ]),

                    Textarea::make('address')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Section::make('Footer & Map')
                ->schema([
                    Textarea::make('footer_text')
                        ->columnSpanFull(),

                    Textarea::make('google_map_embed')
                        ->rows(4)
                        ->helperText('Paste Google Map iframe code here')
                        ->columnSpanFull(),
                ]),

            Section::make('SEO Settings')
                ->collapsed()
                ->schema([
                    TextInput::make('seo_title')
                        ->maxLength(255),

                    Textarea::make('seo_description')
                        ->rows(3),
                ]),
        ]);
    }
}
