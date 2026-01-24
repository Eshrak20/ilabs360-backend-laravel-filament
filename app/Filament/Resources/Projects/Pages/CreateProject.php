<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getRedirectUrl(): string
    {
        return ProjectResource::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->galleryImages = $data['project_gallery'] ?? [];

        unset($data['project_gallery']);

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->galleryImages as $image) {
            $this->record->gallery()->create([
                'image' => $image,
            ]);
        }
    }

}
