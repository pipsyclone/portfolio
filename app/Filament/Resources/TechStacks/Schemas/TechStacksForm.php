<?php

namespace App\Filament\Resources\TechStacks\Schemas;

use App\Models\TechStacks;
use Filament\Forms\Components\TextInput;
// Form Components
use Filament\Schemas\Schema;

class TechStacksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Tech Stack')
                    ->required()
                    ->maxLength(255)
                    ->unique(
                        table: TechStacks::class,
                        column: 'name',
                        ignoreRecord: true
                    )
                    ->validationMessages([
                        'required' => 'Nama Tech Stack wajib diisi.',
                        'max' => 'Nama Tech Stack maksimal 255 karakter.',
                        'unique' => 'Nama Tech Stack sudah ada.',
                    ]),
            ]);
    }
}
