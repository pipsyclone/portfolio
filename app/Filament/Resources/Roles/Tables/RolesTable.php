<?php

namespace App\Filament\Resources\Roles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug')->searchable()->sortable(),
                TextColumn::make('description')->label('Description')->searchable()->sortable(),
                TextColumn::make('permissions_count')
                    ->label('Permissions')
                    ->badge()
                    ->getStateUsing(fn($record) => $record->permissions()->count())
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(null)
                    ->failureNotification(null),
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
