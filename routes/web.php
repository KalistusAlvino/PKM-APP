<?php


use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\DashboardController\AnggotaController;
use App\Http\Controllers\DashboardController\BiroController;
use App\Http\Controllers\DashboardController\DosenController;
use App\Http\Controllers\DashboardController\KoordinatorController;
use App\Http\Controllers\DashboardController\MahasiswaController;
use App\Http\Controllers\KetuaController;
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
Route::post('/post-login', [LoginController::class, 'postLogin'])->name('auth.login');
Route::get('/login', [LoginController::class, 'getLoginPage'])->name('halamanLogin');
//End User Login

//User Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'getDashboardMahasiswa'])->name('mahasiswa.dashboard');
    Route::get('/dashboard/kelompok', [MahasiswaController::class, 'getKelompokPage'])->name('mahasiswa.daftar-kelompok');
    Route::get('/dashboard/daftar-ketua', [AnggotaController::class, 'getDaftarKetuaPage'])->name('mahasiswa.daftar-ketua');
    Route::post('/daftar-ketua/post-daftar-ketua', [AnggotaController::class, 'postDaftarKetua'])->name('mahasiswa.post-daftar-ketua');

    Route::middleware('verify.kelompok')->group(function () {
        Route::get('/dashboard/detail-kelompok/{id_kelompok}', [MahasiswaController::class, 'getDetailKelompokPage'])->name('mahasiswa.detail-kelompok');
        Route::post('/post-judul/{id_kelompok}', [MahasiswaController::class, 'storeJudul'])->name('storeJudul');
        Route::delete('/delete-judul/{id_kelompok}/{id_judul}', [MahasiswaController::class, 'deleteJudul'])->name('deleteJudul');
        Route::get('/detail-judul/{id_kelompok}/{id_judul}',[MahasiswaController::class,'detailJudul'])->name('detailJudul');
        Route::put('/update-judul/{id_kelompok}/{id_judul}',[MahasiswaController::class,'updateJudul'])->name('updateJudul');
        Route::get('/download-proposal/{id_kelompok}/{nama_file}',[MahasiswaController::class,'downloadProposal'])->name('downloadProposal');
        Route::middleware('cek.ketua')->group(function () {
            Route::get('/detail-kelompok/tambah-anggota/{id_kelompok}', [MahasiswaController::class, 'getTambahAnggotaPage'])->name('mahasiswa.tambah-anggota-page');
            Route::get('/detail-kelompok/tambah-dosen/{id_kelompok}', [MahasiswaController::class, 'getTambahDosenPage'])->name('mahasiswa.tambah-dosen-page');
            Route::post('/post-anggota/{id_kelompok}', [MahasiswaController::class, 'storeAnggota'])->name('storeAnggota');
            Route::post('/post-old-anggota/{id_kelompok}', [MahasiswaController::class, 'storeOldAnggota'])->name('storeOldAnggota');
            Route::post('/post-invite/{id_kelompok}/{id_dosen}', [MahasiswaController::class, 'storeInvite'])->name('storeInvite');
            Route::post('/post-file/{id_kelompok}', [KetuaController::class, 'storeFile'])->name('storeFile');
            Route::delete('/delete-anggota/{id_kelompok}/{id_mk}', [KetuaController::class, 'deleteAnggota'])->name('deleteAnggota');
            Route::patch('/delete-dospem/{id_kelompok}', [KetuaController::class, 'deleteDospem'])->name('deleteDospem');
        });
    });


});
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dashboard-dosen', [DosenController::class, 'getDashboardDosen'])->name('dosen.dashboard');
    Route::get('/dosen-daftarundangan', [DosenController::class, 'getUndanganDosen'])->name('dosen.daftar-undangan');
    Route::get('/dosen-daftarkelompok', [DosenController::class, 'getDaftarKelompok'])->name('dosen.daftar-kelompok');
    Route::get('/dosen-detailkelompok/{id}', [DosenController::class, 'getDetailKelompok'])->name('dosen.detail-kelompok');
    Route::put('/dosen-terimaundangan/{id_kelompok}/{id_dosen}', [DosenController::class, 'terimaUndangan'])->name('dosen.terima-undangan');
    Route::post('/dosen-postkomentar/{id_judul}/{id_kelompok}', [DosenController::class, 'postKomentar'])->name('dosen.post-komentar');

});
Route::middleware(['auth', 'role:koordinator'])->group(function () {
    Route::get('/dashboard-koordinator', [KoordinatorController::class, 'getDashboardKoordinator'])->name('koordinator.dashboard');
    Route::get('/koordinator/daftar-kelompok', [KoordinatorController::class, 'getDaftarKelompok'])->name('koordinator.daftar-kelompok');
    Route::get('/koordinator/detail-kelompok/{id}', [KoordinatorController::class, 'getDetailKelompok'])->name('koordinator.detail-kelompok');
    Route::post('/koordinator-postkomentar/{id_judul}/{id_kelompok}', [KoordinatorController::class, 'postKomentar'])->name('koordinator.post-komentar');

});
Route::middleware(['auth', 'role:biro'])->group(function () {
    Route::get('/dashboard-biro', [BiroController::class, 'getDashboardBiro'])->name('biro.dashboard');
    Route::get('/dashboard-biro/dosen-account', [BiroController::class, 'getDosenAccountPage'])->name('biro.dosen-account-page');
    Route::get('/dashboard-biro/koordinator-account', [BiroController::class, 'getKoordinatorAccountPage'])->name('biro.koordinator-account-page');
    Route::get('/dashboard-biro/mahasiswa-account', [BiroController::class, 'getMahasiswaAccountPage'])->name('biro.mahasiswa-account-page');
    Route::post('/dashboard-biro/post-dosen-account', [BiroController::class, 'postDosenAccount'])->name('biro.dosen-post');
    Route::post('/dashboard-biro/post-koordinator-account', [BiroController::class, 'postKoordinatorAccount'])->name('biro.koordinator-post');

});
