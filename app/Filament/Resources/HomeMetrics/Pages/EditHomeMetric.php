<?php

namespace App\Filament\Resources\HomeMetrics\Pages;

use App\Filament\Resources\HomeMetrics\HomeMetricResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeMetric extends EditRecord
{
    protected static string $resource = HomeMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
