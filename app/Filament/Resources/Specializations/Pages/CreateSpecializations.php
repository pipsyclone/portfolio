<?php

namespace App\Filament\Resources\Specializations\Pages;

use App\Filament\Resources\Specializations\SpecializationsResource;
use Filament\Resources\Pages\CreateRecord;

use Filament\Notifications\Notification;

class CreateSpecializations extends CreateRecord
{
    protected static string $resource = SpecializationsResource::class;

    public function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Specialization created successfully')
            ->success();
    }

    public function afterCreate(): void
    {
        auth()->user()->createLog(request(), 'Created Specialization', 'Specialization ' . $this->record->name . ' created successfully');
    }
}
