<?php

namespace App\Filament\Resources\SocialLinks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Schema;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Social Platform')
                ->schema([
                    Grid::make(2)->schema([

                        Select::make('platform')
                            ->required()
                            ->options([
                                'facebook'  => 'Facebook',
                                'instagram'=> 'Instagram',
                                'linkedin'  => 'LinkedIn',
                                'youtube'   => 'YouTube',
                                'whatsapp'  => 'WhatsApp',
                                'twitter'   => 'Twitter (X)',
                            ]),

                        TextInput::make('url')
                            ->required()
                            ->url()
                            ->placeholder('https://'),

                        TextInput::make('icon')
                            ->required()
                            ->string()
                            ->placeholder('faFacebook'),
                    ]),
                ]),

            // Section::make('Icon (Optional)')
            //     ->schema([
            //         FileUpload::make('icon')
            //             ->image()
            //             ->disk('public')
            //             ->directory('social-icons')
            //             ->maxSize(1024)
            //             ->helperText('Optional custom icon (SVG/PNG)'),
            //     ]),

            Section::make('Visibility & Order')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('position')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
                ]),
        ]);
    }
}
