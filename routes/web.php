<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

// routes/web.php
Route::get('/health', function () {
    return response()->json(['status' => 'healthy']);
});
