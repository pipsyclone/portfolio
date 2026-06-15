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
            DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Specialization updated successfully')
            ->success();
    }

    public function afterSave(): void
    {
        auth()->user()->createLog(request(), 'Updated Specialization', 'Specialization ' . $this->record->name . ' updated successfully');
    }
}
