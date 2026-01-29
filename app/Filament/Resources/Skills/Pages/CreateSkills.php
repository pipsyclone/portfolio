<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSkills extends CreateRecord
{
    protected static string $resource = SkillsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
