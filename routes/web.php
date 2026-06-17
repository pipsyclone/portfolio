<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/backup/download/{file}', function ($file) {
    $path = storage_path('app/backups/' . $file);
    abort_unless(File::exists($path), 404);
    return response()->download($path);
})->name('backup.download');

Route::get('/', function (\Illuminate\Http\Request $request) {
    try {
        \App\Models\Visitor::firstOrCreate(
            [
                'ip_address' => $request->ip(),
                'visited_date' => now()->toDateString(),
            ],
            [
                'user_agent' => $request->userAgent()
            ]
        );
    } catch (\Exception $e) {
        // Silently ignore tracking errors so they don't break the site
    }

    return view('index');
})->name('index');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');