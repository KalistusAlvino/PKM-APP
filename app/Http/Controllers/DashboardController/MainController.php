<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getDashboardPage()
    {
        return view('dashboard.assets.main');
    }
}
