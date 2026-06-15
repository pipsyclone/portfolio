<?php

namespace App\Filament\Resources\Specializations\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;

class SpecializationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->autofocus()
                            ->placeholder('Input Name Specializations')
                            ->maxLength(255),
                    ])
            ]);
    }
}
