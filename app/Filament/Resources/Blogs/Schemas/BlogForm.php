<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3) // 🔥 Default 3-column layout
            ->components([

                // ================= BASIC INFO =================
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('slug', Str::slug($state))
                    )
                    ->columnSpan(2),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),

                TextInput::make('title_bng')
                    ->label('Title (Bangla)')
                    ->maxLength(255)
                    ->columnSpan(2),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->columnSpan(1),

                FileUpload::make('featured_image')
                    ->image()
                    ->directory('blogs')
                    ->disk('public')
                    ->imagePreviewHeight('200')
                    ->nullable()
                    ->columnSpanFull(),



                // ================= CONTENT (SIDE BY SIDE, BIG) =================
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('content')
                            ->label('Content (English)')
                            ->columnSpan(1)
                            ->nullable(),

                        RichEditor::make('content_bng')
                            ->label('Content (Bangla)')
                            ->columnSpan(1)
                            ->nullable(),
                    ]),

                // ================= SUMMARY (SIDE BY SIDE) =================
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('summary')
                            ->label('Summary (English)')
                            ->nullable(),

                        RichEditor::make('summary_bng')
                            ->label('Summary (Bangla)')
                            ->nullable(),
                    ]),

                // ================= STATUS =================
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required()
                    ->columnSpan(1),

                DateTimePicker::make('published_at')
                    ->label('Publish Date')
                    ->default(now())
                    ->nullable()
                    ->columnSpan(2),
            ]);
    }
}
