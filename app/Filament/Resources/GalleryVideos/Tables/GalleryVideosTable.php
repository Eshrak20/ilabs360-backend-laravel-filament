<?php

namespace App\Filament\Resources\GalleryVideos\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class GalleryVideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('title')
                    ->sortable()
                    ->limit(40),

                TextColumn::make('place')
                    ->limit(30),

                TextColumn::make('video_id')
                    ->label('Video ID')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Created'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
