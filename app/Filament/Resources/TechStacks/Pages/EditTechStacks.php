<?php

namespace App\Filament\Resources\TechStacks\Pages;

use App\Filament\Resources\TechStacks\TechStacksResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTechStacks extends EditRecord
{
    protected static string $resource = TechStacksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public static function afterSave(): void
    {
        Notification::make()
            ->title('Tech Stack updated successfully')
            ->success()
            ->send();
        
        auth()->user()->createLog(request(), 'Updated Tech Stack', 'Tech Stack ' . $record->name . ' updated successfully');
    }
}
