<?php

namespace App\Filament\Resources\Specializations\Pages;

use App\Filament\Resources\Specializations\SpecializationsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpecializations extends EditRecord
{
    protected static string $resource = SpecializationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public static function afterSave(): void
    {
        Notification::make()
            ->title('Specialization updated successfully')
            ->success()
            ->send();
        
        auth()->user()->createLog(request(), 'Updated Specialization', 'Specialization ' . $record->name . ' updated successfully');
    }
}
