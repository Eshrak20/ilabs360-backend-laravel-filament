<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('site_name')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->height(40)
                    ->square(),
                TextColumn::make('primary_email')
                    ->label('Email')
                    ->toggleable(),

                TextColumn::make('primary_phone')
                    ->label('Phone')
                    ->toggleable(),

                TextColumn::make('address')
                    ->label('Address')
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->since()
                    ->label('Last Updated'),
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
            ]);
    }
}
