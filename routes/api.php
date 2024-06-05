<?php

use Illuminate\Support\Facades\Route;

Route::prefix('announcements')
    ->name('announcement')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('.index');
        Route::post('/{announcement}', [App\Http\Controllers\AnnouncementController::class, 'show'])
        ->whereNumber('announcement')
        ->name('.show');
        Route::post('/', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('.store');
    });
