<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TestimonialsTable
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

                TextColumn::make('name')
                    ->sortable()
                    ->limit(30),

                TextColumn::make('short_description')
                    ->limit(40)
                    ->toggleable(),

                TextColumn::make('star')
                    ->label('Rating')
                    ->sortable(),

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
