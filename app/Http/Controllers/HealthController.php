<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{
    /**
     * Check that service is healthy.
     * @return array
     */
    public function check(): array
    {
        return [
            'ok' => true,
            'elapsed' => microtime(true) - LARAVEL_START,
        ];
    }

    /**
     * Check that service is available.
     * @return array
     */
    public function availability(): array
    {
        return [
            'ok' => true,
            'elapsed' => microtime(true) - LARAVEL_START,
        ];
    }
}
