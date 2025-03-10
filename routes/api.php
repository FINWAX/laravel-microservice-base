<?php

use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Route;
use MGGFLOW\ExceptionManager\ManageException;


Route::prefix('monitoring')->group(function () {
    Route::any('ping', [MonitoringController::class, 'ping']);
});

Route::any('greeting', [GreetingsController::class, 'hello']);
Route::any('protectedGreeting', [GreetingsController::class, 'protectedHello'])
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
