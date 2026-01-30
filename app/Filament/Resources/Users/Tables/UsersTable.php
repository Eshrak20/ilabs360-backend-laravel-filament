<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->visible(fn() => Auth::user()?->role === 'admin'),

                TextColumn::make('role')
                    ->badge()
                    ->visible(fn() => Auth::user()?->role === 'admin'),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->visible(fn() => Auth::user()?->role === 'admin')
                    ->disabled(
                        fn($record) =>
                        $record->id === Auth::id() && $record->role === 'admin'
                    ),


                ToggleColumn::make('web_view')
                    ->label('Web')
                    ->visible(fn() => Auth::user()?->role === 'admin'),


                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'editor' => 'Editor',
                        'user' => 'User',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),

                Tables\Filters\TernaryFilter::make('web_view')
                    ->label('Web View'),
            ])
            ->recordActions([
                EditAction::make(),

                DeleteAction::make()
                    ->visible(fn($record) => $record->id !== auth()->id()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn() => auth()->user()?->role === 'admin'),
                ]),
            ]);
    }
}
