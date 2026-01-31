<?php

namespace App\Filament\Resources\TechStacks\Tables;

// Table Columns
use Filament\Actions\Action;

// Table Actions
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TechStacksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Teknologi Stack')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([

            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Tidak ada Teknologi Stack')
            ->emptyStateDescription('Silakan tambahkan Teknologi Stack baru.')
            ->emptyStateIcon('heroicon-o-bookmark')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Teknologi Stack')
                    ->icon('heroicon-o-plus')
                    ->url(route('filament.admin.resources.tech-stacks.create')),
            ])
            ->deferLoading();
    }
}
