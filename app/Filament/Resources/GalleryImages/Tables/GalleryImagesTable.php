<?php

namespace App\Filament\Resources\GalleryImages\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class GalleryImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable(),

                ImageColumn::make('image')
                    ->disk('public')
                    ->height(60)
                    ->square(),

                TextColumn::make('title')
                    ->sortable()
                    ->limit(40),

                TextColumn::make('place')
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
