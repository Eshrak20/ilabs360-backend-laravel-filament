<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return ProjectResource::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->galleryImages = $data['project_gallery'] ?? [];

        unset($data['project_gallery']);

        return $data;
    }

    protected function afterSave(): void
    {
        $this->record->gallery()->delete();

        foreach ($this->galleryImages as $image) {
            $this->record->gallery()->create([
                'image' => $image,
            ]);
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['project_gallery'] =
            $this->record->gallery->pluck('image')->toArray();

        return $data;
    }


}
