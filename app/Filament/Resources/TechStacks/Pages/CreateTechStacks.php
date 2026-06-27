<?php

namespace App\Filament\Resources\TechStacks\Pages;

use App\Filament\Resources\TechStacks\TechStacksResource;
use Filament\Resources\Pages\CreateRecord;

use Filament\Notifications\Notification;

class CreateTechStacks extends CreateRecord
{
    protected static string $resource = TechStacksResource::class;

    public function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
}
