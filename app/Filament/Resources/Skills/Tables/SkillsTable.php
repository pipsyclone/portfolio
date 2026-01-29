<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Tables\Table;

// Table Columns
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;

// Table Actions
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Keahlian')
                    ->formatStateUsing(fn ($state, $record): HtmlString => new HtmlString(
                        $record->icon
                            ? "<span class='flex items-center gap-2'><i class='{$record->icon}' style='font-size: 1.25rem; margin-right: 0.5rem;'></i> {$state}</span>"
                            : $state
                    ))
                    ->html()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Tidak ada Keahlian')
            ->emptyStateDescription('Silakan tambahkan Keahlian baru.')
            ->emptyStateIcon('heroicon-o-bookmark')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah keahlian')
                    ->icon('heroicon-o-plus')
                    ->url(route('filament.admin.resources.skills.create')),
            ])
            ->deferLoading();
    }
}
