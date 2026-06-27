<?php

namespace App\Filament\Resources\Specializations\Pages;

use App\Filament\Resources\Specializations\SpecializationsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use Filament\Notifications\Notification;

class EditSpecializations extends EditRecord
{
    protected static string $resource = SpecializationsResource::class;

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
