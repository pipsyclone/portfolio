<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Projects;
use App\Models\Skills;
// Form Component
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
// Schema Components
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

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
                        Grid::make()
                            ->schema([
                                Select::make('techStacks')
                                    ->label('Tech Stacks')
                                    ->required()
                                    ->multiple()
                                    ->relationship('techStacks', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->noSearchResultsMessage('Tidak ada data ditemukan')
                                    ->noOptionsMessage('Tidak ada data')
                                    ->validationMessages([
                                        'required' => 'Tech Stacks harus dipilih.',
                                    ]),
                                Select::make('skills')
                                    ->label('Keahlian')
                                    ->required()
                                    ->multiple()
                                    ->relationship('skills', 'name')
                                    ->getOptionLabelFromRecordUsing(fn (Skills $record): HtmlString => new HtmlString(
                                        $record->icon
                                            ? "<span class='flex items-center gap-2'><i class='{$record->icon}'></i> {$record->name}</span>"
                                            : $record->name
                                    ))
                                    ->allowHtml()
                                    ->preload()
                                    ->searchable()
                                    ->noSearchResultsMessage('Tidak ada data ditemukan')
                                    ->noOptionsMessage('Tidak ada data')
                                    ->validationMessages([
                                        'required' => 'Keahlian harus dipilih.',
                                    ]),
                            ])
                            ->columns(2),
                        Select::make('status')
                            ->label('Status Proyek')
                            ->options([
                                'ongoing' => 'Ongoing',
                                'completed' => 'Completed',
                                'on_hold' => 'On Hold',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->allowHtml()
                            ->preload()
                            ->searchable()
                            ->noSearchResultsMessage('Tidak ada data ditemukan')
                            ->noOptionsMessage('Tidak ada data')
                            ->validationMessages([
                                'required' => 'Status Proyek harus dipilih.',
                            ]),
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
                            ->disk('cloudinary')
                            ->directory('portfolio/projects')
                            ->visibility('public')
                            ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                            ->afterStateHydrated(function ($component, $state) {
                                if ($state && ! str_contains($state, '/')) {
                                    $component->state(['portfolio/projects/'.$state]);
                                }
                            })
                            ->validationMessages([
                                'image' => 'File harus berupa gambar.',
                                'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
                                'accepted_file_types' => 'Tipe file gambar tidak valid. Hanya JPEG, PNG, GIF, dan WEBP yang diperbolehkan.',
                            ]),
                    ]),
            ]);
    }
}
