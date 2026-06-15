<?php

namespace App\Filament\Resources\TechStacks\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;

class TechStacksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),
                ]),
            ]);
    }
}
