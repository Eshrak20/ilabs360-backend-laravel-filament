<?php

namespace App\Filament\Resources\GalleryVideos;

use App\Filament\Resources\GalleryVideos\Pages\CreateGalleryVideo;
use App\Filament\Resources\GalleryVideos\Pages\EditGalleryVideo;
use App\Filament\Resources\GalleryVideos\Pages\ListGalleryVideos;
use App\Filament\Resources\GalleryVideos\Schemas\GalleryVideoForm;
use App\Filament\Resources\GalleryVideos\Tables\GalleryVideosTable;
use App\Models\GalleryVideo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GalleryVideoResource extends Resource
{
    protected static ?string $model = GalleryVideo::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-video-camera';

    public static function form(Schema $schema): Schema
    {
        return GalleryVideoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalleryVideosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGalleryVideos::route('/'),
            'create' => CreateGalleryVideo::route('/create'),
            'edit' => EditGalleryVideo::route('/{record}/edit'),
        ];
    }
}
