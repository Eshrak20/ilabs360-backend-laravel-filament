<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Article Information')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) =>
    $set('slug', Str::slug($state))
    ),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                    ]),

                    TextInput::make('excerpt')
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->required()
                        ->columnSpanFull(),
                ]),

            Section::make('Author & Publish')
                ->schema([

                    Grid::make(2)->schema([

                        TextInput::make('author_name')
                            ->label('Author'),

                        DateTimePicker::make('published_at')
                            ->label('Publish Date'),
                    ]),

                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('articles')
                        ->columnSpanFull(),
                ]),

            Section::make('SEO & Status')
                ->schema([

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),

                    Grid::make(2)->schema([

                        TextInput::make('seo_title'),

                        TextInput::make('seo_description'),
                    ]),
                ])
                ->collapsed(),
        ]);
    }
}
