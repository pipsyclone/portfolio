<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use App\Models\ActivityLogs as ActivityLogsModel;

use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\Action;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\TextEntry;

use Filament\Notifications\Notification;

class ActivityLogs extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.activity-logs';
    protected static ?string $navigationLabel = 'Activity Logs';
    protected static ?string $title = 'Activity Logs';
    protected static string|UnitEnum|null $navigationGroup = 'System';

    public static function canAccess(): bool
    {
        return auth()->user()->can('viewAny', static::class);
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('reset')
                ->label('Reset Activity Logs')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->color('danger')
                ->visible(fn () => auth()->user()->can('delete', static::class))
                ->action(function () {
                    try {
                        ActivityLogsModel::truncate();
                        Notification::make()
                            ->title('Successfully deleted all!')
                            ->body('All activity logs have been deleted successfully!')
                            ->success()
                            ->send();
                        return $this->redirect(request()->header('Referer') ?? url()->current());
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Error, failed to delete all!')
                            ->body('Failed to delete all activity logs, error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                        return $this->redirect(request()->header('Referer') ?? url()->current());
                    }
                })
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActivityLogsModel::with('user')->latest())
            ->defaultSort('created_at', 'desc')
            ->poll('10s')
            ->deferloading()
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->default('Anonymous')
                    ->searchable(),
                TextColumn::make('activity')
                    ->label('Activity')
                    ->badge()
                    ->color('info'),
                TextColumn::make('ip_address')
                    ->label('IP Address'),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(40),
                TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view')
                    ->visible(fn () => auth()->user()->can('view', static::class))
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->infolist([
                        TextEntry::make('user.name')
                            ->label('User'),
                        TextEntry::make('activity')
                            ->label('Activity')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('ip_address')
                            ->label('IP Address'),
                        TextEntry::make('user_agent')
                            ->label('User Agent')
                            ->default('-'),
                        TextEntry::make('description')
                            ->label('Description'),
                        TextEntry::make('created_at')
                            ->label('Time')
                            ->dateTime('d M Y, H:i:s'),
                    ])
                    ->modalHeading('Detail Activity Logs')
                    ->modalWidth('lg')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
            ]);
    }
}
