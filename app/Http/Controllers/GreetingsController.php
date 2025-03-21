<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingsController extends Controller
{
    public function unprotectedHello(Request $request): array
    {
        $res = [
            'greeting' => 'Hello',
        ];
        if ($request->has('name')) {
            $res['greeting'] .= ' ' . $request->get('name');
        }

        return $res;
    }

    public function protectedHello(Request $request): array
    {
        $res = [
            'greeting' => 'Hello',
            'user' => $request->attributes->get('user'),
        ];
        if ($request->has('name')) {
            $res['greeting'] .= ' ' . $request->get('name');
        }

        return $res;
    }
}
