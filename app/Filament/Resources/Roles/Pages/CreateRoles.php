<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RolesResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateRoles extends CreateRecord
{
    protected static string $resource = RolesResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }
}
