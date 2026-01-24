<?php

namespace App\Filament\Resources\HomeSections\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Filters\TernaryFilter;

class HomeSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('section_key')
                    ->label('Section Key')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('subtitle')
                    ->toggleable(),

                ImageColumn::make('image'),

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
                    ->label('Active Sections'),
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
            ->defaultSort('position');
    }
}
