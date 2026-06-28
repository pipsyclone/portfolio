<?php

namespace App\Filament\Pages;
use App\LogActivityTrait;

use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Filament\Pages\Page;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class DatabaseBackup extends Page implements HasTable
{
    use InteractsWithTable, LogActivityTrait;

    protected string $view = 'filament.pages.database-backup';
    protected static ?string $navigationLabel = 'Database Backup';
    protected static ?string $title = 'Database Backup';
    protected static string|UnitEnum|null $navigationGroup = 'System';

    public static function canAccess(): bool
    {
        return auth()->user()->can('viewAny', static::class);
    }

    public function table(Table $table): Table
    {
        $backupDir = storage_path('app/backups');
        if (! File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        return $table
            ->records(fn () => collect(File::files($backupDir))
            ->sortByDesc(fn ($file) => $file->getCTime())
            ->map(fn ($file) => [
                'name' => $file->getFilename(),
                'path' => $file->getRealPath(),
                'size' => round($file->getSize() / 1024 / 1024, 2) . ' MB',
                'date' => date('Y-m-d H:i:s', $file->getCTime()),
            ]))
            ->columns([
                TextColumn::make('name')
                    ->label('File Name')
                    ->searchable(),

                TextColumn::make('size')
                    ->label('Size'),

                TextColumn::make('date')
                    ->label('Backup Date'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->deselectRecordsAfterCompletion()
                        ->action(function ($records) {
                            collect($records)->each(fn ($record) => File::delete($record['path']));
                            $this->redirect(request()->header('Referer') ?? url()->current()); // refresh table
                        }),
                ])
                ->visible(fn () => auth()->user()->can('delete', static::class)),
            ])
            ->actions([
                Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->url(fn ($record) => route('backup.download', $record['name']))
                    ->openUrlInNewTab(),

                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->visible(fn ($record) => auth()->user()->can('delete', static::class))
                    ->action(function ($record) {
                        try {
                            File::delete($record['path']);

                            Notification::make()
                                ->title('Successfully deleted backup!')
                                ->body('Backup database successfully deleted!')
                                ->success()
                                ->send();
                            $this->logActivity('Backup database', 'Successfully deleted backup database: ' . date('Y-m-d H:i:s') . '!');
                            return $this->redirect(request()->header('Referer') ?? url()->current());
                        } catch (\Throwable $e) {
                            Notification::make()
                                ->title('Error, failed to delete backup!')
                                ->body('Backup database failed, error: ' . $e->getMessage())
                                ->danger()
                                ->send();
                            return $this->redirect(request()->header('Referer') ?? url()->current());
                            \Log::error($e->getMessage());
                        }
                    }),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('backup')
                ->label('Backup Database')
                ->icon('heroicon-o-cloud-arrow-down')
                ->requiresConfirmation()
                ->visible(fn () => auth()->user()->can('create', static::class))
                ->action(fn () => $this->backupDatabase()),
        ];
    }

    public function backupDatabase(): void
    {
        try {

            $dbName = config('database.connections.mysql.database');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbHost = config('database.connections.mysql.host');

            $backupDir = storage_path('app/backups');

            if (! File::exists($backupDir)) {
                File::makeDirectory($backupDir, 0755, true);
            }

            $timestamp = now()->format('Y-m-d_H-i-s');

            $gzFile = "{$backupDir}/backup_{$timestamp}.sql.gz";

            $command = sprintf(
                'mysqldump --host=%s --user=%s %s %s | gzip > %s',
                escapeshellarg($dbHost),
                escapeshellarg($dbUser),
                $dbPass
                    ? '--password=' . escapeshellarg($dbPass)
                    : '',
                escapeshellarg($dbName),
                escapeshellarg($gzFile),
            );

            exec($command, $output, $result);

            if ($result !== 0 || ! File::exists($gzFile)) {

                Notification::make()
                    ->title('Error, failed to backup database!')
                    ->body('Please make sure that the database connection is correct and the backup directory exists!')
                    ->danger()
                    ->send();

                return;
            }

            $this->cleanOldBackups($backupDir);

            Notification::make()
                ->title('Successfully backup database!')
                ->body('Backup database successfully created!')
                ->success()
                ->send();
            $this->logActivity('Backup database', 'Successfully backup database: ' . date('Y-m-d H:i:s') . '!');
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Error, failed to backup database!')
                ->body($e->getMessage())
                ->danger()
                ->send();
            \Log::error($e->getMessage());
        }
    }

    private function cleanOldBackups(string $backupDir): void
    {
        $files = collect(File::files($backupDir))
            ->filter(fn ($file) =>
                str($file->getFilename())->startsWith('backup_')
            )
            ->sortByDesc(fn ($file) => $file->getMTime());

        $files
            ->slice(10)
            ->each(fn ($file) =>
                File::delete($file->getRealPath())
            );
    }
}