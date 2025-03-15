<?php

use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\HealthController;
use Illuminate\Support\Facades\Route;
use MGGFLOW\ExceptionManager\ManageException;


Route::prefix('health')->group(function () {
    Route::any('availability', [HealthController::class, 'availability']);
    Route::any('check', [HealthController::class, 'check']);
});

Route::any('greeting/hello-unprotected', [GreetingsController::class, 'unprotectedHello']);
Route::any('greeting/hello-protected', [GreetingsController::class, 'protectedHello'])
    ->middleware('auth_zitadel_basic_intro');

/**
 * API 404 handling.
 */
Route::fallback(function () {
    throw ManageException::build()
        ->log()->info()->b()
        ->desc()->not('API')->found()->b()
        ->fill();
});
