<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Cookie yang dikecualikan dari enkripsi.
     */
    protected $except = [
        //
    ];
}
