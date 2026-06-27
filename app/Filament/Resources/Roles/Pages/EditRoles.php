<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RolesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditRoles extends EditRecord
{
    protected static string $resource = RolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
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
