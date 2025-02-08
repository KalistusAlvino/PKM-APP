<?php


use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\DashboardController\MahasiswaController;
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

Route::get('/', [HomeController::class, 'getHomePage'])->name('halamanHome');
// User Register
Route::get('/register', [RegisterController::class, 'getRegisterPage'])->name('halamanRegister');
Route::post('/post-register', [RegisterController::class, 'storeMahasiswa'])->name('storeMahasiswa');
Route::get('/get-program-studi/{fakultas_id}', [RegisterController::class, 'getProgramStudi']);
// End User Register

// User Login
Route::post('/post-login',[LoginController::class,'postLogin'])->name('auth.login');
Route::get('/login', [LoginController::class, 'getLoginPage'])->name('halamanLogin');
//End User Login


Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'getDashboardMahasiswa'])->name('mahasiswa.dashboard');
    Route::get('/dashboard/kelompok', [MahasiswaController::class, 'getKelompokPage'])->name('mahasiswa.daftar-kelompok');
});
