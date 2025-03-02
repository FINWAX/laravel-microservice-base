<?php

use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use MGGFLOW\LVMSVC\Middleware\CookiesAttach;
use MGGFLOW\LVMSVC\Middleware\CookiesDecoder;
use MGGFLOW\LVMSVC\Middleware\CookiesEncryption;
use MGGFLOW\LVMSVC\Middleware\ResponseEncoder;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'throttle' => ThrottleRequests::class,
            'verified' => EnsureEmailIsVerified::class,
            'bindings' => SubstituteBindings::class,

            'msvc_response_encoder' => ResponseEncoder::class,
            'msvc_cookies_encrypter' => CookiesEncryption::class,
            'msvc_cookies_handler' => CookiesAttach::class,
            'msvc_cookies_decoder' => CookiesDecoder::class,
        ]);

        $middleware->group('api', [
            'throttle:api',
            'msvc_cookies_encrypter',
            'msvc_cookies_decoder',
            'msvc_cookies_handler',
            'msvc_response_encoder',
            'bindings',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
