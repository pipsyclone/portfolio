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
        return null;
    }
}
