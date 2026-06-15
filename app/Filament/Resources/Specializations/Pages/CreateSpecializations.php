<?php

namespace App\Filament\Resources\Specializations\Pages;

use App\Filament\Resources\Specializations\SpecializationsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSpecializations extends CreateRecord
{
    protected static string $resource = SpecializationsResource::class;

    public function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    public static function afterCreate(): void
    {
        Notification::make()
            ->title('Specialization created successfully')
            ->success()
            ->send();
        
        auth()->user()->createLog(request(), 'Created Speacialization', 'Specialization ' . $record->name . ' created successfully');
    }
}
