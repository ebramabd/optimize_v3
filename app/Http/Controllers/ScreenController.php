<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreenController extends Controller
{
    function welcome()
    {
        return view('screens.welcome');
    }

    function authentication()
    {
        return view('screens.authentication');
    }

    function recoverPassword()
    {
        return view('screens.recover-password');
    }

    function verificationCode()
    {
        return view('screens.verification-code');
    }

    function transition()
    {
        return view('screens.transition');
    }
}
