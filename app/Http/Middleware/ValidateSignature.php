<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

class ValidateSignature extends Middleware
{
    /**
     * Nama parameter yang harus divalidasi.
     */
    protected $signatureParam = 'signature';

    /**
     * Parameter yang dikecualikan dari validasi signature.
     */
    protected $except = [
        //
    ];
}
