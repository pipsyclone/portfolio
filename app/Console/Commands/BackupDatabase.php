<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use App\LogActivityTrait;

class BackupDatabase extends Command
{
    use LogActivityTrait;
    protected $signature = 'db:backup';

    protected $description = 'Automatic backup database to .sql.gz file';

    public function handle(): int
    {
        $this->info('Starting database backup...');

        try {

            $dbName = config('database.connections.mysql.database');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbHost = config('database.connections.mysql.host');

            if (! $dbName || ! $dbUser || ! $dbHost) {

                $this->error('Database configuration is incomplete.');

                return self::FAILURE;
            }

            $backupDir = storage_path('app/backups');

            if (! File::exists($backupDir)) {
                File::makeDirectory($backupDir, 0755, true);
            }

            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');

            $backupFile = "{$backupDir}/backup_{$timestamp}.sql.gz";

            $command = sprintf(
                'mysqldump --host=%s --user=%s %s %s | gzip > %s 2>&1',
                escapeshellarg($dbHost),
                escapeshellarg($dbUser),
                $dbPass
                    ? '--password=' . escapeshellarg($dbPass)
                    : '',
                escapeshellarg($dbName),
                escapeshellarg($backupFile),
            );

            $output = [];
            $result = 1;

            exec($command, $output, $result);

            if ($result !== 0 || ! File::exists($backupFile)) {

                $this->error('Backup database failed.');

                if (! empty($output)) {
                    $this->line(implode(PHP_EOL, $output));
                }

                return self::FAILURE;
            }

            $this->cleanOldBackups($backupDir);

            $this->info('Backup success: ' . basename($backupFile));
            $this->logActivity('Backup Database', 'Automatic backup database success: ' . basename($backupFile), 'System');

            return self::SUCCESS;

        } catch (\Throwable $e) {

            $this->error('Error: ' . $e->getMessage());
            $this->logActivity('Backup Database', 'Automatic backup database failed: ' . $e->getMessage(), 'System');

            return self::FAILURE;
        }
    }

    private function cleanOldBackups(string $backupDir): void
    {
        $files = collect(File::files($backupDir))
            ->filter(fn ($file) =>
                str($file->getFilename())->endsWith('.sql.gz')
            )
            ->sortByDesc(fn ($file) => $file->getMTime());

        $files
            ->slice(10)
            ->each(fn ($file) =>
                File::delete($file->getRealPath())
            );
        
        $this->logActivity('Backup Database', 'Automatic clean old backup database success', 'System');
    }
}