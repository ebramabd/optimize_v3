<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use JetBrains\PhpStorm\NoReturn;

class AdminPanelController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        App::setLocale('en');
    }
}
