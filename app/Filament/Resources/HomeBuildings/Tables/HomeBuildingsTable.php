<?php

namespace App\Filament\Resources\HomeBuildings\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class HomeBuildingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')->sortable(),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->square()
                    ->height(70),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sub_title')
                    ->label('Sub Title')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('total_area_built')
                    ->label('Total Area Built')
                    ->sortable(),

                TextColumn::make('total_residential_projects')
                    ->label('Residential Projects')
                    ->sortable(),

                TextColumn::make('year_of_excellence')
                    ->label('Years of Excellence')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->label('Created'),
            ])

            ->filters([
                //
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
