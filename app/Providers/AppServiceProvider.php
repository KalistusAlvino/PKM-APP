<?php

namespace App\Providers;

use App\Repositories\Biro\AkunRepositoryInterface;
use App\Repositories\Biro\AkunRepository;
use App\Repositories\Biro\KelolaAkademikRepository;
use App\Repositories\Biro\KelolaAkademikRepositoryInterface;
use App\Repositories\Biro\KelolaKelompokRepository;
use App\Repositories\Biro\KelolaKelompokRepositoryInterface;
use App\Repositories\Dosen\InviteRepository;
use App\Repositories\Dosen\InviteRepositoryInterface;
use App\Repositories\Judul\JudulRepository;
use App\Repositories\Judul\JudulRepositoryInterface;
use App\Repositories\Kelompok\AnggotaRepository;
use App\Repositories\Kelompok\AnggotaRepositoryInterface;
use App\Repositories\Kelompok\KelompokDataRepository;
use App\Repositories\Kelompok\KelompokDataRepositoryInterface;
use App\Repositories\Kelompok\KetuaRepository;
use App\Repositories\Kelompok\KetuaRepositoryInterface;
use App\Repositories\Kelompok\ValidationRepository;
use App\Repositories\Kelompok\ValidationRepositoryInterface;
use App\Repositories\Users\AuthRepository;
use App\Repositories\Users\AuthRepositoryInterface;
use App\Repositories\Mahasiswa\RegisterRepository;
use App\Repositories\Mahasiswa\RegisterRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            RegisterRepositoryInterface::class => RegisterRepository::class,
            AuthRepositoryInterface::class => AuthRepository::class,
            AkunRepositoryInterface::class => AkunRepository::class,
            InviteRepositoryInterface::class => InviteRepository::class,
            JudulRepositoryInterface::class => JudulRepository::class,
            AnggotaRepositoryInterface::class => AnggotaRepository::class,
            KetuaRepositoryInterface::class => KetuaRepository::class,
            ValidationRepositoryInterface::class => ValidationRepository::class,
            KelompokDataRepositoryInterface::class => KelompokDataRepository::class,
            KelolaKelompokRepositoryInterface::class => KelolaKelompokRepository::class,
            KelolaAkademikRepositoryInterface::class => KelolaAkademikRepository::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
