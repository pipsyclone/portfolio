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
        return Notification::make()
            ->title('Project created successfully')
            ->success();
    }

    public function afterCreate(): void
    {
        auth()->user()->createLog(request(), 'Created Project', 'Project ' . $this->record->name . ' created successfully.');
    }
}
