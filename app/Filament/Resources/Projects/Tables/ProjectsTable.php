<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(),

                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->height(50)
                    ->square()
                    ->toggleable(),

                TextColumn::make('project_name')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                BadgeColumn::make('project_type')
                    ->colors([
                        'info'    => 'web',
                        'success' => 'mobile',
                        'warning' => 'desktop',
                        'primary' => 'api',
                    ])
                    ->sortable(),

                BadgeColumn::make('project_category')
                    ->colors([
                        'info'    => 'frontend',
                        'success' => 'backend',
                        'warning' => 'fullstack',
                    ])
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'ongoing',
                        'success' => 'completed',
                        'danger'  => 'paused',
                    ])
                    ->sortable(),

                TextColumn::make('client_name')
                    ->placeholder('—')
                    ->toggleable(),

                TextColumn::make('start_date')
                    ->date()
                    ->toggleable(),

                TextColumn::make('handover_date')
                    ->date()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Created'),
            ])
            ->filters([

                SelectFilter::make('project_type')
                    ->options([
                        'web' => 'Web',
                        'mobile' => 'Mobile',
                        'desktop' => 'Desktop',
                        'api' => 'API',
                    ]),

                SelectFilter::make('project_category')
                    ->options([
                        'frontend' => 'Frontend',
                        'backend' => 'Backend',
                        'fullstack' => 'Full Stack',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'paused' => 'Paused',
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
            ]);
    }
}
