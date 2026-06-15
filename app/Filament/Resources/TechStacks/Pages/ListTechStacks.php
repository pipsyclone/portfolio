<?php

namespace App\Filament\Resources\TechStacks\Pages;

use App\Filament\Resources\TechStacks\TechStacksResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTechStacks extends ListRecords
{
    protected static string $resource = TechStacksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
