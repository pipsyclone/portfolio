<?php

namespace App\Filament\Resources\TechStacks\Pages;

use App\Filament\Resources\TechStacks\TechStacksResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use Filament\Notifications\Notification;

class EditTechStacks extends EditRecord
{
    protected static string $resource = TechStacksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->successNotification(null)
                ->failureNotification(null),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }
}
