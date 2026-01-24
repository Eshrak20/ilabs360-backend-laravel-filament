<?php

namespace App\Filament\Resources\HomeBuildings\Pages;

use App\Filament\Resources\HomeBuildings\HomeBuildingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeBuilding extends EditRecord
{
    protected static string $resource = HomeBuildingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return HomeBuildingResource::getUrl('index');
    }
}
