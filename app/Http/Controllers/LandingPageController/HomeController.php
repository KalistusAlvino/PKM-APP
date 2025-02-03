<?php

namespace App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHomePage()
    {
        return view('landing.home');
    }
}
