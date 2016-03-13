<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $captcha = app(\Gregwar\Captcha\CaptchaBuilderInterface::class);
        var_dump($captcha);
        return 'test';
    }
}
