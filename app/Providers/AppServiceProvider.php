<?php

namespace App\Providers;

use App\Repositories\Mahasiswa\MahasiswaRepository;
use App\Repositories\Mahasiswa\MahasiswaRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            MahasiswaRepositoryInterface::class,
            MahasiswaRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
