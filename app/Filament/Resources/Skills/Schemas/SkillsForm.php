<?php

namespace App\Filament\Resources\Skills\Schemas;

use App\Models\Skills;
use Filament\Forms\Components\TextInput;
// Form Component
use Filament\Schemas\Schema;

class SkillsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Keahlian')
                    ->required()
                    ->unique(table: Skills::class, ignoreRecord: true)
                    ->maxLength(255)
                    ->validationMessages([
                        'required' => 'Nama skill harus diisi.',
                        'unique' => 'Nama skill sudah digunakan.',
                        'max' => 'Panjang maksimal nama skill adalah 255 karakter.',
                    ]),
                TextInput::make('icon')
                    ->label('Icon Class')
                    ->placeholder('contoh: devicon-laravel-original atau fa-brands fa-laravel')
                    ->helperText('Masukkan class icon dari Devicon, Font Awesome, atau library icon lainnya')
                    ->maxLength(255),
            ]);
    }
}
