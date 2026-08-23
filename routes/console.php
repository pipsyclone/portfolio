<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Without a frequency, Laravel runs a scheduled command every minute — a full
// mysqldump every 60s is unnecessary load, so pin this to once a day instead.
Schedule::command('db:backup')->daily(); // Schedule Backup Database

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
