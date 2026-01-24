<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Filters\TernaryFilter;

class ServiceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable(),

                ImageColumn::make('image')
                    ->disk('public')
                    ->imageHeight(60)
                    ->square(),

                TextColumn::make('title')
                    ->sortable()
                    ->limit(30),

                TextColumn::make('description')
                    ->toggleable()
                    ->limit(30),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('position')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Created'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Banners'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('position');
    }
}
