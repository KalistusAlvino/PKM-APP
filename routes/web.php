<?php


use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\DashboardController\MainController;
use App\Http\Controllers\LandingPageController\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.home');
});

Route::get('/',[HomeController::class,'getHomePage'])->name('halamanHome');
Route::get('/login', [LoginController::class,'getLoginPage'])->name('halamanLogin');
Route::get('/register', [RegisterController::class,'getRegisterPage'])->name('halamanRegister');
Route::get('/dashboard',[MainController::class,'getDashboardPage'])->name('halamanDashboard');
