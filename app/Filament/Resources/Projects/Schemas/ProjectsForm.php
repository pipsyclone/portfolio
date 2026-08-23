<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

use App\Models\TechStacks;
use App\Models\Specializations;

class ProjectsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Projects')
                    ->columnSpanFull()
                    ->components([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->required(),
                        FileUpload::make('image')
                            ->label('Image')
                            ->required()
                            ->maxSize(2048)
                            ->disk('private')
                            ->visibility('private')
                            ->directory('projects')
                            ->imageEditor(),
                        TextInput::make('url')
                            ->label('URL')
                            ->required()
                            ->maxLength(255),
                        Grid::make()
                            ->columns(2)
                            ->components([
                                Select::make('tech_stack_id')
                                    ->label('Tech Stacks')
                                    ->relationship('techStacks', 'name')
                                    ->required()
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                                Select::make('specialization_id')
                                    ->label('Specializations')
                                    ->relationship('specializations', 'name')
                                    ->required()
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ]),
            ]);
    }
}
