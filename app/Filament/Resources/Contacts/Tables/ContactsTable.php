<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                // TextColumn::make('phone')
                //     ->toggleable(),

                TextColumn::make('subject')
                    ->toggleable(),

                // TextColumn::make('message')
                //     ->toggleable(),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Received'),

                ToggleColumn::make('is_read') // ✅ Correct toggle
                    ->label('Read')
                    // ->onColor('success')
                    // ->offColor('danger')
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(), // ✅ Only view and delete
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
