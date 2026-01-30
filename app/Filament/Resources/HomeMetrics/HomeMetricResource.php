<?php

namespace App\Filament\Resources\HomeMetrics;

use App\Filament\Resources\HomeMetrics\Pages\CreateHomeMetric;
use App\Filament\Resources\HomeMetrics\Pages\EditHomeMetric;
use App\Filament\Resources\HomeMetrics\Pages\ListHomeMetrics;
use App\Filament\Resources\HomeMetrics\Schemas\HomeMetricForm;
use App\Filament\Resources\HomeMetrics\Tables\HomeMetricsTable;
use App\Models\HomeMetric;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HomeMetricResource extends Resource
{
    protected static ?string $model = HomeMetric::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-swatch';
    protected static string|UnitEnum|null $navigationGroup = 'Pages';

    public static function form(Schema $schema): Schema
    {
        return HomeMetricForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeMetricsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeMetrics::route('/'),
            'create' => CreateHomeMetric::route('/create'),
            'edit' => EditHomeMetric::route('/{record}/edit'),
        ];
    }
}
