<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Nilai yang dikecualikan dari trimming.
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
