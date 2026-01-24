<?php

namespace App\Filament\Resources\HomeBuildings\Pages;

use App\Filament\Resources\HomeBuildings\HomeBuildingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeBuilding extends CreateRecord
{
    protected static string $resource = HomeBuildingResource::class;

    protected function getRedirectUrl(): string
    {
        return HomeBuildingResource::getUrl('index');
    }

}
