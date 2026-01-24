<?php

namespace App\Filament\Resources\HomeBuildings;

use App\Filament\Resources\HomeBuildings\Pages\CreateHomeBuilding;
use App\Filament\Resources\HomeBuildings\Pages\EditHomeBuilding;
use App\Filament\Resources\HomeBuildings\Pages\ListHomeBuildings;
use App\Filament\Resources\HomeBuildings\Schemas\HomeBuildingForm;
use App\Filament\Resources\HomeBuildings\Tables\HomeBuildingsTable;
use App\Models\HomeBuilding;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeBuildingResource extends Resource
{
    protected static ?string $model = HomeBuilding::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    public static function form(Schema $schema): Schema
    {
        return HomeBuildingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeBuildingsTable::configure($table);
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
            'index' => ListHomeBuildings::route('/'),
            'create' => CreateHomeBuilding::route('/create'),
            'edit' => EditHomeBuilding::route('/{record}/edit'),
        ];
    }
}
