<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                TextInput::make('title_bng')
                    ->label('Title (Bangla)')
                    ->maxLength(255),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                FileUpload::make('featured_image')
                    ->image()
                    ->directory('blogs')
                    ->disk('public')
                    ->imagePreviewHeight('200')
                    ->nullable(),

                RichEditor::make('summary')
                    ->label('Summary')
                    ->columnSpanFull()
                    ->nullable(),

                RichEditor::make('summary_bng')
                    ->label('Summary (Bangla)')
                    ->columnSpanFull()
                    ->nullable(),

                RichEditor::make('content')
                    ->label('Content')
                    ->columnSpanFull()
                    ->nullable(),

                RichEditor::make('content_bng')
                    ->label('Content (Bangla)')
                    ->columnSpanFull()
                    ->nullable(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                DateTimePicker::make('published_at')
                    ->label('Publish Date')
                    ->nullable(),
            ]);
    }
}
