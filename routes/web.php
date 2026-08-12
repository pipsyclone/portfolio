<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Models\Visitor;

Route::get('/backup/download/{file}', function ($file) {
    $path = storage_path('app/backups/' . $file);
    abort_unless(File::exists($path), 404);
    return response()->download($path);
})->name('backup.download');

Route::get('/view/cv', function () {
    $user = \App\Models\User::first();
    if (!$user || !$user->cv_file) {
        abort(404);
    }

    abort_unless(\Illuminate\Support\Facades\Storage::disk('public')->exists($user->cv_file), 404);

    $filename = 'CV_' . str_replace(' ', '_', $user->name) . '.' . pathinfo($user->cv_file, PATHINFO_EXTENSION);

    return response(\Illuminate\Support\Facades\Storage::disk('public')->get($user->cv_file), 200, [
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
})->name('view.cv');

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