<?php

use Illuminate\Support\Facades\Route;

Route::prefix('announcements')
    ->name('announcement')
    ->group(function () {
        Route::post('/', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('.store');
    });
