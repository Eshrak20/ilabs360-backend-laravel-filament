<?php

namespace App\Filament\Resources\SocialLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Tables\Filters\TernaryFilter;

class SocialLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                BadgeColumn::make('platform')
                    ->colors([
                        'primary' => 'facebook',
                        'warning' => 'instagram',
                        'info'    => 'linkedin',
                        'danger'  => 'youtube',
                        'success' => 'whatsapp',
                        'gray'    => 'twitter',
                    ])
                    ->sortable(),

                TextColumn::make('icon'),

                TextColumn::make('url')
                    ->limit(40)
                    ->searchable(),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('position')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Added'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Links'),
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
