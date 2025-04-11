<?php


use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\BiroKelompokController;
use App\Http\Controllers\DashboardController\AnggotaController;
use App\Http\Controllers\DashboardController\BiroController;
use App\Http\Controllers\DashboardController\DosenController;
use App\Http\Controllers\DashboardController\KoordinatorController;
use App\Http\Controllers\DashboardController\MahasiswaController;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\LandingPageController\HomeController;
use App\Http\Controllers\ProposalController;
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


Route::middleware(['auth','role:mahasiswa,dosen,koordinator,biro'])->group(function(){
    Route::get('/download-proposal/{id_kelompok}/{nama_file}',[ProposalController::class,'downloadProposal'])->name('downloadProposal');
    Route::get('/change-password',[AccountController::class,'getPage'])->name('change-password');
    Route::put('/post-change-password',[AccountController::class,'changePassword'])->name('post-change-password');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'getDashboardMahasiswa'])->name('mahasiswa.dashboard');
    Route::match(['get','post'],'/dashboard/kelompok', [MahasiswaController::class, 'getKelompokPage'])->name('mahasiswa.daftar-kelompok');
    Route::get('/dashboard/daftar-ketua', [AnggotaController::class, 'getDaftarKetuaPage'])->name('mahasiswa.daftar-ketua');
    Route::post('/daftar-ketua/post-daftar-ketua', [AnggotaController::class, 'postDaftarKetua'])->name('mahasiswa.post-daftar-ketua');

    Route::middleware('verify.kelompok')->group(function () {
        Route::get('/dashboard/detail-kelompok/{id_kelompok}', [MahasiswaController::class, 'getDetailKelompokPage'])->name('mahasiswa.detail-kelompok');
        Route::post('/post-judul/{id_kelompok}', [MahasiswaController::class, 'storeJudul'])->name('storeJudul');
        Route::delete('/delete-judul/{id_kelompok}/{id_judul}', [MahasiswaController::class, 'deleteJudul'])->name('deleteJudul');
        Route::get('/detail-judul/{id_kelompok}/{id_judul}',[MahasiswaController::class,'detailJudul'])->name('detailJudul');
        Route::put('/update-judul/{id_kelompok}/{id_judul}',[MahasiswaController::class,'updateJudul'])->name('updateJudul');
        Route::middleware('cek.ketua')->group(function () {
            Route::match(['get','post'],'/detail-kelompok/tambah-anggota/{id_kelompok}', [MahasiswaController::class, 'getTambahAnggotaPage'])->name('mahasiswa.tambah-anggota-page');
            Route::match(['get','post'],'/detail-kelompok/tambah-dosen/{id_kelompok}', [MahasiswaController::class, 'getTambahDosenPage'])->name('mahasiswa.tambah-dosen-page');
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
    Route::match(['get','post'],'/dosen-daftarkelompok', [DosenController::class, 'getDaftarKelompok'])->name('dosen.daftar-kelompok');
    Route::get('/dosen-detailkelompok/{id}', [DosenController::class, 'getDetailKelompok'])->name('dosen.detail-kelompok');
    Route::put('/dosen-terimaundangan/{id_kelompok}/{id_dosen}', [DosenController::class, 'terimaUndangan'])->name('dosen.terima-undangan');
    Route::post('/dosen-postkomentar/{id_judul}/{id_kelompok}', [DosenController::class, 'postKomentar'])->name('dosen.post-komentar');
    Route::put('/dosen-updatekomentar/{id_komentar}/{id_kelompok}', [DosenController::class, 'updateKomentar'])->name('dosen.update-komentar');
    Route::delete('/dosen/delete-komentar/{id_kelompok}/{id_komentar}',[DosenController::class,'deleteKomentar'])->name('dosen.delete-komentar');

});
Route::middleware(['auth', 'role:koordinator'])->group(function () {
    Route::get('/dashboard-koordinator', [KoordinatorController::class, 'getDashboardKoordinator'])->name('koordinator.dashboard');
    Route::match(['get','post'],'/koordinator/daftar-kelompok', [KoordinatorController::class, 'getDaftarKelompok'])->name('koordinator.daftar-kelompok');
    Route::get('/koordinator/detail-kelompok/{id}', [KoordinatorController::class, 'getDetailKelompok'])->name('koordinator.detail-kelompok');
    Route::post('/koordinator-postkomentar/{id_judul}/{id_kelompok}', [KoordinatorController::class, 'postKomentar'])->name('koordinator.post-komentar');
    Route::put('/koordinator-updatekomentar/{id_komentar}/{id_kelompok}', [KoordinatorController::class, 'updateKomentar'])->name('koordinator.update-komentar');
    Route::delete('/koordinator/delete-komentar/{id_kelompok}/{id_komentar}',[KoordinatorController::class,'deleteKomentar'])->name('koordinator.delete-komentar');

});
Route::middleware(['auth', 'role:biro'])->group(function () {
    Route::get('/dashboard-biro', [BiroController::class, 'getDashboardBiro'])->name('biro.dashboard');
    Route::get('/biro-kelola-akun/dosen-account', [BiroController::class, 'getDosenAccountPage'])->name('biro.dosen-account-page');
    Route::get('/biro-kelola-akun/koordinator-account', [BiroController::class, 'getKoordinatorAccountPage'])->name('biro.koordinator-account-page');
    Route::get('/biro-kelola-akun/mahasiswa-account', [BiroController::class, 'getMahasiswaAccountPage'])->name('biro.mahasiswa-account-page');
    Route::post('/biro-kelola-akun/post-dosen-account', [BiroController::class, 'postDosenAccount'])->name('biro.dosen-post');
    Route::post('/biro-kelola-akun/post-koordinator-account', [BiroController::class, 'postKoordinatorAccount'])->name('biro.koordinator-post');
    Route::post('/mahasiswa/ganti-password',[BiroController::class,'gantiPasswordMhs'])->name('biro.ganti-password-mhs');
    Route::match(['post','get'],'/biro-kelola-kelompok/daftar-kelompok',[BiroKelompokController::class,'getKelompokPage'])->name('biro.daftar-kelompok-page');
    Route::get('/biro-kelola-kelompok/detail-kelompok/{id_kelompok}',[BiroKelompokController::class,'detailKelompok'])->name('biro.detail-kelompok');
    Route::delete('/biro-kelola-kelompok/delete-kelompok/{id_kelompok}',[BiroKelompokController::class,'deleteKelompok'])->name('biro.delete-kelompok');
});
