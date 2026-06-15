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
            DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Tech Stack updated successfully')
            ->success();
    }

    public function afterSave(): void
    {
        auth()->user()->createLog(request(), 'Updated Tech Stack', 'Tech Stack ' . $this->record->name . ' updated successfully');
    }
}
