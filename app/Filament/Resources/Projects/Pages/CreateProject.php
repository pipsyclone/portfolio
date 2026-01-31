<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Extract filename saja untuk image
        if (! empty($data['image'])) {
            $data['image'] = is_array($data['image'])
                ? basename($data['image'][array_key_first($data['image'])] ?? '')
                : basename($data['image']);
        }

        return $data;
    }
}
