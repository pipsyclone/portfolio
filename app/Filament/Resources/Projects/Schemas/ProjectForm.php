<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Projects;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
// Form Component
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Details')
                    ->schema([
                        TextInput::make('title')
                            ->label('Project Title')
                            ->required()
                            ->unique(table: Projects::class, ignoreRecord: true)
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Judul proyek harus diisi.',
                                'unique' => 'Judul proyek sudah digunakan.',
                            ]),
                        TextInput::make('url')
                            ->label('Project URL')
                            ->url()
                            ->maxLength(255),
                        Select::make('techStacks')
                            ->label('Tech Stacks')
                            ->multiple()
                            ->relationship('techStacks', 'name')
                            ->preload()
                            ->searchable(),
                        Textarea::make('description')
                            ->label('Project Description')
                            ->maxLength(65535),
                    ]),
                Section::make('Project Image')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Project Image')
                            ->image()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->disk('public')
                            ->directory('project-images')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->validationMessages([
                                'image' => 'File harus berupa gambar.',
                                'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
                                'accepted_file_types' => 'Tipe file gambar tidak valid. Hanya JPEG, PNG, GIF, dan WEBP yang diperbolehkan.',
                            ]),
                    ]),
            ]);
    }
}
