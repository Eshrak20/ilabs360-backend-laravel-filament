<?php

namespace App\Filament\Resources\HomeBuildings\Pages;

use App\Filament\Resources\HomeBuildings\HomeBuildingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeBuildings extends ListRecords
{
    protected static string $resource = HomeBuildingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
