<?php

namespace App\Filament\Resources\TechStacks\Pages;

use App\Filament\Resources\TechStacks\TechStacksResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTechStacks extends CreateRecord
{
    protected static string $resource = TechStacksResource::class;

    public function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    public static function afterCreate(): void
    {
        Notification::make()
            ->title('Tech Stack created successfully')
            ->success()
            ->send();
        
        auth()->user()->createLog(request(), 'Created Tech Stack', 'Tech Stack ' . $record->name . ' created successfully');
    }
}
