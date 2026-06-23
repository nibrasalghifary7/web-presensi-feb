<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller Base
 * Controller induk yang di-extend oleh semua controller lainnya.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
