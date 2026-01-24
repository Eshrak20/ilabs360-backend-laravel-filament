<?php

namespace App\Filament\Resources\Staff\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class StaffTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(),

                ImageColumn::make('image')
                    ->label('Photo')
                    ->disk('public')
                    ->height(44)
                    ->circular(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('designation')
                    ->sortable(),

                TextColumn::make('department')
                    ->badge()
                    ->toggleable(),

                TextColumn::make('employment_type')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                TextColumn::make('years_in_company')
                    ->label('Years')
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('position')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Added')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Staff'),

                SelectFilter::make('department')
                    ->searchable(),

                SelectFilter::make('employment_type')
                    ->options([
                        'Full-time' => 'Full-time',
                        'Part-time' => 'Part-time',
                        'Contract' => 'Contract',
                        'Intern' => 'Intern',
                    ]),
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
