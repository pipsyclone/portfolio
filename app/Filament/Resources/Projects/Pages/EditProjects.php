<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use Filament\Notifications\Notification;

class EditProjects extends EditRecord
{
    protected static string $resource = ProjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }
}
