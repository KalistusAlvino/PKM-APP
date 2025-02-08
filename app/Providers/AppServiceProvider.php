<?php

namespace App\Providers;

use App\Repositories\Users\AuthRepository;
use App\Repositories\Users\AuthRepositoryInterface;
use App\Repositories\Mahasiswa\RegisterRepository;
use App\Repositories\Mahasiswa\RegisterRepositoryInterface;
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
        //
    }
}
