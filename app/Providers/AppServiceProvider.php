<?php

namespace App\Providers;

use App\Repositories\Biro\AkunRepositoryInterface;
use App\Repositories\Biro\AkunRepository;
use App\Repositories\Dosen\InviteRepository;
use App\Repositories\Dosen\InviteRepositoryInterface;
use App\Repositories\Dosen\KelompokDosenRepository;
use App\Repositories\Dosen\KelompokDosenRepositoryInterface;
use App\Repositories\Judul\JudulRepository;
use App\Repositories\Judul\JudulRepositoryInterface;
use App\Repositories\Kelompok\AnggotaRepository;
use App\Repositories\Kelompok\AnggotaRepositoryInterface;
use App\Repositories\Kelompok\KetuaRepository;
use App\Repositories\Kelompok\KetuaRepositoryInterface;
use App\Repositories\Kelompok\ValidationRepository;
use App\Repositories\Kelompok\ValidationRepositoryInterface;
use App\Repositories\Mahasiswa\KelompokRepository;
use App\Repositories\Mahasiswa\KelompokRepositoryInterface;
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
            KelompokRepositoryInterface::class => KelompokRepository::class,
            AkunRepositoryInterface::class => AkunRepository::class,
            InviteRepositoryInterface::class => InviteRepository::class,
            KelompokDosenRepositoryInterface::class => KelompokDosenRepository::class,
            JudulRepositoryInterface::class => JudulRepository::class,
            AnggotaRepositoryInterface::class => AnggotaRepository::class,
            KetuaRepositoryInterface::class => KetuaRepository::class,
            ValidationRepositoryInterface::class => ValidationRepository::class,
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
