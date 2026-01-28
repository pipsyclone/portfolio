<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Details')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Project Title')
                            ->default('-'),
                        TextEntry::make('url')
                            ->label('Project URL')
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->default('-'),
                        TextEntry::make('techStacks.name')
                            ->label('Tech Stacks')
                            ->badge()
                            ->default('-'),
                        TextEntry::make('description')
                            ->label('Project Description')
                            ->default('-'),
                    ]),
                Section::make('Project Image')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Project Image')
                            ->disk('public')
                            ->height('auto')
                            ->width('100%')
                            ->visibility('public')
                            ->extraImgAttributes([
                                'class' => 'max-w-full h-auto object-contain rounded-lg',
                                'style' => 'max-height: 400px;',
                            ])
                            ->defaultImageUrl(null)
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
