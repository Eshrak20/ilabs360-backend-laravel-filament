<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */
            Section::make('Basic Information')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('project_name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->reactive()
                            ->afterStateUpdated(
                                fn($state, callable $set) =>
                                $set('slug', Str::slug($state))
                            ),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ]),

                    Textarea::make('short_description')
                        ->rows(3)
                        ->columnSpanFull(),

                    RichEditor::make('description')
                        ->columnSpanFull(),
                ]),

            /*
            |--------------------------------------------------------------------------
            | PROJECT META
            |--------------------------------------------------------------------------
            */
            Section::make('Project Meta')
                ->schema([
                    Grid::make(3)->schema([
                        Select::make('project_type')
                            ->required()
                            ->options([
                                'web' => 'Web',
                                'mobile' => 'Mobile',
                                'desktop' => 'Desktop',
                                'api' => 'API',
                            ]),

                        Select::make('project_category')
                            ->required()
                            ->options([
                                'frontend' => 'Frontend',
                                'backend' => 'Backend',
                                'fullstack' => 'Full Stack',
                            ]),

                        Select::make('status')
                            ->default('ongoing')
                            ->required()
                            ->options([
                                'ongoing' => 'Ongoing',
                                'completed' => 'Completed',
                                'paused' => 'Paused',
                            ]),
                    ]),
                ]),

            /*
            |--------------------------------------------------------------------------
            | TECH STACK
            |--------------------------------------------------------------------------
            */
            Section::make('Tech Stack')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('frontend_tech')->label('Frontend Tech'),
                        TextInput::make('backend_tech')->label('Backend Tech'),
                        TextInput::make('database_tech')->label('Database'),
                        TextInput::make('tools')->label('Tools / Services'),
                    ]),
                ]),

            /*
            |--------------------------------------------------------------------------
            | CLIENT INFO
            |--------------------------------------------------------------------------
            */
            Section::make('Client Information')
                ->collapsed()
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('client_name'),
                        TextInput::make('client_company'),
                    ]),

                    Textarea::make('client_review')->rows(3),

                    TextInput::make('client_rating')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                ]),

            /*
            |--------------------------------------------------------------------------
            | MEDIA
            |--------------------------------------------------------------------------
            */
            Section::make('Media')
                ->schema([
                    FileUpload::make('banner')
                        ->image()
                        ->disk('public')
                        ->directory('projects/banners')
                        ->maxFiles(1)
                        ->nullable()
                        ->dehydrateStateUsing(fn($state) => is_array($state) ? $state[0] ?? null : $state),

                    FileUpload::make('thumbnail')
                        ->image()
                        ->disk('public')
                        ->directory('projects/thumbnails')
                        ->maxFiles(1)
                        ->nullable()
                        ->dehydrateStateUsing(fn($state) => is_array($state) ? $state[0] ?? null : $state),

                    FileUpload::make('gallery_images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->disk('public')
                        ->directory('projects/gallery')
                        ->columnSpanFull(),

                    TextInput::make('project_video')
                        ->label('Project Video URL'),

                    TextInput::make('live_url')
                        ->label('Live URL'),

                    TextInput::make('github_url')
                        ->label('GitHub URL'),
                ]),

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */
            Section::make('Timeline')
                ->schema([
                    Grid::make(2)->schema([
                        DatePicker::make('start_date'),
                        DatePicker::make('handover_date'),
                    ]),
                ]),

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */
            Section::make('SEO Settings')
                ->collapsed()
                ->schema([
                    TextInput::make('seo_title')->maxLength(255),
                    Textarea::make('seo_description')->rows(3),
                ]),
        ]);
    }
}
