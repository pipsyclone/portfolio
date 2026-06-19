<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Models\Visitor;

Route::get('/backup/download/{file}', function ($file) {
    $path = storage_path('app/backups/' . $file);
    abort_unless(File::exists($path), 404);
    return response()->download($path);
})->name('backup.download');

Route::get('/download/cv', function () {
    $user = \App\Models\User::first();
    if (!$user || !$user->cv_file) {
        abort(404);
    }
    
    $path = storage_path('app/public/' . $user->cv_file);
    abort_unless(File::exists($path), 404);
    
    return response()->download($path, 'CV_' . str_replace(' ', '_', $user->name) . '.' . pathinfo($path, PATHINFO_EXTENSION));
})->name('download.cv');

Route::get('/', function (\Illuminate\Http\Request $request) {
    Visitor::create([
        'ip_address' => $request->ip(),
        'visited_date' => now()->toDateString(),
        'user_agent' => $request->userAgent()
    ]);
    return view('index');
})->name('index');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');