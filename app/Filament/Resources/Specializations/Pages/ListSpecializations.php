<?php

namespace App\Filament\Resources\Specializations\Pages;

use App\Filament\Resources\Specializations\SpecializationsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpecializations extends ListRecords
{
    protected static string $resource = SpecializationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
