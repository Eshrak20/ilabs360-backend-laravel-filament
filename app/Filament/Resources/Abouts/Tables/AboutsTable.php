<?php

namespace App\Filament\Resources\Abouts\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AboutsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')->sortable(),

                ImageColumn::make('banner')
                    ->label('Banner')
                    ->disk('public')
                    ->height(70)
                    ->square(),

                TextColumn::make('who_we_are')
                    ->label('Who We Are')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('mission')
                    ->label('Mission')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('vission')
                    ->label('Vision')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->label('Created'),
            ])

            ->filters([])

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
