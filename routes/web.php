<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/backup/download/{file}', function ($file) {
    $path = storage_path('app/backups/' . $file);
    abort_unless(File::exists($path), 404);
    return response()->download($path);
})->name('backup.download');

Route::get('/', function () {
    return view('index');
})->name('index');