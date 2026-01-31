<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Tables\Table;

// Table Columns
use Filament\Tables\Columns\TextColumn;

// Table Actions
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;

// Bulk Actions
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Proyek')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('url')
                    ->label('URL Proyek')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Tidak ada Proyek')
            ->emptyStateDescription('Silakan tambahkan Proyek baru.')
            ->emptyStateIcon('heroicon-o-bookmark')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Proyek')
                    ->icon('heroicon-o-plus')
                    ->url(route('filament.admin.resources.projects.create')),
            ])
            ->deferLoading();
    }
}
