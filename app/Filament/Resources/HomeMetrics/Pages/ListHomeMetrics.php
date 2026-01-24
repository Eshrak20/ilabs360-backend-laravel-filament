<?php

namespace App\Filament\Resources\HomeMetrics\Pages;

use App\Filament\Resources\HomeMetrics\HomeMetricResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeMetrics extends ListRecords
{
    protected static string $resource = HomeMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
