<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

// Auto reset cache for views in dev environment
if (config('app.env', 'production') != 'production') {
    Artisan::call('view:clear');
}

Route::get('/', function () {
    return Response::make(config('app.name').' is available.');
});
