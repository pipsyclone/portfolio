<?php

namespace App\Livewire\Widgets\Visitors;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Visitor;

class VisitorTable extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Visitor::query()->latest('visited_date')->latest('id'))
            ->columns([
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('user_agent')
                    ->label('User Agent')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),
                TextColumn::make('visited_date')
                    ->label('Visited Date')
                    ->date(),
                TextColumn::make('created_at')
                    ->label('Visited')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->infolist([
                        \Filament\Schemas\Components\Section::make('Visitor Details')
                            ->schema([
                                \Filament\Infolists\Components\TextEntry::make('ip_address')
                                    ->label('IP Address')
                                    ->copyable()
                                    ->icon('heroicon-m-globe-alt'),
                                \Filament\Infolists\Components\TextEntry::make('created_at')
                                    ->label('Visited')
                                    ->since()
                                    ->icon('heroicon-m-clock'),
                                \Filament\Infolists\Components\TextEntry::make('user_agent')
                                    ->label('User Agent')
                                    ->columnSpanFull()
                                    ->icon('heroicon-m-computer-desktop'),
                            ])
                            ->columns(2),
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
