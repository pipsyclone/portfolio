<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectsResource;
use Filament\Resources\Pages\CreateRecord;

use Filament\Notifications\Notification;

class CreateProjects extends CreateRecord
{
    protected static string $resource = ProjectsResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
}
