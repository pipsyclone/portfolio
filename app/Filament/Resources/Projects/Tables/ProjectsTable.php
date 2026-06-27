<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Tables\Filters\SelectFilter;


class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query->orderBy('created_at', 'desc');
            })
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(50),
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->height(100)
                    ->getStateUsing(fn ($record) => safe_image_url($record->image)),
                TextColumn::make('url')
                    ->label('URL')
                    ->color('info')
                    ->limit(50)
                    ->searchable()
                    ->tooltip('Open in new tab')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab(),
                TextColumn::make('techStacks.name')
                    ->label('Tech Stacks')
                    ->badge()
                    ->listWithLineBreaks()
                    ->searchable(),
                TextColumn::make('specializations.name')
                    ->label('Specializations')
                    ->badge()
                    ->listWithLineBreaks()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('tech_stack_id')
                    ->label('Tech Stacks')
                    ->relationship('techStacks', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('specialization_id')
                    ->label('Specializations')
                    ->relationship('specializations', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(null)
                    ->failureNotification(null)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->successNotification(null)
                        ->failureNotification(null),
                ]),
            ]);
    }
}
