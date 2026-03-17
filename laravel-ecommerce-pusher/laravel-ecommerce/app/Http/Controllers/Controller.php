<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
// In Laravel 11+, you might need to explicitly use Illuminate\Routing\Controller
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController  // Extend the base controller
{
    use AuthorizesRequests, ValidatesRequests;
}
